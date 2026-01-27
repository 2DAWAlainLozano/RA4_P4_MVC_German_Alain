<?php include __DIR__ . '/../layout/header.php'; ?>

    <main class="flex-grow flex items-center justify-center px-4 py-20">
        <div class="w-full max-w-md">
            
            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold text-white mb-2">Iniciar Sesión</h1>
                <p class="text-gray-500 text-sm">Bienvenido a la comunidad de pescadores</p>
            </div>

            <?php if (isset($error)): ?>
                <div class="bg-red-500/10 border border-red-500/20 text-red-500 p-4 rounded-lg mb-6 text-sm">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="index.php?action=login" method="POST" class="space-y-5">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Correo electrónico</label>
                    <input type="email" name="email" required placeholder="example@catchly.com" class="w-full bg-input border border-gray-800 rounded-lg px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent transition text-sm">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Contraseña</label>
                    <input type="password" name="password" required placeholder="••••••••" class="w-full bg-input border border-gray-800 rounded-lg px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent transition text-sm">
                </div>

                <button type="submit" class="w-full bg-accent text-black font-bold py-3 rounded-lg hover:bg-cyan-300 transition mt-2">
                    Iniciar Sesión
                </button>

                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600">
                        ¿No tienes cuenta? <a href="index.php?action=register" class="text-accent hover:underline">Regístrate</a>
                    </p>
                </div>
            </form>

            <div class="relative my-10">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-900"></div>
                </div>
                <div class="relative flex justify-center text-xs uppercase">
                    <span class="px-2 bg-dark text-gray-700 font-medium tracking-widest">o continuar con</span>
                </div>
            </div>

            <button class="w-full bg-input border border-gray-800 text-white font-medium py-3 rounded-lg hover:bg-gray-800 transition flex items-center justify-center gap-3 text-sm">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.26.81-.58z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                Google
            </button>
        </div>
    </main>

<?php include __DIR__ . '/../layout/footer.php'; ?>
