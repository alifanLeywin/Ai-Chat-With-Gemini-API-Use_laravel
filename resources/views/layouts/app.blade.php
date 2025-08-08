<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AI Shop - Chat Assistant & Merchandise')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }

        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 50%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: all 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
            left: 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white/90 backdrop-blur-md shadow-lg sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ Auth::check() ? route('chat.index') : route('login') }}" class="flex items-center space-x-2 hover-lift">
                        <div class="w-10 h-10 gradient-bg rounded-full flex items-center justify-center">
                            <i class="fas fa-robot text-white text-lg"></i>
                        </div>
                        <span class="text-xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
                            AI Shop
                        </span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('merchandise') }}" 
                       class="nav-link text-gray-700 hover:text-purple-600 px-3 py-2 font-medium {{ request()->routeIs('merchandise') ? 'active text-purple-600' : '' }}">
                        <i class="fas fa-shopping-bag mr-2"></i>Merchandise
                    </a>
                    <a href="{{ route('about') }}" 
                       class="nav-link text-gray-700 hover:text-purple-600 px-3 py-2 font-medium {{ request()->routeIs('about') ? 'active text-purple-600' : '' }}">
                        <i class="fas fa-info-circle mr-2"></i>Tentang Kami
                    </a>
                    
                    @auth
                        <a href="{{ route('chat.index') }}" 
                           class="nav-link text-gray-700 hover:text-purple-600 px-3 py-2 font-medium {{ request()->routeIs('chat.*') ? 'active text-purple-600' : '' }}">
                            <i class="fas fa-comments mr-2"></i>Chat AI
                        </a>
                        <div class="flex items-center space-x-3">
                            @if(auth()->user()->avatar)
                                <img src="{{ auth()->user()->avatar }}" alt="Profile" class="w-8 h-8 rounded-full">
                            @else
                                <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                            @endif
                            <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700 ml-2" title="Logout">
                                    <i class="fas fa-sign-out-alt"></i>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" 
                           class="gradient-bg text-white px-6 py-2 rounded-full hover-lift font-medium">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-700 hover:text-purple-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95"
             class="md:hidden bg-white/95 backdrop-blur-md border-t">
            <div class="px-4 pt-2 pb-3 space-y-1">
                <a href="{{ route('merchandise') }}" 
                   class="block px-3 py-2 text-gray-700 hover:text-purple-600 font-medium {{ request()->routeIs('merchandise') ? 'text-purple-600' : '' }}">
                    <i class="fas fa-shopping-bag mr-2"></i>Merchandise
                </a>
                <a href="{{ route('about') }}" 
                   class="block px-3 py-2 text-gray-700 hover:text-purple-600 font-medium {{ request()->routeIs('about') ? 'text-purple-600' : '' }}">
                    <i class="fas fa-info-circle mr-2"></i>Tentang Kami
                </a>
                
                @auth
                    <a href="{{ route('chat.index') }}" 
                       class="block px-3 py-2 text-gray-700 hover:text-purple-600 font-medium {{ request()->routeIs('chat.*') ? 'text-purple-600' : '' }}">
                        <i class="fas fa-comments mr-2"></i>Chat AI
                    </a>
                    <div class="px-3 py-2 border-t">
                        <div class="flex items-center space-x-3">
                            @if(auth()->user()->avatar)
                                <img src="{{ auth()->user()->avatar }}" alt="Profile" class="w-8 h-8 rounded-full">
                            @else
                                <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                            @endif
                            <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="mt-2">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" 
                       class="block px-3 py-2 gradient-bg text-white rounded-lg text-center font-medium mx-3 my-2">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 gradient-bg rounded-full flex items-center justify-center">
                            <i class="fas fa-robot text-white"></i>
                        </div>
                        <span class="text-lg font-bold">AI Shop</span>
                    </div>
                    <p class="text-gray-400">
                        Platform chat AI terdepan dengan koleksi merchandise eksklusif untuk pengalaman teknologi yang tak terlupakan.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('merchandise') }}" class="text-gray-400 hover:text-white transition-colors">Merchandise</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-colors">Chat AI</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Hubungi Kami</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-envelope mr-2"></i>hello@aishop.com</li>
                        <li><i class="fas fa-phone mr-2"></i>+62 123 456 789</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i>Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">© 2025 AI Shop. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
