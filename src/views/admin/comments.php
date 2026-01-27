<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mx-auto px-6 py-12 max-w-7xl">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white font-grotesk">Gestión de Comentarios</h1>
            <p class="text-gray-500 mt-2">Modera y elimina comentarios.</p>
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
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-widest">Contenido</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-widest">Usuario</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-widest">Post</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-widest">Fecha</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-widest">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-900">
                    <?php foreach ($comments as $comment): ?>
                    <tr class="hover:bg-dark/40 transition">
                        <td class="px-6 py-4 text-sm text-gray-400">#<?= $comment['ID_COMMENT'] ?></td>
                        <td class="px-6 py-4">
                            <p class="text-white text-sm max-w-xs truncate"><?= htmlspecialchars(mb_strimwidth($comment['CONTENT'], 0, 60, '...')) ?></p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-gradient-to-br from-accent/60 to-cyan-500/40"></div>
                                <span class="text-gray-400 text-sm"><?= htmlspecialchars($comment['user_name']) ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <a href="index.php?action=show&id=<?= $comment['ID_POST'] ?>" class="text-accent hover:text-cyan-300 text-sm transition">
                                <?= htmlspecialchars(mb_strimwidth($comment['post_title'], 0, 30, '...')) ?>
                            </a>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= date('d/m/Y H:i', strtotime($comment['CREATED_AT'])) ?></td>
                        <td class="px-6 py-4">
                            <a href="index.php?action=admin_delete_comment&id=<?= $comment['ID_COMMENT'] ?>" 
                               onclick="return confirm('¿Eliminar este comentario? Esta acción no se puede deshacer.')"
                               class="flex items-center gap-1 text-red-400 hover:text-red-300 text-sm transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
