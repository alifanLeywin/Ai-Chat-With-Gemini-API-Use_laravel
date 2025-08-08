<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AI Chat Assistant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#343541]">
    <div class="flex flex-col min-h-screen">
        <!-- Navigation -->
        <nav class="bg-[#202123] p-4">
            <div class="container mx-auto flex justify-between items-center">
                <div class="text-white font-semibold text-xl">AI Assistant</div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="flex-grow container mx-auto px-4 py-16">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-5xl font-bold text-white mb-6">
                    Experience the Next Generation of AI Chat
                </h1>
                <p class="text-gray-300 text-xl mb-12">
                    Engage in natural conversations, get instant answers, and explore endless possibilities with our advanced AI chat assistant.
                </p>
                <div class="flex justify-center gap-4">
                    <a href="{{ url('/chat') }}"
                       class="bg-emerald-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-emerald-700 transition-colors">
                        Try AI Chat Now
                    </a>
                </div>
            </div>

            <!-- Features Section -->
            <div id="features" class="mt-24 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-[#202123] p-6 rounded-xl">
                    <div class="text-emerald-500 text-2xl mb-4">🚀</div>
                    <h3 class="text-white text-xl font-semibold mb-2">Lightning Fast</h3>
                    <p class="text-gray-400">Get instant responses to your questions with our optimized AI system.</p>
                </div>
                <div class="bg-[#202123] p-6 rounded-xl">
                    <div class="text-emerald-500 text-2xl mb-4">🎯</div>
                    <h3 class="text-white text-xl font-semibold mb-2">Accurate Answers</h3>
                    <p class="text-gray-400">Powered by advanced AI models to provide precise and relevant information.</p>
                </div>
                <div class="bg-[#202123] p-6 rounded-xl">
                    <div class="text-emerald-500 text-2xl mb-4">🔒</div>
                    <h3 class="text-white text-xl font-semibold mb-2">Secure & Private</h3>
                    <p class="text-gray-400">Your conversations are protected with enterprise-grade security.</p>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-[#202123] py-6">
            <div class="container mx-auto px-4 text-center text-gray-400">
                <p>&copy; 2025 AI Assistant By Alifan. Made With ❤️.</p>
            </div>
        </footer>
    </div>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</body>
</html>
