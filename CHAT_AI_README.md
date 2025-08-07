# Laravel AI Chat with Gemini API

A modern, responsive chat interface powered by Google's Gemini AI, built with Laravel and Alpine.js.

## Features

- 🤖 **AI-Powered Conversations**: Integration with Google Gemini 2.0 Flash model
- 💬 **Real-time Chat Interface**: Modern, responsive chat UI with typing indicators
- 🗂️ **Conversation Management**: Automatic conversation saving and history
- 📱 **Responsive Design**: Works perfectly on desktop and mobile devices
- 🎨 **Modern UI**: Clean, ChatGPT-inspired design with Tailwind CSS
- ⚡ **Fast & Efficient**: Optimized for performance with Alpine.js
- 🔒 **Secure**: CSRF protection and input validation

## What's Included

### Backend Components
- **GeminiService**: Service class for Gemini AI API integration
- **ChatController**: Handles chat requests and responses
- **Models**: `ChatConversation` and `ChatMessage` for data persistence
- **Database**: Migrations for chat conversations and messages
- **Routes**: Complete API endpoints for chat functionality

### Frontend Components
- **Modern Chat Interface**: Full-featured chat UI with sidebar
- **Real-time Features**: Typing indicators, message animations
- **Conversation History**: Browse and manage chat sessions
- **Responsive Design**: Mobile-first approach

### API Endpoints
- `GET /chat` - Chat interface
- `POST /chat/new` - Create new conversation
- `GET /chat/conversations` - Get all conversations
- `GET /chat/{sessionId}` - Get specific conversation
- `POST /chat/send` - Send message to AI
- `DELETE /chat/{sessionId}` - Delete conversation

## Setup Instructions

### 1. Environment Configuration
The Gemini API key is already configured in your `.env` file:
```
GEMINI_API_KEY=AIzaSyCeC_nocyfDdorQ0ZBwWbSJ0sWH7_GYFPQ
```

### 2. Database
The database tables have been created automatically:
- `chat_conversations` - Stores conversation metadata
- `chat_messages` - Stores individual messages

### 3. Test the API
You can test the Gemini API integration using the artisan command:
```bash
php artisan gemini:test "Your test message here"
```

## Usage

### Starting the Chat Application

1. **Start the Laravel server:**
```bash
php artisan serve
```

2. **Access the chat interface:**
Open your browser and go to: `http://localhost:8000/chat`

### Using the Chat Interface

1. **Start a New Conversation**: Click the "+" button in the sidebar
2. **Send Messages**: Type your message and press Enter or click Send
3. **View History**: Click on previous conversations in the sidebar
4. **Delete Conversations**: Click the trash icon in the chat header

### Features Overview

- **Auto-save**: Conversations are automatically saved
- **Session Management**: Each conversation has a unique session ID
- **Smart Titles**: Conversation titles are generated from first message
- **Responsive Input**: Message input auto-resizes with content
- **Character Counter**: Shows message length (max 5000 characters)
- **Keyboard Shortcuts**: 
  - Enter: Send message
  - Shift+Enter: New line

## API Integration Details

### Gemini API Configuration
- **Model**: `gemini-2.0-flash`
- **Endpoint**: `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent`
- **Authentication**: API Key via `X-goog-api-key` header

### Request Format
```json
{
  "contents": [
    {
      "parts": [
        {
          "text": "Your message here"
        }
      ]
    }
  ]
}
```

### Service Features
- **Error Handling**: Comprehensive error logging and user feedback
- **Response Processing**: Extracts generated text from API response
- **Context Support**: Ready for conversation history integration

## Database Schema

### ChatConversation Model
- `id` - Primary key
- `session_id` - Unique session identifier (UUID)
- `title` - Auto-generated conversation title
- `created_at` / `updated_at` - Timestamps

### ChatMessage Model
- `id` - Primary key
- `conversation_id` - Foreign key to conversations
- `role` - 'user' or 'assistant'
- `content` - Message content
- `metadata` - Additional data (JSON)
- `created_at` / `updated_at` - Timestamps

## Customization

### Styling
The chat interface uses Tailwind CSS. You can customize the appearance by modifying the classes in:
- `resources/views/chat/index.blade.php`

### AI Behavior
Modify the `GeminiService` class to:
- Change the AI model
- Add system prompts
- Implement conversation context
- Add custom response processing

### Features
Extend the chat functionality by:
- Adding file upload support
- Implementing user authentication
- Adding conversation sharing
- Creating chat themes

## Testing

### API Test Command
```bash
# Test with default prompt
php artisan gemini:test

# Test with custom prompt
php artisan gemini:test "What is Laravel?"
```

### Manual Testing
1. Visit `/chat` in your browser
2. Create a new conversation
3. Send various types of messages
4. Test conversation management features

## Troubleshooting

### Common Issues

1. **API Key Issues**
   - Verify the API key in `.env` file
   - Check Google Cloud Console for API key status
   - Ensure Gemini API is enabled

2. **Database Issues**
   - Run `php artisan migrate` if tables don't exist
   - Check database connection in `.env`

3. **Frontend Issues**
   - Check browser console for JavaScript errors
   - Verify CSRF token is working
   - Ensure routes are accessible

### Debug Mode
Enable debug mode in `.env` for detailed error messages:
```
APP_DEBUG=true
```

## Performance Tips

1. **Database Indexing**: Tables are already optimized with proper indexes
2. **Caching**: Consider implementing Redis for session storage
3. **CDN**: Use CDN for static assets in production
4. **API Rate Limiting**: Implement rate limiting for API calls

## Security Considerations

- CSRF protection is enabled
- Input validation is implemented
- API keys are stored securely in environment variables
- SQL injection protection via Eloquent ORM

## Future Enhancements

Possible improvements:
- User authentication and profiles
- Conversation sharing and collaboration  
- File/image upload support
- Voice input/output
- Multi-language support
- Chat themes and customization
- Export conversations
- Advanced AI features (vision, code execution, etc.)

---

Enjoy chatting with your AI assistant! 🤖✨
