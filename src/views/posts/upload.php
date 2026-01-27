<?php include __DIR__ . '/../layout/header.php'; ?>

    <main class="flex-grow container mx-auto px-4 py-20 max-w-4xl">
        
        <div class="mb-12">
            <h1 class="text-3xl font-bold text-white mb-2">Nueva Captura</h1>
            <p class="text-gray-500 text-sm">Comparte tu éxito con la comunidad de pescadores.</p>
        </div>

        <form action="index.php?action=store_post" method="POST" enctype="multipart/form-data" class="space-y-8">
            <div id="drop-zone" class="relative w-full h-64 border-2 border-dashed border-gray-800 rounded-xl bg-input/50 flex flex-col items-center justify-center hover:border-accent/40 hover:bg-input transition cursor-pointer group overflow-hidden">
                <input type="file" name="image" id="image-input" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" accept="image/*">
                
                <img id="image-preview" class="absolute inset-0 w-full h-full object-contain p-8 hidden z-10" alt="Preview">

                <div id="upload-placeholder" class="flex flex-col items-center justify-center pointer-events-none">
                    <div class="bg-gray-800 p-3 rounded-full mb-4 group-hover:scale-110 transition">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <p class="text-white font-medium text-sm mb-1">Añadir foto de la captura</p>
                    <p class="text-gray-600 text-xs uppercase tracking-wide">JPG, PNG o WEBP (Max 2MB)</p>
                </div>
            </div>

            <script>
                document.getElementById('image-input').addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    if (file) {
                        const preview = document.getElementById('image-preview');
                        preview.src = URL.createObjectURL(file);
                        preview.classList.remove('hidden');
                        document.getElementById('upload-placeholder').classList.add('hidden');
                    }
                });
            </script>

            <div class="space-y-6">
                <div class="flex flex-col gap-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Título de la captura</label>
                    <input type="text" name="title" required placeholder="Ej: Lubina gigante en el Delta" class="bg-input border border-gray-800 text-white text-sm rounded-lg focus:ring-1 focus:ring-accent focus:border-accent block w-full p-4 placeholder-gray-700 focus:outline-none transition">
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Relato y detalles</label>
                    <textarea name="content" rows="6" required placeholder="Cuéntanos cómo fue la jornada, el cebo usado, la lucha..." class="bg-input border border-gray-800 text-white text-sm rounded-lg focus:ring-1 focus:ring-accent focus:border-accent block w-full p-4 placeholder-gray-700 focus:outline-none transition resize-none"></textarea>
                </div>

                <div class="flex justify-center pt-10">
                    <button type="submit" class="bg-accent text-black font-extrabold py-4 px-20 rounded-xl hover:bg-cyan-300 transition shadow-[0_0_30px_rgba(34,211,238,0.15)] flex items-center gap-2">
                        Publicar Captura
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </div>
        </form>
    </main>

<?php include __DIR__ . '/../layout/footer.php'; ?>
