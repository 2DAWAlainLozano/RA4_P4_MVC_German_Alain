<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catchly - Donde la pesca cobra vida</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dark: '#050505',
                        card: '#101010',
                        input: '#0f1011',
                        accent: '#22d3ee',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        grotesk: ['Space Grotesk', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-grotesk { font-family: 'Space Grotesk', sans-serif; }
    </style>
</head>
<body class="bg-dark text-gray-300 min-h-screen flex flex-col relative overflow-x-hidden">

    <!-- Background Glows -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="w-96 h-96 bg-accent/10 blur-[120px] rounded-full absolute -top-32 -left-16"></div>
        <div class="w-64 h-64 bg-cyan-500/10 blur-[120px] rounded-full absolute bottom-0 right-0"></div>
    </div>

    <nav class="flex items-center justify-between px-6 py-6 container mx-auto max-w-7xl relative z-50">
        <div class="flex items-center gap-8">
            <a href="index.php?action=posts" class="flex items-center gap-2 text-white font-bold text-xl tracking-wide">
                <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Catchly
            </a>
            <div class="hidden md:flex gap-6 text-sm font-semibold text-gray-500">
                <a href="index.php?action=posts" class="hover:text-white transition <?= (!isset($_GET['action']) || $_GET['action'] == 'posts') ? 'text-accent' : '' ?>">Explorar</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="index.php?action=upload" class="hover:text-white transition <?= (isset($_GET['action']) && $_GET['action'] == 'upload') ? 'text-accent' : '' ?>">Subir</a>
                    <a href="#" class="hover:text-white transition">Mis Capturas</a>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="flex items-center gap-6 text-sm font-semibold">
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="flex items-center gap-4">
                    <div class="hidden md:block text-right">
                        <p class="text-white text-xs font-bold leading-none"><?= htmlspecialchars($_SESSION['user_name']) ?></p>
                        <p class="text-[10px] text-accent uppercase tracking-widest mt-1"><?= htmlspecialchars($_SESSION['user_role'] ?? 'Fisherman') ?></p>
                    </div>
                    <a href="index.php?action=logout" class="text-gray-500 hover:text-white transition">Salir</a>
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-accent/60 to-cyan-500/40 border border-white/10"></div>
                </div>
            <?php else: ?>
                <a href="index.php?action=login" class="text-gray-400 hover:text-white transition">Iniciar sesión</a>
                <a href="index.php?action=register" class="text-accent hover:text-cyan-300 transition px-4 py-2 border border-accent/20 rounded-lg bg-accent/5">Registrarse</a>
            <?php endif; ?>
        </div>
    </nav>

    <main class="flex-grow relative z-10 w-full">