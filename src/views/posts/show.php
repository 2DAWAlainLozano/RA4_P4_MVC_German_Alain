<?php include __DIR__ . '/../layout/header.php'; ?>

    <main class="flex-grow container mx-auto px-4 py-8 max-w-6xl">
        
        <div class="flex items-center gap-4 text-xs font-semibold text-accent mb-2 uppercase tracking-wide">
            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v12a2 2 0 002 2z"></path></svg> <?= date('d/m/Y', strtotime($post['CREATED_AT'])) ?></span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-12">
            
            <div class="lg:col-span-2">
                <h1 class="text-4xl font-bold text-white mb-6 uppercase tracking-tight"><?= htmlspecialchars($post['TITLE']) ?></h1>

                <div class="w-full aspect-video rounded-3xl overflow-hidden bg-gray-900 mb-8 relative border border-gray-800">
                    <?php if (!empty($post['IMAGE_PATH'])): ?>
                        <img src="<?= htmlspecialchars($post['IMAGE_PATH']) ?>" alt="Captura" class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-20 h-20 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 border-y border-gray-900 py-6 mb-8 gap-6">
                    <div>
                        <p class="text-[10px] text-gray-600 font-bold uppercase tracking-widest mb-1">Autor</p>
                        <p class="text-white font-semibold flex items-center gap-2">
                             <span class="w-2 h-2 rounded-full bg-accent"></span>
                             <?= htmlspecialchars($post['author_name']) ?>
                        </p>
                    </div>
                </div>

                <div class="prose prose-invert max-w-none text-gray-400 text-lg leading-relaxed mb-12">
                    <?= nl2br(htmlspecialchars($post['CONTENT'])) ?>
                </div>

                <div class="bg-card border border-gray-900 rounded-3xl p-8 backdrop-blur-sm">
                    <h3 class="text-white font-bold text-xl mb-8 flex items-center gap-2">
                        Comentarios
                        <span class="text-xs bg-gray-800 text-gray-500 px-2 py-0.5 rounded-full"><?= count($comments) ?></span>
                    </h3>

                    <?php if (isset($_SESSION['user_id'])): ?>
                    <form action="index.php?action=add_comment" method="POST" class="mb-10">
                        <input type="hidden" name="csrf_token" value="<?= \Utils\Csrf::getToken() ?>">
                        <input type="hidden" name="post_id" value="<?= $post['ID_POST'] ?>">
                        <div class="flex gap-4">
                            <div class="flex-grow">
                                <textarea name="content" required placeholder="Escribe tu comentario..." class="w-full bg-dark/50 border border-gray-800 rounded-2xl p-4 text-white placeholder-gray-600 focus:outline-none focus:border-accent transition resize-none"></textarea>
                            </div>
                            <button type="submit" class="bg-accent text-black font-bold px-6 py-2 rounded-2xl hover:bg-cyan-300 transition h-fit self-end">Enviar</button>
                        </div>
                    </form>
                    <?php else: ?>
                    <div class="bg-dark/50 border border-gray-900 rounded-2xl p-6 text-center text-sm text-gray-500 mb-8 font-semibold">
                        Para comentar, <a href="index.php?action=login" class="text-accent hover:underline">inicia sesión</a>.
                    </div>
                    <?php endif; ?>

                    <div class="space-y-8">
                        <?php foreach ($comments as $comment): ?>
                        <div class="flex gap-4 group">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-700 to-gray-800 flex-shrink-0 border border-gray-700"></div>
                            <div class="flex-grow bg-dark/30 rounded-2xl p-4 border border-transparent group-hover:border-gray-900 transition">
                                <div class="flex items-baseline justify-between mb-2">
                                    <span class="font-bold text-white text-sm"><?= htmlspecialchars($comment['user_name'] ?? 'Pescador') ?></span>
                                    <span class="text-[10px] text-gray-600 font-bold uppercase tracking-widest"><?= date('d M Y', strtotime($comment['CREATED_AT'])) ?></span>
                                </div>
                                <p class="text-sm text-gray-400 italic leading-relaxed">“<?= nl2br(htmlspecialchars($comment['CONTENT'])) ?>”</p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php if (empty($comments)): ?>
                            <p class="text-gray-600 text-sm italic">Sé el primero en comentar esta captura...</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-6">
                <div class="flex justify-end gap-2">
                    <button class="px-5 py-2.5 bg-gray-800/50 border border-gray-800 rounded-xl text-xs font-bold text-white hover:bg-gray-800 transition">Compartir</button>
                    <button class="p-2.5 bg-gray-800/50 border border-gray-800 rounded-xl text-gray-400 hover:text-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                    </button>
                </div>

                <div class="bg-card border border-gray-900 rounded-3xl p-6 backdrop-blur">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-accent/20 to-cyan-500/20 border border-accent/10"></div>
                        <div>
                            <h3 class="text-white font-bold"><?= htmlspecialchars($post['author_name']) ?></h3>
                            <p class="text-xs text-gray-500">Miembro desde 2026</p>
                        </div>
                    </div>
                    <button class="w-full bg-accent/10 border border-accent/20 text-accent font-bold py-3 rounded-xl text-sm hover:bg-accent hover:text-black transition">
                        Seguir Pescador
                    </button>
                </div>
            </div>
        </div>
    </main>

<?php include __DIR__ . '/../layout/footer.php'; ?>
