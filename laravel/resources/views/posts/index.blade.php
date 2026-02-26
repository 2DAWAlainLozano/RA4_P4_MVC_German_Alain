@extends('layouts.catchly')

@section('content')
<div class="container mx-auto max-w-7xl px-6">
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-4xl font-grotesk font-bold text-white tracking-tight">Últimas <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent to-cyan-400">Capturas</span></h1>
        @auth
            <a href="{{ route('posts.create') }}" class="text-sm font-semibold bg-white text-dark px-5 py-2.5 rounded-full hover:bg-gray-200 transition shadow-[0_0_15px_rgba(255,255,255,0.1)]">Compartir</a>
        @endauth
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
            <div class="bg-card border border-white/5 rounded-2xl overflow-hidden hover:border-accent/30 transition duration-300 group shadow-lg flex flex-col">
                <div class="h-56 overflow-hidden relative bg-black/50">
                    @if($post->image_path)
                        <img src="{{ Storage::url($post->image_path) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-600">Sin imagen</div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-dark/90 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end">
                        <div>
                            <p class="text-[10px] text-accent font-bold uppercase tracking-wider mb-1">Pescador</p>
                            <p class="text-white text-sm font-medium">{{ $post->user->name ?? 'Anónimo' }}</p>
                        </div>
                        <span class="text-xs text-gray-400 font-medium">{{ $post->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h2 class="text-xl font-bold text-white mb-3 group-hover:text-accent transition font-grotesk tracking-tight">{{ $post->title }}</h2>
                    <p class="text-gray-400 text-sm mb-6 line-clamp-3 leading-relaxed">{{ $post->content }}</p>
                    <div class="mt-auto">
                        <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center gap-2 text-sm text-white font-medium hover:text-accent transition">
                            Ver Detalles
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center">
                <div class="w-20 h-20 bg-card rounded-full flex items-center justify-center mx-auto mb-4 border border-white/5">
                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <p class="text-xl text-white font-medium mb-1">No hay capturas aún</p>
                <p class="text-gray-500 text-sm">Sé el primero en compartir tu experiencia de pesca.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
