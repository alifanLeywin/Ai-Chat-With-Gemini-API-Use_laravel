<?php

namespace App\Http\Controllers;

use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Services\GeminiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    protected GeminiService $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    /**
     * Display the chat interface.
     */
    public function index()
    {
        $conversations = ChatConversation::where('user_id', auth()->id())
            ->with('latestMessage')
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();

        return view('chat.index', compact('conversations'));
    }

    /**
     * Start a new conversation.
     */
    public function newConversation(): JsonResponse
    {
        $conversation = ChatConversation::create([
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'success' => true,
            'conversation' => [
                'id' => $conversation->id,
                'session_id' => $conversation->session_id,
                'title' => $conversation->title ?? 'New Chat',
            ]
        ]);
    }

    /**
     * Get conversation with messages.
     */
    public function getConversation(Request $request, $sessionId): JsonResponse
    {
        $conversation = ChatConversation::where('session_id', $sessionId)
            ->where('user_id', auth()->id())
            ->with(['messages' => function($query) {
                $query->orderBy('created_at', 'asc');
            }])
            ->first();

        if (!$conversation) {
            return response()->json([
                'success' => false,
                'message' => 'Conversation not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'conversation' => [
                'id' => $conversation->id,
                'session_id' => $conversation->session_id,
                'title' => $conversation->title ?? 'New Chat',
                'messages' => $conversation->messages->map(function($message) {
                    return [
                        'id' => $message->id,
                        'role' => $message->role,
                        'content' => $message->content,
                        'created_at' => $message->created_at->format('Y-m-d H:i:s'),
                    ];
                })
            ]
        ]);
    }

    /**
     * Send a message and get AI response.
     */
    public function sendMessage(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'session_id' => 'required|string',
            'message' => 'required|string|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $sessionId = $request->input('session_id');
        $userMessage = $request->input('message');

        try {
            DB::beginTransaction();

            // Find or create conversation
            $conversation = ChatConversation::firstOrCreate(
                ['session_id' => $sessionId],
                ['user_id' => auth()->id()]
            );

            // Save user message
            $userChatMessage = ChatMessage::create([
                'conversation_id' => $conversation->id,
                'role' => 'user',
                'content' => $userMessage,
            ]);

            // Generate AI response
            $aiResponse = $this->geminiService->generateContent($userMessage);

            if (!$aiResponse['success']) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => $aiResponse['message']
                ], 500);
            }

            // Save AI response
            $aiChatMessage = ChatMessage::create([
                'conversation_id' => $conversation->id,
                'role' => 'assistant',
                'content' => $aiResponse['message'],
                'metadata' => [
                    'response_time' => microtime(true) - LARAVEL_START,
                ]
            ]);

            // Generate title if it's the first message
            $conversation->generateTitle();

            DB::commit();

            return response()->json([
                'success' => true,
                'conversation' => [
                    'id' => $conversation->id,
                    'session_id' => $conversation->session_id,
                    'title' => $conversation->title ?? 'New Chat',
                ],
                'user_message' => [
                    'id' => $userChatMessage->id,
                    'role' => 'user',
                    'content' => $userMessage,
                    'created_at' => $userChatMessage->created_at->format('Y-m-d H:i:s'),
                ],
                'ai_message' => [
                    'id' => $aiChatMessage->id,
                    'role' => 'assistant',
                    'content' => $aiResponse['message'],
                    'created_at' => $aiChatMessage->created_at->format('Y-m-d H:i:s'),
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Get all conversations for sidebar.
     */
    public function getConversations(): JsonResponse
    {
        $conversations = ChatConversation::where('user_id', auth()->id())
            ->with('latestMessage')
            ->orderBy('updated_at', 'desc')
            ->limit(20)
            ->get()
            ->map(function($conversation) {
                return [
                    'id' => $conversation->id,
                    'session_id' => $conversation->session_id,
                    'title' => $conversation->title ?? 'New Chat',
                    'updated_at' => $conversation->updated_at->format('Y-m-d H:i:s'),
                    'preview' => $conversation->latestMessage ?
                        Str::limit($conversation->latestMessage->content, 50) :
                        'No messages yet'
                ];
            });

        return response()->json([
            'success' => true,
            'conversations' => $conversations
        ]);
    }

    /**
     * Delete a conversation.
     */
    public function deleteConversation($sessionId): JsonResponse
    {
        $conversation = ChatConversation::where('session_id', $sessionId)
                                      ->where('user_id', auth()->id())
                                      ->first();

        if (!$conversation) {
            return response()->json([
                'success' => false,
                'message' => 'Conversation not found'
            ], 404);
        }

        $conversation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Conversation deleted successfully'
        ]);
    }
}
