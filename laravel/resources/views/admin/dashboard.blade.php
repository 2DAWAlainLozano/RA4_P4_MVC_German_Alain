@extends('layouts.catchly')

@section('content')
<div class="container mx-auto max-w-7xl px-6">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar -->
        <div class="w-full md:w-64 flex-shrink-0">
            <div class="bg-card border border-white/5 rounded-2xl p-6 sticky top-6">
                <h3 class="text-white font-bold mb-4 uppercase text-xs tracking-wider text-gray-500">Administración</h3>
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-lg bg-accent/10 text-accent transition">Dashboard</a>
                    <a href="{{ route('admin.users') }}" class="block px-4 py-2 rounded-lg text-gray-400 hover:bg-white/5 hover:text-white transition">Usuarios</a>
                    <a href="{{ route('admin.posts') }}" class="block px-4 py-2 rounded-lg text-gray-400 hover:bg-white/5 hover:text-white transition">Capturas</a>
                    <a href="{{ route('admin.comments') }}" class="block px-4 py-2 rounded-lg text-gray-400 hover:bg-white/5 hover:text-white transition">Comentarios</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow">
            <h1 class="text-3xl font-grotesk font-bold text-white mb-8">Dashboard</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-card border border-white/5 rounded-2xl p-6 flex flex-col justify-between">
                    <div class="text-gray-400 mb-2">Usuarios Totales</div>
                    <div class="text-4xl font-bold text-white">{{ $userCount ?? 0 }}</div>
                </div>
                <div class="bg-card border border-white/5 rounded-2xl p-6 flex flex-col justify-between">
                    <div class="text-gray-400 mb-2">Capturas Publicadas</div>
                    <div class="text-4xl font-bold text-white">{{ $postCount ?? 0 }}</div>
                </div>
                <div class="bg-card border border-white/5 rounded-2xl p-6 flex flex-col justify-between">
                    <div class="text-gray-400 mb-2">Comentarios</div>
                    <div class="text-4xl font-bold text-white">{{ $commentCount ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
