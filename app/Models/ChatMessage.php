<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    protected $fillable = [
        'conversation_id',
        'role',
        'content',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    /**
     * Get the conversation that owns the message.
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(ChatConversation::class, 'conversation_id');
    }

    /**
     * Check if the message is from user.
     */
    public function isFromUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Check if the message is from assistant.
     */
    public function isFromAssistant(): bool
    {
        return $this->role === 'assistant';
    }
}
