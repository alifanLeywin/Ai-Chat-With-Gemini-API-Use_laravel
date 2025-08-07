<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Chat routes
Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::post('/chat/new', [ChatController::class, 'newConversation'])->name('chat.new');
Route::get('/chat/conversations', [ChatController::class, 'getConversations'])->name('chat.conversations');
Route::get('/chat/{sessionId}', [ChatController::class, 'getConversation'])->name('chat.get');
Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
Route::delete('/chat/{sessionId}', [ChatController::class, 'deleteConversation'])->name('chat.delete');
