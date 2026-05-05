<?php require_once '../app/views/layout/header.php'; ?>

<main class="container mx-auto px-6 py-12 flex-grow flex items-center justify-center">
    <div class="w-full max-w-2xl">
        <!-- Nadpis a podnadpis -->
        <div class="mb-8 text-center">
            <h2 class="text-4xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500 uppercase">
                Nová registrace
            </h2>
            <p class="text-blue-500/80 font-medium mt-1 uppercase tracking-tighter text-xs">Vytvořte si účet pro správu vašeho knižního katalogu</p>
        </div>
        
        <!-- Karta formuláře -->
        <div class="bg-white border border-blue-100 rounded-2xl shadow-xl shadow-blue-100/50 p-8 md:p-10">
            <form action="<?= BASE_URL ?>/index.php?url=auth/storeUser" method="post">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Sekce: Přihlašovací údaje -->
                    <div class="md:col-span-2">
                        <h3 class="text-blue-600 text-xs font-bold uppercase tracking-widest border-b border-blue-50 pb-2 mb-2">Přihlašovací údaje</h3>
                    </div>

                    <div>
                        <label for="username" class="block text-xs font-bold text-blue-900/40 mb-2 uppercase tracking-widest">Uživatelské jméno <span class="text-rose-500">*</span></label>
                        <input type="text" id="username" name="username" required 
                               placeholder="např. kniho_mol"
                               class="w-full bg-blue-50/30 border border-blue-100 rounded-xl px-5 py-3 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-400/10 transition-all">
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold text-blue-900/40 mb-2 uppercase tracking-widest">E-mail <span class="text-rose-500">*</span></label>
                        <input type="email" id="email" name="email" required 
                               placeholder="vas@email.cz"
                               class="w-full bg-blue-50/30 border border-blue-100 rounded-xl px-5 py-3 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-400/10 transition-all">
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-bold text-blue-900/40 mb-2 uppercase tracking-widest">Heslo <span class="text-rose-500">*</span></label>
                        <input type="password" id="password" name="password" required 
                               placeholder="••••••••"
                               class="w-full bg-blue-50/30 border border-blue-100 rounded-xl px-5 py-3 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-400/10 transition-all">
                    </div>

                    <div>
                        <label for="password_confirm" class="block text-xs font-bold text-blue-900/40 mb-2 uppercase tracking-widest">Potvrzení hesla <span class="text-rose-500">*</span></label>
                        <input type="password" id="password_confirm" name="password_confirm" required 
                               placeholder="••••••••"
                               class="w-full bg-blue-50/30 border border-blue-100 rounded-xl px-5 py-3 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-400/10 transition-all">
                    </div>

                    <!-- Sekce: Osobní údaje -->
                    <div class="md:col-span-2 mt-4">
                        <h3 class="text-blue-600 text-xs font-bold uppercase tracking-widest border-b border-blue-50 pb-2 mb-2">Osobní údaje (Volitelné)</h3>
                    </div>

                    <div>
                        <label for="first_name" class="block text-xs font-bold text-blue-900/40 mb-2 uppercase tracking-widest">Křestní jméno</label>
                        <input type="text" id="first_name" name="first_name" 
                               placeholder="Jan"
                               class="w-full bg-blue-50/30 border border-blue-100 rounded-xl px-5 py-3 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-400/10 transition-all">
                    </div>

                    <div>
                        <label for="last_name" class="block text-xs font-bold text-blue-900/40 mb-2 uppercase tracking-widest">Příjmení</label>
                        <input type="text" id="last_name" name="last_name" 
                               placeholder="Novák"
                               class="w-full bg-blue-50/30 border border-blue-100 rounded-xl px-5 py-3 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-400/10 transition-all">
                    </div>

                    <div class="md:col-span-2">
                        <label for="nickname" class="block text-xs font-bold text-blue-900/40 mb-2 uppercase tracking-widest">Zobrazovaná přezdívka</label>
                        <input type="text" id="nickname" name="nickname" placeholder="Jak vám máme v aplikaci říkat?"
                               class="w-full bg-blue-50/30 border border-blue-100 rounded-xl px-5 py-3 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-400/10 transition-all">
                    </div>

                    <!-- Tlačítka a akce -->
                    <div class="md:col-span-2 mt-8">
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black py-4 px-4 rounded-xl shadow-lg shadow-blue-200 transition-all uppercase tracking-widest text-sm transform hover:-translate-y-1 active:scale-95">
                            Vytvořit účet
                        </button>
                        
                        <div class="text-center border-t border-blue-50 pt-6 mt-6">
                            <p class="text-slate-500 text-sm">
                                Už máte účet? 
                                <a href="<?= BASE_URL ?>/index.php?url=auth/login" class="text-blue-600 hover:text-blue-800 font-bold transition-colors ml-1 underline underline-offset-4 decoration-blue-200 hover:decoration-blue-500">
                                    Přihlaste se zde
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Zpět na úvod -->
        <div class="text-center mt-8">
            <a href="<?= BASE_URL ?>/index.php" class="text-blue-400 hover:text-blue-600 text-xs font-bold uppercase tracking-widest transition-all">
                ← Zpět na úvodní stranu
            </a>
        </div>
    </div>
</main>

<?php require_once '../app/views/layout/footer.php'; ?>