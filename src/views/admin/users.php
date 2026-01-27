<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mx-auto px-6 py-12 max-w-7xl">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white font-grotesk">Gestión de Usuarios</h1>
            <p class="text-gray-500 mt-2">Administra roles y elimina usuarios.</p>
        </div>
        <a href="index.php?action=admin" class="flex items-center gap-2 text-sm text-gray-400 hover:text-accent transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Volver al panel
        </a>
    </div>

    <div class="bg-card/80 border border-gray-900 rounded-2xl overflow-hidden backdrop-blur">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-800">
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-widest">ID</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-widest">Nombre</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-widest">Email</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-widest">Rol</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-widest">Registro</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-widest">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-900">
                    <?php foreach ($users as $user): ?>
                    <tr class="hover:bg-dark/40 transition">
                        <td class="px-6 py-4 text-sm text-gray-400">#<?= $user['ID_USER'] ?></td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-accent/60 to-cyan-500/40"></div>
                                <span class="text-white font-medium"><?= htmlspecialchars($user['NAME']) ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-400"><?= htmlspecialchars($user['EMAIL']) ?></td>
                        <td class="px-6 py-4">
                            <form method="POST" action="index.php?action=admin_update_role" class="flex items-center gap-2">
                                <input type="hidden" name="user_id" value="<?= $user['ID_USER'] ?>">
                                <select name="role" class="bg-dark border border-gray-800 rounded-lg px-3 py-1.5 text-sm text-white focus:border-accent focus:outline-none">
                                    <option value="subscriber" <?= $user['ROLE'] === 'subscriber' ? 'selected' : '' ?>>Subscriber</option>
                                    <option value="writer" <?= $user['ROLE'] === 'writer' ? 'selected' : '' ?>>Writer</option>
                                    <option value="admin" <?= $user['ROLE'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                </select>
                                <button type="submit" class="px-3 py-1.5 bg-accent/10 text-accent text-xs font-semibold rounded-lg hover:bg-accent/20 transition">
                                    Guardar
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= date('d/m/Y', strtotime($user['CREATED_AT'])) ?></td>
                        <td class="px-6 py-4">
                            <?php if ($user['ID_USER'] != $_SESSION['user_id']): ?>
                            <a href="index.php?action=admin_delete_user&id=<?= $user['ID_USER'] ?>" 
                               onclick="return confirm('¿Eliminar este usuario? Esta acción no se puede deshacer.')"
                               class="flex items-center gap-1 text-red-400 hover:text-red-300 text-sm transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Eliminar
                            </a>
                            <?php else: ?>
                            <span class="text-gray-600 text-sm italic">Tu cuenta</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
