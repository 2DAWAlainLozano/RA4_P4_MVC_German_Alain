@extends('layouts.catchly')

@section('content')
<div class="container mx-auto max-w-3xl px-6">
    <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-white transition mb-8">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Volver
    </a>

    <div class="bg-card border border-white/5 rounded-3xl overflow-hidden shadow-2xl">
        @if($post->image_path)
            <div class="w-full h-80 sm:h-96 md:h-[450px] bg-black/80">
                <img src="{{ Storage::url($post->image_path) }}" alt="{{ $post->title }}" class="w-full h-full object-contain">
            </div>
        @endif
        
        <div class="p-8 sm:p-12">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-accent/20 to-cyan-500/10 border border-accent/20 flex items-center justify-center">
                    <span class="text-accent font-bold text-lg">{{ substr($post->user->name, 0, 1) }}</span>
                </div>
                <div>
                    <h3 class="text-white font-bold leading-tight">{{ $post->user->name }}</h3>
                    <p class="text-gray-500 text-xs">{{ $post->created_at->format('d/m/Y - H:i') }}</p>
                </div>
                
                @if(auth()->check() && (auth()->id() === $post->user_id || auth()->user()->isAdmin()))
                <div class="ml-auto flex gap-3">
                    <a href="{{ route('posts.edit', $post) }}" class="text-sm font-medium text-gray-400 hover:text-white transition">Editar</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta captura?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-400 transition">Eliminar</button>
                    </form>
                </div>
                @endif
            </div>

            <h1 class="text-3xl sm:text-4xl font-grotesk font-bold text-white tracking-tight mb-6">{{ $post->title }}</h1>
            <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed">
                {{ $post->content }}
            </div>
        </div>
        
        <!-- Comments Section -->
        <div class="border-t border-white/5 bg-black/20 p-8 sm:p-12">
            <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-2">
                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                Comentarios ({{ $post->comments->count() }})
            </h3>
            
            @auth
            <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-10">
                @csrf
                <div class="flex gap-4">
                    <div class="flex-grow">
                        <textarea name="content" rows="2" class="w-full bg-input border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-accent/50 focus:ring-1 focus:ring-accent/50 transition resize-none text-sm" placeholder="Añade un comentario a esta captura..." required></textarea>
                    </div>
                    <button type="submit" class="self-end px-5 py-3 rounded-xl bg-white text-dark font-bold text-sm hover:bg-gray-200 transition">Comentar</button>
                </div>
            </form>
            @endauth

            <div class="space-y-6">
                @forelse($post->comments as $comment)
                    <div class="flex gap-4 group">
                        <div class="w-10 h-10 rounded-full bg-dark border border-white/5 flex-shrink-0 flex items-center justify-center">
                            <span class="text-gray-400 font-bold text-sm">{{ substr($comment->user->name, 0, 1) }}</span>
                        </div>
                        <div class="flex-grow bg-dark/50 border border-white/5 rounded-2xl rounded-tl-none p-4">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <span class="text-white font-medium text-sm">{{ $comment->user->name }}</span>
                                    <span class="text-gray-500 text-xs ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                @if(auth()->check() && (auth()->id() === $comment->user_id || auth()->user()->isAdmin()))
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-600 hover:text-red-500 transition opacity-0 group-hover:opacity-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <p class="text-gray-300 text-sm">{{ $comment->content }}</p>
                        </div>
                    </div>
                @empty
                    @guest
                    <p class="text-gray-500 text-sm italic">Inicia sesión para ser el primero en comentar.</p>
                    @endguest
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
