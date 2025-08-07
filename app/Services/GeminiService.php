<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    private string $apiKey;
    private string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
        $this->baseUrl = 'https://generativelanguage.googleapis.com/v1beta';
    }

    /**
     * Generate content using Gemini API
     *
     * @param string $prompt
     * @return array
     */
    public function generateContent(string $prompt): array
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-goog-api-key' => $this->apiKey,
            ])->post($this->baseUrl . '/models/gemini-2.0-flash:generateContent', [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => $prompt
                            ]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // Extract the generated text from the response
                $generatedText = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'No response generated';
                
                return [
                    'success' => true,
                    'message' => $generatedText,
                    'full_response' => $data
                ];
            }

            Log::error('Gemini API Error', [
                'status' => $response->status(),
                'response' => $response->body()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to generate response from AI',
                'error' => $response->body()
            ];

        } catch (\Exception $e) {
            Log::error('Gemini Service Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'An error occurred while processing your request',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Generate content with conversation context
     *
     * @param array $messages Array of messages with 'role' and 'content'
     * @return array
     */
    public function generateWithContext(array $messages): array
    {
        try {
            // Convert messages to Gemini format
            $contents = [];
            foreach ($messages as $message) {
                $contents[] = [
                    'parts' => [
                        [
                            'text' => $message['content']
                        ]
                    ]
                ];
            }

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-goog-api-key' => $this->apiKey,
            ])->post($this->baseUrl . '/models/gemini-2.0-flash:generateContent', [
                'contents' => $contents
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                $generatedText = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'No response generated';
                
                return [
                    'success' => true,
                    'message' => $generatedText,
                    'full_response' => $data
                ];
            }

            Log::error('Gemini API Error with Context', [
                'status' => $response->status(),
                'response' => $response->body()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to generate response from AI',
                'error' => $response->body()
            ];

        } catch (\Exception $e) {
            Log::error('Gemini Service Context Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'An error occurred while processing your request',
                'error' => $e->getMessage()
            ];
        }
    }
}
