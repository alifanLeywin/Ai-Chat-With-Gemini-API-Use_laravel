@extends('layouts.app')

@section('title', 'Tentang Kami - AI Shop')

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .team-card {
        transition: all 0.3s ease;
    }
    
    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .stats-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-section text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center fade-in-up">
            <div class="mb-6">
                <i class="fas fa-users text-6xl mb-4"></i>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold mb-6">
                Tentang AI Shop
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto opacity-90">
                Platform inovatif yang memadukan kecerdasan buatan dengan merchandise berkualitas tinggi untuk komunitas tech enthusiast Indonesia
            </p>
        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="fade-in-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Misi Kami</h2>
                <p class="text-lg text-gray-600 mb-6">
                    Kami berkomitmen untuk menjadi platform terdepan yang menyediakan solusi AI chat yang mudah diakses, 
                    sekaligus menawarkan merchandise berkualitas tinggi yang mencerminkan passion terhadap teknologi.
                </p>
                <p class="text-lg text-gray-600 mb-8">
                    Melalui AI Shop, kami ingin membangun komunitas yang solid bagi para tech enthusiast, developer, 
                    dan siapa saja yang tertarik dengan perkembangan artificial intelligence.
                </p>
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center">
                        <i class="fas fa-rocket text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Innovation First</h3>
                        <p class="text-gray-600">Selalu menghadirkan teknologi terdepan</p>
                    </div>
                </div>
            </div>
            <div class="fade-in-up">
                <div class="relative">
                    <div class="bg-gradient-to-br from-blue-400 to-purple-600 rounded-2xl h-96 flex items-center justify-center">
                        <i class="fas fa-brain text-white text-8xl"></i>
                    </div>
                    <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-gradient-to-br from-purple-400 to-pink-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-lightbulb text-white text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="hero-section text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">AI Shop dalam Angka</h2>
            <p class="text-xl opacity-90">Pencapaian yang membanggakan bersama komunitas kami</p>
        </div>
        
        <div class="grid md:grid-cols-4 gap-8">
            <div class="stats-card rounded-xl p-6 text-center hover-lift">
                <i class="fas fa-users text-4xl mb-4"></i>
                <h3 class="text-3xl font-bold mb-2">10,000+</h3>
                <p class="opacity-90">Active Users</p>
            </div>
            <div class="stats-card rounded-xl p-6 text-center hover-lift">
                <i class="fas fa-comments text-4xl mb-4"></i>
                <h3 class="text-3xl font-bold mb-2">500K+</h3>
                <p class="opacity-90">Chat Messages</p>
            </div>
            <div class="stats-card rounded-xl p-6 text-center hover-lift">
                <i class="fas fa-shopping-bag text-4xl mb-4"></i>
                <h3 class="text-3xl font-bold mb-2">2,500+</h3>
                <p class="opacity-90">Products Sold</p>
            </div>
            <div class="stats-card rounded-xl p-6 text-center hover-lift">
                <i class="fas fa-star text-4xl mb-4"></i>
                <h3 class="text-3xl font-bold mb-2">4.9/5</h3>
                <p class="opacity-90">Customer Rating</p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Tim Kami</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Dibangun oleh tim passionate yang memiliki visi sama untuk memajukan teknologi AI di Indonesia
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Team Member 1 -->
            <div class="team-card bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="h-64 bg-gradient-to-br from-blue-400 to-purple-600 flex items-center justify-center">
                    <i class="fas fa-user-tie text-white text-6xl"></i>
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Andi Rahman</h3>
                    <p class="text-purple-600 font-medium mb-3">CEO & Founder</p>
                    <p class="text-gray-600 text-sm mb-4">
                        Ex-Google engineer dengan pengalaman 8+ tahun di bidang AI dan machine learning. 
                        Passionate dalam membangun teknologi yang berdampak positif.
                    </p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-gray-400 hover:text-blue-600">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-600">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-600">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Team Member 2 -->
            <div class="team-card bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="h-64 bg-gradient-to-br from-purple-400 to-pink-600 flex items-center justify-center">
                    <i class="fas fa-user-graduate text-white text-6xl"></i>
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Sarah Wijaya</h3>
                    <p class="text-purple-600 font-medium mb-3">CTO & Co-Founder</p>
                    <p class="text-gray-600 text-sm mb-4">
                        Lead developer dengan expertise dalam NLP dan deep learning. Alumni Stanford University 
                        yang berdedikasi mengembangkan AI yang user-friendly.
                    </p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-gray-400 hover:text-blue-600">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-600">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-600">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Team Member 3 -->
            <div class="team-card bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="h-64 bg-gradient-to-br from-green-400 to-blue-600 flex items-center justify-center">
                    <i class="fas fa-user-cog text-white text-6xl"></i>
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Budi Santoso</h3>
                    <p class="text-purple-600 font-medium mb-3">Head of Design</p>
                    <p class="text-gray-600 text-sm mb-4">
                        UI/UX designer dengan pengalaman 6+ tahun. Ahli dalam merancang interface yang intuitif 
                        dan merchandise design yang eye-catching.
                    </p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-gray-400 hover:text-blue-600">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-600">
                            <i class="fab fa-dribbble text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-600">
                            <i class="fab fa-behance text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Nilai-Nilai Kami</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Prinsip-prinsip yang menjadi fondasi dalam setiap langkah perjalanan AI Shop
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-heart text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Customer First</h3>
                <p class="text-gray-600">
                    Kepuasan dan kebutuhan customer adalah prioritas utama dalam setiap keputusan yang kami ambil.
                </p>
            </div>

            <div class="text-center p-6">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-lightbulb text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Innovation</h3>
                <p class="text-gray-600">
                    Selalu mencari cara baru untuk meningkatkan pengalaman user dengan teknologi terdepan.
                </p>
            </div>

            <div class="text-center p-6">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-handshake text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Integrity</h3>
                <p class="text-gray-600">
                    Transparansi, kejujuran, dan etika bisnis yang baik dalam setiap interaksi dengan stakeholder.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA Section -->
<section class="gradient-bg text-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Mari Berkolaborasi!</h2>
        <p class="text-xl mb-8 opacity-90">
            Tertarik untuk bermitra dengan kami atau punya ide menarik? Jangan ragu untuk menghubungi tim kami
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6">
            <a href="mailto:hello@aishop.com" class="bg-white text-purple-600 px-8 py-3 rounded-full font-bold hover-lift">
                <i class="fas fa-envelope mr-2"></i>Contact Us
            </a>
            <a href="{{ route('merchandise') }}" class="glass-card px-8 py-3 rounded-full font-bold hover-lift">
                <i class="fas fa-shopping-bag mr-2"></i>Shop Merchandise
            </a>
        </div>
    </div>
</section>
@endsection
