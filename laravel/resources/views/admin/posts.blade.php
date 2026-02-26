@extends('layouts.catchly')

@section('content')
<div class="container mx-auto max-w-7xl px-6">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar -->
        <div class="w-full md:w-64 flex-shrink-0">
            <div class="bg-card border border-white/5 rounded-2xl p-6 sticky top-6">
                <h3 class="text-white font-bold mb-4 uppercase text-xs tracking-wider text-gray-500">Administración</h3>
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-lg text-gray-400 hover:bg-white/5 hover:text-white transition">Dashboard</a>
                    <a href="{{ route('admin.users') }}" class="block px-4 py-2 rounded-lg text-gray-400 hover:bg-white/5 hover:text-white transition">Usuarios</a>
                    <a href="{{ route('admin.posts') }}" class="block px-4 py-2 rounded-lg bg-accent/10 text-accent transition">Capturas</a>
                    <a href="{{ route('admin.comments') }}" class="block px-4 py-2 rounded-lg text-gray-400 hover:bg-white/5 hover:text-white transition">Comentarios</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow">
            <h1 class="text-3xl font-grotesk font-bold text-white mb-8">Gestión de Capturas</h1>
            
            <div class="bg-card border border-white/5 rounded-2xl overflow-hidden">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="bg-white/5 text-gray-300">
                        <tr>
                            <th class="px-6 py-4 font-medium">ID</th>
                            <th class="px-6 py-4 font-medium">Título</th>
                            <th class="px-6 py-4 font-medium">Usuario</th>
                            <th class="px-6 py-4 font-medium">Fecha</th>
                            <th class="px-6 py-4 font-medium text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($posts as $post)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 text-white font-medium">#{{ $post->id }}</td>
                            <td class="px-6 py-4 font-medium text-white">
                                <a href="{{ route('posts.show', $post) }}" class="hover:text-accent transition">{{ $post->title }}</a>
                            </td>
                            <td class="px-6 py-4">{{ $post->user->name }}</td>
                            <td class="px-6 py-4">{{ $post->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('¿Eliminar captura?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-400 font-medium transition">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
