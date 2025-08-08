<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Redirect root to login if not authenticated, otherwise to chat
Route::get('/', function () {
    return Auth::check() ? redirect()->route('chat.index') : redirect()->route('login');
});

// Public pages
Route::get('/merchandise', function () {
    return view('public.merchandise');
})->name('merchandise');

Route::get('/tentang-kami', function () {
    return view('public.about');
})->name('about');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Test route for debugging Google OAuth configuration
Route::get('/test-oauth-config', function() {
    return response()->json([
        'client_id' => config('services.google.client_id') ? 'SET' : 'NOT SET',
        'client_secret' => config('services.google.client_secret') ? 'SET' : 'NOT SET',
        'redirect' => config('services.google.redirect'),
    ]);
});

// Test route for debugging Socialite
Route::get('/test-socialite', function() {
    try {
        $driver = Laravel\Socialite\Facades\Socialite::driver('google');
        return response()->json([
            'status' => 'success',
            'message' => 'Socialite Google driver loaded successfully',
            'redirect_url' => $driver->redirect()->getTargetUrl()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ]);
    }
});

// Debug callback route
Route::get('/debug-callback', function() {
    return response()->json([
        'request_data' => request()->all(),
        'session_data' => session()->all(),
        'headers' => request()->headers->all()
    ]);
});

// Chat routes (protected by auth middleware)
Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/new', [ChatController::class, 'newConversation'])->name('chat.new');
    Route::get('/chat/conversations', [ChatController::class, 'getConversations'])->name('chat.conversations');
    Route::get('/chat/{sessionId}', [ChatController::class, 'getConversation'])->name('chat.get');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::delete('/chat/{sessionId}', [ChatController::class, 'deleteConversation'])->name('chat.delete');
});
