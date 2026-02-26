<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Catchly') }} - Donde la pesca cobra vida</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dark: '#050505',
                        card: '#101010',
                        input: '#0f1011',
                        accent: '#22d3ee',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        grotesk: ['Space Grotesk', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-grotesk { font-family: 'Space Grotesk', sans-serif; }
    </style>
</head>
<body class="bg-dark text-gray-300 min-h-screen flex flex-col relative overflow-x-hidden">

    <!-- Background Glows -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="w-96 h-96 bg-accent/10 blur-[120px] rounded-full absolute -top-32 -left-16"></div>
        <div class="w-64 h-64 bg-cyan-500/10 blur-[120px] rounded-full absolute bottom-0 right-0"></div>
    </div>

    <nav class="flex items-center justify-between px-6 py-6 container mx-auto max-w-7xl relative z-50">
        <div class="flex items-center gap-8">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-white font-bold text-xl tracking-wide">
                Catchly
            </a>
            <div class="hidden md:flex gap-6 text-sm font-semibold text-gray-500">
                <a href="{{ route('posts.index') }}" class="hover:text-white transition {{ request()->routeIs('posts.*') || request()->routeIs('home') ? 'text-accent' : '' }}">Explorar</a>
                <a href="{{ route('rag.index') }}" class="hover:text-white transition {{ request()->routeIs('rag.*') ? 'text-accent' : '' }}">Guía RAG</a>
                @auth
                    <a href="{{ route('posts.create') }}" class="hover:text-white transition {{ request()->routeIs('posts.create') ? 'text-accent' : '' }}">Subir</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition {{ request()->routeIs('admin.*') ? 'text-accent' : '' }}">
                            <span class="flex items-center gap-1">Admin</span>
                        </a>
                    @endif
                @endauth
            </div>
        </div>
        
        <div class="flex items-center gap-6 text-sm font-semibold">
            @auth
                <div class="flex items-center gap-4">
                    <div class="hidden md:block text-right">
                        <p class="text-white text-xs font-bold leading-none">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-accent uppercase tracking-widest mt-1">{{ auth()->user()->role ?? 'Fisherman' }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-white transition">Salir</button>
                    </form>
                    <a href="{{ route('profile.show') }}">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-accent/60 to-cyan-500/40 border border-white/10 overflow-hidden">
                            @if(auth()->user()->profile_photo_path)
                                <img src="{{ Storage::url(auth()->user()->profile_photo_path) }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                    </a>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="text-accent hover:text-cyan-300 transition px-4 py-2 border border-accent/20 rounded-lg bg-accent/5">Registrarse</a>
            @endauth
        </div>
    </nav>

    <main class="flex-grow relative z-10 w-full mb-10">
        @if(session('success'))
            <div class="container mx-auto max-w-7xl px-6 mb-6">
                <div class="bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="container mx-auto max-w-7xl px-6 mb-6">
                <div class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>
    <footer class="text-center py-6 text-gray-600 text-sm relative z-10">
        &copy; {{ date('Y') }} Catchly. Todos los derechos reservados.
    </footer>
</body>
</html>
