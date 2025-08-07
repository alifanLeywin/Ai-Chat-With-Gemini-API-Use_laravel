<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - AI Chat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        [x-cloak] { display: none !important; }

        .chat-message {
            animation: fadeInUp 0.3s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .typing-indicator {
            display: inline-block;
            animation: pulse 1.5s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .scrollbar-thin::-webkit-scrollbar {
            width: 6px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
    </style>
</head>
<body class="bg-gray-50 h-screen overflow-hidden">
    <div class="flex h-full" x-data="chatApp()" x-init="init()">
        <!-- Sidebar -->
        <div class="w-80 bg-white border-r border-gray-200 flex flex-col">
            <!-- Header -->
            <div class="p-4 border-b border-gray-200">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-xl font-bold text-gray-800">AI Chat Assistant</h1>
                    <button @click="newConversation()"
                            class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-lg transition-colors">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="text-sm text-gray-600">
                    tsabitah
                </div>
            </div>

            <!-- Conversations List -->
            <div class="flex-1 overflow-y-auto scrollbar-thin">
                <div class="p-2 space-y-1">
                    <template x-for="conversation in conversations" :key="conversation.session_id">
                        <div class="p-3 rounded-lg cursor-pointer transition-colors hover:bg-gray-100"
                             :class="{ 'bg-blue-50 border border-blue-200': currentSessionId === conversation.session_id }"
                             @click="loadConversation(conversation.session_id)">
                            <div class="font-medium text-gray-800 text-sm truncate" x-text="conversation.title"></div>
                            <div class="text-gray-500 text-xs mt-1 truncate" x-text="conversation.preview"></div>
                            <div class="text-gray-400 text-xs mt-1" x-text="formatDate(conversation.updated_at)"></div>
                        </div>
                    </template>

                    <div x-show="conversations.length === 0" class="text-center text-gray-500 py-8">
                        <i class="fas fa-comments text-3xl mb-2"></i>
                        <p>No conversations yet</p>
                        <p class="text-sm">Start a new chat to begin</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat Area -->
        <div class="flex-1 flex flex-col">
            <!-- Chat Header -->
            <div class="bg-white border-b border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="font-semibold text-gray-800" x-text="currentConversation?.title || 'Select a conversation'"></h2>
                        <p class="text-sm text-gray-500">AI Assistant powered by Google Gemini</p>
                    </div>
                    <div class="flex space-x-2">
                        <button x-show="currentSessionId"
                                @click="clearChat()"
                                class="text-red-500 hover:text-red-700 p-2 rounded transition-colors"
                                title="Delete conversation">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Messages Area -->
            <div class="flex-1 overflow-y-auto scrollbar-thin bg-gray-50"
                 x-ref="messagesContainer">
                <div class="max-w-4xl mx-auto p-4 space-y-4">
                    <!-- Welcome Message -->
                    <div x-show="messages.length === 0" class="text-center py-16">
                        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-200 inline-block">
                            <i class="fas fa-robot text-4xl text-blue-500 mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Welcome to AI Chat</h3>
                            <p class="text-gray-600 mb-4">I'm your AI assistant powered by Google Gemini. Ask me anything!</p>
                            <div class="text-sm text-gray-500">
                                <p>• Ask questions about any topic</p>
                                <p>• Get help with coding, writing, or analysis</p>
                                <p>• Have natural conversations</p>
                            </div>
                        </div>
                    </div>

                    <!-- Messages -->
                    <template x-for="message in messages" :key="message.id">
                        <div class="chat-message" :class="message.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                            <div class="max-w-xs lg:max-w-md xl:max-w-lg px-4 py-3 rounded-2xl"
                                 :class="message.role === 'user' ?
                                     'bg-blue-500 text-white rounded-br-lg' :
                                     'bg-white text-gray-800 border border-gray-200 rounded-bl-lg shadow-sm'">

                                <!-- User message -->
                                <template x-if="message.role === 'user'">
                                    <div>
                                        <div class="flex items-center mb-1">
                                            <i class="fas fa-user text-sm mr-2"></i>
                                            <span class="text-xs opacity-75">You</span>
                                        </div>
                                        <div class="whitespace-pre-wrap" x-text="message.content"></div>
                                    </div>
                                </template>

                                <!-- AI message -->
                                <template x-if="message.role === 'assistant'">
                                    <div>
                                        <div class="flex items-center mb-1">
                                            <i class="fas fa-robot text-blue-500 text-sm mr-2"></i>
                                            <span class="text-xs text-gray-500">AI Assistant</span>
                                        </div>
                                        <div class="whitespace-pre-wrap" x-html="formatMessage(message.content)"></div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>

                    <!-- Typing Indicator -->
                    <div x-show="isTyping" class="flex justify-start">
                        <div class="bg-white text-gray-800 border border-gray-200 rounded-2xl rounded-bl-lg shadow-sm px-4 py-3 max-w-xs">
                            <div class="flex items-center">
                                <i class="fas fa-robot text-blue-500 text-sm mr-2"></i>
                                <span class="text-xs text-gray-500 mr-2">AI Assistant</span>
                            </div>
                            <div class="typing-indicator text-gray-500">
                                <i class="fas fa-circle text-xs"></i>
                                <i class="fas fa-circle text-xs mx-1"></i>
                                <i class="fas fa-circle text-xs"></i>
                                Thinking...
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Input Area -->
            <div class="bg-white border-t border-gray-200 p-4">
                <div class="max-w-4xl mx-auto">
                    <form @submit.prevent="sendMessage()" class="flex space-x-3">
                        <div class="flex-1 relative">
                            <textarea x-model="newMessage"
                                    x-ref="messageInput"
                                    @keydown.enter.prevent="handleEnterKey($event)"
                                    placeholder="Type your message here..."
                                    rows="1"
                                    class="w-full resize-none border border-gray-300 rounded-xl px-4 py-3 pr-12 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    :disabled="isTyping"
                                    style="min-height: 48px; max-height: 120px;"></textarea>

                            <div class="absolute right-3 bottom-3 text-xs text-gray-400">
                                <span x-text="newMessage.length"></span>/5000
                            </div>
                        </div>

                        <button type="submit"
                                :disabled="!newMessage.trim() || isTyping"
                                class="bg-blue-500 hover:bg-blue-600 disabled:bg-gray-300 disabled:cursor-not-allowed text-white px-6 py-3 rounded-xl transition-colors font-medium">
                            <i class="fas fa-paper-plane" x-show="!isTyping"></i>
                            <i class="fas fa-spinner fa-spin" x-show="isTyping"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function chatApp() {
            return {
                conversations: [],
                messages: [],
                newMessage: '',
                currentSessionId: null,
                currentConversation: null,
                isTyping: false,

                async init() {
                    await this.loadConversations();
                    // Auto-resize textarea
                    this.$watch('newMessage', () => {
                        this.$nextTick(() => {
                            const textarea = this.$refs.messageInput;
                            textarea.style.height = 'auto';
                            textarea.style.height = Math.min(textarea.scrollHeight, 120) + 'px';
                        });
                    });
                },

                async loadConversations() {
                    try {
                        const response = await fetch('/chat/conversations');
                        const data = await response.json();
                        if (data.success) {
                            this.conversations = data.conversations;
                        }
                    } catch (error) {
                        console.error('Failed to load conversations:', error);
                    }
                },

                async newConversation() {
                    try {
                        const response = await fetch('/chat/new', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        });

                        const data = await response.json();
                        if (data.success) {
                            this.currentSessionId = data.conversation.session_id;
                            this.currentConversation = data.conversation;
                            this.messages = [];
                            await this.loadConversations();
                            this.$refs.messageInput.focus();
                        }
                    } catch (error) {
                        console.error('Failed to create new conversation:', error);
                    }
                },

                async loadConversation(sessionId) {
                    try {
                        const response = await fetch(`/chat/${sessionId}`);
                        const data = await response.json();

                        if (data.success) {
                            this.currentSessionId = sessionId;
                            this.currentConversation = data.conversation;
                            this.messages = data.conversation.messages;
                            this.scrollToBottom();
                        }
                    } catch (error) {
                        console.error('Failed to load conversation:', error);
                    }
                },

                async sendMessage() {
                    if (!this.newMessage.trim() || this.isTyping) return;

                    // If no conversation exists, create one
                    if (!this.currentSessionId) {
                        await this.newConversation();
                        if (!this.currentSessionId) return;
                    }

                    const message = this.newMessage.trim();
                    this.newMessage = '';
                    this.isTyping = true;

                    // Add user message to UI immediately
                    this.messages.push({
                        id: Date.now(),
                        role: 'user',
                        content: message,
                        created_at: new Date().toISOString()
                    });

                    this.scrollToBottom();

                    try {
                        const response = await fetch('/chat/send', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                session_id: this.currentSessionId,
                                message: message
                            })
                        });

                        const data = await response.json();

                        if (data.success) {
                            // Update the user message with the actual ID
                            this.messages[this.messages.length - 1] = data.user_message;

                            // Add AI response
                            this.messages.push(data.ai_message);

                            // Update conversation details
                            this.currentConversation = data.conversation;

                            // Refresh conversations list
                            await this.loadConversations();

                            this.scrollToBottom();
                        } else {
                            // Remove the optimistic user message on error
                            this.messages.pop();
                            alert('Error: ' + data.message);
                        }
                    } catch (error) {
                        // Remove the optimistic user message on error
                        this.messages.pop();
                        console.error('Failed to send message:', error);
                        alert('Failed to send message. Please try again.');
                    } finally {
                        this.isTyping = false;
                    }
                },

                async clearChat() {
                    if (!this.currentSessionId) return;

                    if (confirm('Are you sure you want to delete this conversation?')) {
                        try {
                            const response = await fetch(`/chat/${this.currentSessionId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            });

                            const data = await response.json();
                            if (data.success) {
                                this.messages = [];
                                this.currentSessionId = null;
                                this.currentConversation = null;
                                await this.loadConversations();
                            }
                        } catch (error) {
                            console.error('Failed to delete conversation:', error);
                        }
                    }
                },

                handleEnterKey(event) {
                    if (event.shiftKey) {
                        // Allow new line with Shift+Enter
                        return;
                    } else {
                        // Send message with Enter
                        event.preventDefault();
                        this.sendMessage();
                    }
                },

                scrollToBottom() {
                    this.$nextTick(() => {
                        const container = this.$refs.messagesContainer;
                        container.scrollTop = container.scrollHeight;
                    });
                },

                formatMessage(content) {
                    // Simple formatting for line breaks
                    return content.replace(/\n/g, '<br>');
                },

                formatDate(dateString) {
                    const date = new Date(dateString);
                    const now = new Date();
                    const diffTime = now - date;
                    const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));

                    if (diffDays === 0) {
                        return date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                    } else if (diffDays === 1) {
                        return 'Yesterday';
                    } else if (diffDays < 7) {
                        return `${diffDays} days ago`;
                    } else {
                        return date.toLocaleDateString();
                    }
                }
            }
        }
    </script>
</body>
</html>
