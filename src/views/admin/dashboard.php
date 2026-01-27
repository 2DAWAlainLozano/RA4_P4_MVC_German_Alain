<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mx-auto px-6 py-12 max-w-7xl">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white font-grotesk">Panel de Administración</h1>
        <p class="text-gray-500 mt-2">Gestiona usuarios, posts y comentarios desde aquí.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <a href="index.php?action=admin_users" class="bg-card/80 border border-gray-900 rounded-2xl p-6 backdrop-blur hover:border-accent/50 transition group">
            <p class="text-gray-500 text-sm uppercase tracking-widest">Usuarios</p>
            <p class="text-4xl font-bold text-white mt-2"><?= $userCount ?></p>
        </a>

        <a href="index.php?action=admin_posts" class="bg-card/80 border border-gray-900 rounded-2xl p-6 backdrop-blur hover:border-cyan-500/50 transition group">
            <p class="text-gray-500 text-sm uppercase tracking-widest">Posts</p>
            <p class="text-4xl font-bold text-white mt-2"><?= $postCount ?></p>
        </a>

        <a href="index.php?action=admin_comments" class="bg-card/80 border border-gray-900 rounded-2xl p-6 backdrop-blur hover:border-purple-500/50 transition group">
            <p class="text-gray-500 text-sm uppercase tracking-widest">Comentarios</p>
            <p class="text-4xl font-bold text-white mt-2"><?= $commentCount ?></p>
        </a>
    </div>

    <a href="index.php?action=posts" class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-accent transition">
        ← Volver al sitio
    </a>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
