@extends('layouts.app')

@section('title', 'Login - AI Shop')

@push('styles')
<style>
    .login-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: calc(100vh - 64px);
    }
    
    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .google-btn {
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .google-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }
</style>
@endpush

@section('content')
<div class="login-container">
    <div class="flex items-center justify-center min-h-full py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 fade-in-up">
            <div class="login-card rounded-2xl shadow-2xl p-8">
                <!-- Header -->
                <div class="text-center">
                    <div class="mx-auto h-16 w-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-robot text-2xl text-white"></i>
                    </div>
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-2">
                        Welcome to AI Chat
                    </h2>
                    <p class="text-gray-600">
                        Sign in with your Google account to start chatting with our AI assistant
                    </p>
                </div>

                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Login Form -->
                <div class="mt-8">
                    <div class="mt-6">
                        <a href="{{ route('auth.google') }}" 
                           class="google-btn group relative w-full flex justify-center py-4 px-4 border border-transparent text-sm font-medium rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-4">
                                <svg class="h-6 w-6" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                    <path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                    <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                    <path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                </svg>
                            </span>
                            Continue with Google
                        </a>
                    </div>
                </div>

                <!-- Features -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 text-center">
                        What you can do:
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-comments text-blue-500 mr-3"></i>
                            <span class="text-sm">Have natural conversations with AI</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-code text-blue-500 mr-3"></i>
                            <span class="text-sm">Get help with coding and technical questions</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-history text-blue-500 mr-3"></i>
                            <span class="text-sm">Access your conversation history</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-shield-alt text-blue-500 mr-3"></i>
                            <span class="text-sm">Secure login with Google OAuth</span>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-6 text-center">
                    <p class="text-xs text-gray-500">
                        By signing in, you agree to our terms of service and privacy policy.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
