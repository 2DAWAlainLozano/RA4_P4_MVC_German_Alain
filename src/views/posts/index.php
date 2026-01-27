<?php include __DIR__ . '/../layout/header.php'; ?>

    <main class="flex-grow container mx-auto px-4 pb-16 pt-4 max-w-7xl relative z-10">
        <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">
            <aside class="space-y-6 xl:col-span-1">
                <div class="bg-card/80 border border-gray-900 rounded-2xl p-6 backdrop-blur">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-accent/60 to-cyan-500/40"></div>
                        <div>
                            <p class="text-xs uppercase tracking-widest text-gray-500">Tu perfil</p>
                            <h2 class="text-white font-semibold text-lg"><?= htmlspecialchars($_SESSION['user_name']) ?></h2>
                            <p class="text-gray-500 text-sm"><?= htmlspecialchars($_SESSION['user_role'] ?? 'Fisherman') ?></p>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3 text-center text-xs">
                        <div class="bg-dark/60 rounded-lg py-3 border border-gray-900">
                            <p class="text-gray-500 uppercase">Capturas</p>
                            <p class="text-white text-xl font-semibold"><?= count($posts) ?></p>
                        </div>
                        <div class="bg-dark/60 rounded-lg py-3 border border-gray-900">
                            <p class="text-gray-500 uppercase">Seguidores</p>
                            <p class="text-white text-xl font-semibold">0</p>
                        </div>
                        <div class="bg-dark/60 rounded-lg py-3 border border-gray-900">
                            <p class="text-gray-500 uppercase">Siguiendo</p>
                            <p class="text-white text-xl font-semibold">0</p>
                        </div>
                    </div>
                </div>

                <div class="bg-card/80 border border-gray-900 rounded-2xl p-6 space-y-4 backdrop-blur">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-white">Tendencias</h3>
                        <span class="text-[10px] uppercase tracking-widest text-gray-500">Semana <?= date('W') ?></span>
                    </div>
                    <div class="space-y-4 text-sm">
                        <div class="flex items-center justify-between text-gray-400 italic">
                            Próximamente...
                        </div>
                    </div>
                </div>
            </aside>

            <section class="xl:col-span-2 space-y-8">
                <div class="bg-card/80 border border-gray-900 rounded-2xl p-6 backdrop-blur">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gray-700"></div>
                        <a href="index.php?action=upload" class="flex-grow bg-dark/70 border border-gray-800 rounded-full px-5 py-3 text-gray-600 text-sm hover:border-accent transition">
                            Comparte la captura de tu vida...
                        </a>
                        <a href="index.php?action=upload" class="bg-accent text-black font-semibold text-sm px-5 py-2 rounded-full hover:bg-cyan-300 transition duration-200">Publicar</a>
                    </div>
                </div>

                <?php foreach ($posts as $post): ?>
                <article class="bg-card/80 border border-gray-900 rounded-3xl overflow-hidden shadow-[0_20px_60px_rgba(0,0,0,0.35)]">
                    <div class="flex items-center justify-between px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-full bg-gradient-to-br from-cyan-500 to-accent"></div>
                            <div>
                                <p class="text-white font-semibold"><?= htmlspecialchars($post['author_name']) ?></p>
                                <p class="text-gray-500 text-xs"><?= date('d M Y', strtotime($post['CREATED_AT'])) ?></p>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($post['IMAGE_URL'])): ?>
                    <div class="aspect-video overflow-hidden relative">
                        <img src="<?= htmlspecialchars($post['IMAGE_URL']) ?>" alt="Captura" class="w-full h-full object-cover">
                    </div>
                    <?php else: ?>
                    <div class="aspect-video bg-dark/50 flex items-center justify-center border-y border-gray-900">
                        <svg class="w-12 h-12 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <?php endif; ?>
                    <div class="px-6 py-6 space-y-4">
                        <h4 class="text-white font-bold text-xl"><?= htmlspecialchars($post['TITLE']) ?></h4>
                        <p class="text-gray-400 text-sm leading-relaxed"><?= nl2br(htmlspecialchars($post['CONTENT'])) ?></p>
                        
                        <div class="flex items-center justify-between text-xs font-semibold text-gray-500">
                            <div class="flex items-center gap-4">
                                <button class="flex items-center gap-1 hover:text-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                    0
                                </button>
                                <a href="index.php?action=show&id=<?= $post['ID_POST'] ?>" class="flex items-center gap-1 hover:text-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.86 9.86 0 01-4-.832L3 20l1.268-3.176C3.45 15.604 3 13.853 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                    Comentarios
                                </a>
                            </div>
                            <a href="index.php?action=show&id=<?= $post['ID_POST'] ?>" class="text-accent hover:underline">Ver detalle</a>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
            </section>

            <aside class="space-y-6 xl:col-span-1">
                <div class="bg-card/80 border border-gray-900 rounded-2xl p-6 backdrop-blur space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-white">Eventos cercanos</h3>
                        <button class="text-xs text-accent">Ver todo</button>
                    </div>
                    <div class="space-y-4 text-sm text-gray-500 italic">
                        No hay eventos próximos.
                    </div>
                </div>
            </aside>
        </div>
    </main>

<?php include __DIR__ . '/../layout/footer.php'; ?>
