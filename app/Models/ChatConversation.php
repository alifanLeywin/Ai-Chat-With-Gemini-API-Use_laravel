<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ChatConversation extends Model
{
    protected $fillable = [
        'session_id',
        'title',
        'user_id',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($conversation) {
            if (empty($conversation->session_id)) {
                $conversation->session_id = Str::uuid()->toString();
            }
        });
    }

    /**
     * Get the messages for the conversation.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class, 'conversation_id');
    }

    /**
     * Get the latest message of the conversation.
     */
    public function latestMessage()
    {
        return $this->hasOne(ChatMessage::class, 'conversation_id')->latestOfMany();
    }

    /**
     * Get the user that owns the conversation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate a title based on the first user message.
     */
    public function generateTitle(): void
    {
        if ($this->title) {
            return;
        }

        $firstMessage = $this->messages()->where('role', 'user')->first();
        
        if ($firstMessage) {
            $title = Str::limit($firstMessage->content, 50);
            $this->update(['title' => $title]);
        }
    }
}
