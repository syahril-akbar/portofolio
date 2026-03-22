<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->name ?? 'Portfolio' }} - {{ $profile->headline ?? 'Web Portfolio' }}</title>
    <meta name="description" content="{{ Str::limit(strip_tags($profile->about ?? 'Personal Portfolio'), 150) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6, .outfit-font { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased selection:bg-teal-500 selection:text-white">
    
    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100 transition-all duration-300">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0 flex items-center">
                    <a href="#" class="outfit-font font-bold text-xl text-gray-900 tracking-tight">{{ $profile->name ?? 'Portofolio' }}<span class="text-teal-600">.</span></a>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#about" class="text-gray-600 hover:text-teal-600 font-medium text-sm transition-colors">Tentang</a>
                    <a href="#experience" class="text-gray-600 hover:text-teal-600 font-medium text-sm transition-colors">Pengalaman</a>
                    <a href="#projects" class="text-gray-600 hover:text-teal-600 font-medium text-sm transition-colors">Proyek</a>
                    <a href="#skills" class="text-gray-600 hover:text-teal-600 font-medium text-sm transition-colors">Keahlian</a>
                    <a href="#" class="px-4 py-2 rounded-full bg-teal-600 text-white text-sm font-medium hover:bg-teal-700 transition-colors shadow-sm cursor-not-allowed opacity-80" onclick="alert('Fitur Download CV ATS segera hadir!')">Download ATS CV</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="min-h-screen pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 py-12 mt-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} {{ $profile->name ?? 'Portfolio' }}. All rights reserved.</p>
            <div class="flex space-x-4 mt-4 md:mt-0">
                @if($profile && $profile->github_url)
                <a href="{{ $profile->github_url }}" target="_blank" class="text-gray-400 hover:text-gray-900 transition-colors">GitHub</a>
                @endif
                @if($profile && $profile->linkedin_url)
                <a href="{{ $profile->linkedin_url }}" target="_blank" class="text-gray-400 hover:text-blue-600 transition-colors">LinkedIn</a>
                @endif
            </div>
        </div>
    </footer>
</body>
</html>
