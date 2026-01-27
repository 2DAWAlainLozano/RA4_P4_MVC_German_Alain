<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mx-auto px-6 py-12 max-w-7xl">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white font-grotesk">Gestión de Posts</h1>
            <p class="text-gray-500 mt-2">Edita o elimina publicaciones.</p>
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
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-widest">Título</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-widest">Autor</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-widest">Imagen</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-widest">Fecha</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-widest">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-900">
                    <?php foreach ($posts as $post): ?>
                    <tr class="hover:bg-dark/40 transition">
                        <td class="px-6 py-4 text-sm text-gray-400">#<?= $post['ID_POST'] ?></td>
                        <td class="px-6 py-4">
                            <a href="index.php?action=show&id=<?= $post['ID_POST'] ?>" class="text-white font-medium hover:text-accent transition">
                                <?= htmlspecialchars(mb_strimwidth($post['TITLE'], 0, 40, '...')) ?>
                            </a>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-400"><?= htmlspecialchars($post['author_name']) ?></td>
                        <td class="px-6 py-4">
                            <?php if (!empty($post['IMAGE_PATH'])): ?>
                            <div class="w-12 h-12 rounded-lg overflow-hidden bg-dark">
                                <img src="<?= htmlspecialchars($post['IMAGE_PATH']) ?>" alt="" class="w-full h-full object-cover">
                            </div>
                            <?php else: ?>
                            <span class="text-gray-600 text-sm">Sin imagen</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= date('d/m/Y', strtotime($post['CREATED_AT'])) ?></td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <a href="index.php?action=admin_edit_post&id=<?= $post['ID_POST'] ?>" 
                                   class="flex items-center gap-1 text-accent hover:text-cyan-300 text-sm transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Editar
                                </a>
                                <a href="index.php?action=admin_delete_post&id=<?= $post['ID_POST'] ?>" 
                                   onclick="return confirm('¿Eliminar este post? Esta acción no se puede deshacer.')"
                                   class="flex items-center gap-1 text-red-400 hover:text-red-300 text-sm transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Eliminar
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
