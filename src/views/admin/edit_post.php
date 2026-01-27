<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mx-auto px-6 py-12 max-w-3xl">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white font-grotesk">Editar Post</h1>
            <p class="text-gray-500 mt-2">Modifica el título y contenido del post.</p>
        </div>
        <a href="index.php?action=admin_posts" class="flex items-center gap-2 text-sm text-gray-400 hover:text-accent transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Volver a posts
        </a>
    </div>

    <div class="bg-card/80 border border-gray-900 rounded-2xl p-8 backdrop-blur">
        <form method="POST" action="index.php?action=admin_update_post" class="space-y-6">
            <input type="hidden" name="id" value="<?= $post['ID_POST'] ?>">
            
            <div>
                <label for="title" class="block text-sm font-medium text-gray-400 mb-2">Título</label>
                <input type="text" name="title" id="title" value="<?= htmlspecialchars($post['TITLE']) ?>" required
                       class="w-full bg-dark border border-gray-800 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-accent focus:outline-none transition">
            </div>
            
            <div>
                <label for="content" class="block text-sm font-medium text-gray-400 mb-2">Contenido</label>
                <textarea name="content" id="content" rows="8" required
                          class="w-full bg-dark border border-gray-800 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-accent focus:outline-none transition resize-none"><?= htmlspecialchars($post['CONTENT']) ?></textarea>
            </div>

            <?php if (!empty($post['IMAGE_PATH'])): ?>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Imagen actual</label>
                <div class="w-32 h-32 rounded-xl overflow-hidden bg-dark border border-gray-800">
                    <img src="<?= htmlspecialchars($post['IMAGE_PATH']) ?>" alt="" class="w-full h-full object-cover">
                </div>
            </div>
            <?php endif; ?>
            
            <div class="flex items-center gap-4 pt-4">
                <button type="submit" class="px-6 py-3 bg-accent text-black font-semibold rounded-xl hover:bg-cyan-300 transition">
                    Guardar Cambios
                </button>
                <a href="index.php?action=admin_posts" class="px-6 py-3 border border-gray-800 text-gray-400 rounded-xl hover:border-gray-600 hover:text-white transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
