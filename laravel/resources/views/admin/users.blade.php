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
                    <a href="{{ route('admin.users') }}" class="block px-4 py-2 rounded-lg bg-accent/10 text-accent transition">Usuarios</a>
                    <a href="{{ route('admin.posts') }}" class="block px-4 py-2 rounded-lg text-gray-400 hover:bg-white/5 hover:text-white transition">Capturas</a>
                    <a href="{{ route('admin.comments') }}" class="block px-4 py-2 rounded-lg text-gray-400 hover:bg-white/5 hover:text-white transition">Comentarios</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow">
            <h1 class="text-3xl font-grotesk font-bold text-white mb-8">Gestión de Usuarios</h1>
            
            <div class="bg-card border border-white/5 rounded-2xl overflow-hidden">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="bg-white/5 text-gray-300">
                        <tr>
                            <th class="px-6 py-4 font-medium">Nombre</th>
                            <th class="px-6 py-4 font-medium">Email</th>
                            <th class="px-6 py-4 font-medium">Rol</th>
                            <th class="px-6 py-4 font-medium text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($users as $user)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 text-white font-medium">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.users.update_role', $user) }}" method="POST" class="flex gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="role" class="bg-input border border-white/10 rounded-lg px-2 py-1 text-white text-xs">
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Usuario</option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                    <button type="submit" class="text-xs bg-white/10 hover:bg-white/20 px-2 py-1 rounded text-white transition">Actualizar</button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar usuario?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-400 transition font-medium">Eliminar</button>
                                </form>
                                @endif
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
