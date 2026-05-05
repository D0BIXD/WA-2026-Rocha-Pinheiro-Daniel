<?php require_once '../app/views/layout/header.php'; ?>

<main class="container mx-auto px-6 py-12 flex-grow flex items-center justify-center">
    <div class="w-full max-w-md">
        <!-- Nadpis a podnadpis -->
        <div class="mb-8 text-center">
            <h2 class="text-4xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500 uppercase">
                Přihlášení
            </h2>
            <p class="text-blue-500/80 font-medium mt-1 uppercase tracking-tighter text-xs">Vítejte zpět v naší knihovně</p>
        </div>
        
        <!-- Karta formuláře -->
        <div class="bg-white border border-blue-100 rounded-2xl shadow-xl shadow-blue-100/50 p-8 md:p-10">
            <form action="<?= BASE_URL ?>/index.php?url=auth/authenticate" method="post">
                
                <div class="space-y-6">
                    <!-- E-mail -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-blue-900/40 mb-2 uppercase tracking-widest">E-mail</label>
                        <input type="email" id="email" name="email" required autofocus
                               placeholder="jmeno@priklad.cz"
                               class="w-full bg-blue-50/30 border border-blue-100 rounded-xl px-5 py-3 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-400/10 transition-all">
                    </div>

                    <!-- Heslo -->
                    <div>
                        <label for="password" class="block text-xs font-bold text-blue-900/40 mb-2 uppercase tracking-widest">Heslo</label>
                        <input type="password" id="password" name="password" required 
                               placeholder="••••••••"
                               class="w-full bg-blue-50/30 border border-blue-100 rounded-xl px-5 py-3 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-400/10 transition-all">
                    </div>

                    <!-- Tlačítko Přihlásit se -->
                    <div class="pt-2">
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black py-4 px-4 rounded-xl shadow-lg shadow-blue-200 transition-all uppercase tracking-widest text-sm transform hover:-translate-y-1 active:scale-95">
                            Vstoupit do knihovny
                        </button>
                    </div>
                    
                    <!-- Registrace a rozdělovník -->
                    <div class="text-center border-t border-blue-50 pt-6 mt-6">
                        <p class="text-slate-500 text-sm">
                            Nemáte ještě účet? 
                            <a href="<?= BASE_URL ?>/index.php?url=auth/register" class="text-blue-600 hover:text-blue-800 font-bold transition-colors ml-1 underline underline-offset-4 decoration-blue-200 hover:decoration-blue-500">
                                Zaregistrujte se
                            </a>
                        </p>
                    </div>
                </div>
            </form>
        </div>

        <!-- Odkaz na hlavní stranu (volitelné) -->
        <div class="text-center mt-8">
            <a href="<?= BASE_URL ?>/index.php" class="text-blue-400 hover:text-blue-600 text-xs font-bold uppercase tracking-widest transition-all">
                ← Zpět na hlavní výpis
            </a>
        </div>
    </div>
</main>

<?php require_once '../app/views/layout/footer.php'; ?>