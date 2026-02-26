@extends('layouts.catchly')

@section('content')
<div class="container mx-auto max-w-2xl px-6">
    <div class="bg-card border border-white/5 rounded-3xl p-8 shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-accent to-cyan-500"></div>
        
        <h1 class="text-3xl font-grotesk font-bold text-white tracking-tight mb-2">Compartir Captura</h1>
        <p class="text-gray-500 text-sm mb-8">Sube esa pieza que nadie creería sin una foto.</p>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div>
                <label for="title" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Especie / Título</label>
                <input type="text" id="title" name="title" required class="w-full bg-input border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-accent/50 focus:ring-1 focus:ring-accent/50 transition" placeholder="Ej: Black Bass de récord">
            </div>

            <div>
                <label for="content" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Detalles</label>
                <textarea id="content" name="content" required rows="5" class="w-full bg-input border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-accent/50 focus:ring-1 focus:ring-accent/50 transition resize-none" placeholder="Cuenta la historia de la batalla..."></textarea>
            </div>

            <div>
                <label for="image" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Foto (Opcional)</label>
                <input type="file" id="image" name="image" accept="image/*" class="w-full bg-input border border-white/10 rounded-xl px-4 py-3 text-white text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-white/10 file:text-white hover:file:bg-white/20 transition cursor-pointer">
            </div>

            <div class="pt-4 flex justify-end gap-4">
                <a href="{{ route('posts.index') }}" class="px-6 py-3 rounded-xl border border-white/10 text-gray-400 font-medium hover:bg-white/5 hover:text-white transition">Cancelar</a>
                <button type="submit" class="px-6 py-3 rounded-xl bg-white text-dark font-bold hover:bg-gray-200 shadow-[0_0_15px_rgba(255,255,255,0.1)] transition">Publicar</button>
            </div>
        </form>
    </div>
</div>
@endsection
