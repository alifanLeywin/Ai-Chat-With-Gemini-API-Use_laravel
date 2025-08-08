@extends('layouts.app')

@section('title', 'Merchandise - AI Shop')

@push('styles')
<style>
    .product-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .price-tag {
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-section text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center fade-in-up">
            <div class="mb-6">
                <i class="fas fa-shopping-bag text-6xl mb-4"></i>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold mb-6">
                AI Shop Merchandise
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto opacity-90">
                Koleksi eksklusif merchandise AI-themed untuk para enthusiast teknologi dan kecerdasan buatan
            </p>
            <div class="flex items-center justify-center space-x-4">
                <div class="flex items-center">
                    <i class="fas fa-shipping-fast mr-2"></i>
                    <span>Free Shipping</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-shield-alt mr-2"></i>
                    <span>Premium Quality</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-robot mr-2"></i>
                    <span>AI-Inspired Design</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Featured Products</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Temukan koleksi merchandise terbaik kami yang terinspirasi dari dunia AI dan teknologi masa depan
            </p>
        </div>

        <!-- Products Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Product 1: T-Shirt -->
            <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden hover-lift">
                <div class="h-64 bg-gradient-to-br from-blue-400 to-purple-600 flex items-center justify-center">
                    <i class="fas fa-tshirt text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-xl font-bold text-gray-900">AI Bot T-Shirt</h3>
                        <span class="price-tag text-white px-3 py-1 rounded-full text-sm font-bold">Rp 199K</span>
                    </div>
                    <p class="text-gray-600 mb-4">
                        Premium cotton t-shirt dengan desain robot AI yang futuristik. Tersedia dalam berbagai ukuran dan warna.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span class="ml-2 text-gray-600 text-sm">(4.9)</span>
                        </div>
                        <button class="gradient-bg text-white px-4 py-2 rounded-lg hover-lift font-medium">
                            <i class="fas fa-cart-plus mr-2"></i>Add to Cart
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 2: Hoodie -->
            <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden hover-lift">
                <div class="h-64 bg-gradient-to-br from-purple-400 to-pink-600 flex items-center justify-center">
                    <i class="fas fa-user-ninja text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Neural Network Hoodie</h3>
                        <span class="price-tag text-white px-3 py-1 rounded-full text-sm font-bold">Rp 399K</span>
                    </div>
                    <p class="text-gray-600 mb-4">
                        Hoodie premium dengan visualisasi neural network yang stylish. Cocok untuk cuaca dingin dan gaya kasual.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span class="ml-2 text-gray-600 text-sm">(4.8)</span>
                        </div>
                        <button class="gradient-bg text-white px-4 py-2 rounded-lg hover-lift font-medium">
                            <i class="fas fa-cart-plus mr-2"></i>Add to Cart
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 3: Mug -->
            <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden hover-lift">
                <div class="h-64 bg-gradient-to-br from-green-400 to-blue-600 flex items-center justify-center">
                    <i class="fas fa-coffee text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Code & Coffee Mug</h3>
                        <span class="price-tag text-white px-3 py-1 rounded-full text-sm font-bold">Rp 89K</span>
                    </div>
                    <p class="text-gray-600 mb-4">
                        Mug keramik berkualitas tinggi dengan quote programming yang inspiratif. Perfect companion untuk coding session.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span class="ml-2 text-gray-600 text-sm">(4.7)</span>
                        </div>
                        <button class="gradient-bg text-white px-4 py-2 rounded-lg hover-lift font-medium">
                            <i class="fas fa-cart-plus mr-2"></i>Add to Cart
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 4: Sticker Pack -->
            <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden hover-lift">
                <div class="h-64 bg-gradient-to-br from-yellow-400 to-orange-600 flex items-center justify-center">
                    <i class="fas fa-tags text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-xl font-bold text-gray-900">AI Sticker Pack</h3>
                        <span class="price-tag text-white px-3 py-1 rounded-full text-sm font-bold">Rp 49K</span>
                    </div>
                    <p class="text-gray-600 mb-4">
                        Set 20 sticker unik bertema AI, machine learning, dan programming. Waterproof dan tahan lama.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span class="ml-2 text-gray-600 text-sm">(5.0)</span>
                        </div>
                        <button class="gradient-bg text-white px-4 py-2 rounded-lg hover-lift font-medium">
                            <i class="fas fa-cart-plus mr-2"></i>Add to Cart
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 5: Laptop Sleeve -->
            <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden hover-lift">
                <div class="h-64 bg-gradient-to-br from-indigo-400 to-purple-600 flex items-center justify-center">
                    <i class="fas fa-laptop text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Tech Laptop Sleeve</h3>
                        <span class="price-tag text-white px-3 py-1 rounded-full text-sm font-bold">Rp 299K</span>
                    </div>
                    <p class="text-gray-600 mb-4">
                        Laptop sleeve premium dengan padding tebal dan desain circuit board yang elegan. Tersedia untuk berbagai ukuran laptop.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span class="ml-2 text-gray-600 text-sm">(4.6)</span>
                        </div>
                        <button class="gradient-bg text-white px-4 py-2 rounded-lg hover-lift font-medium">
                            <i class="fas fa-cart-plus mr-2"></i>Add to Cart
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 6: Mouse Pad -->
            <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden hover-lift">
                <div class="h-64 bg-gradient-to-br from-red-400 to-pink-600 flex items-center justify-center">
                    <i class="fas fa-mouse text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Matrix Code Mouse Pad</h3>
                        <span class="price-tag text-white px-3 py-1 rounded-full text-sm font-bold">Rp 79K</span>
                    </div>
                    <p class="text-gray-600 mb-4">
                        Mouse pad gaming dengan desain matrix code yang iconic. Anti-slip base dan permukaan smooth untuk precision gaming.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span class="ml-2 text-gray-600 text-sm">(4.9)</span>
                        </div>
                        <button class="gradient-bg text-white px-4 py-2 rounded-lg hover-lift font-medium">
                            <i class="fas fa-cart-plus mr-2"></i>Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="gradient-bg text-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Show Your AI Passion?</h2>
        <p class="text-xl mb-8 opacity-90">
            Bergabunglah dengan komunitas AI enthusiast dan tunjukkan passion Anda dengan merchandise eksklusif kami
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6">
            <button class="bg-white text-purple-600 px-8 py-3 rounded-full font-bold hover-lift">
                <i class="fas fa-shopping-cart mr-2"></i>Shop Now
            </button>
            <a href="{{ route('about') }}" class="glass-card px-8 py-3 rounded-full font-bold hover-lift">
                Learn More About Us
            </a>
        </div>
    </div>
</section>
@endsection
