<?php require_once '../app/views/layout/header.php'; ?>

<main class="container mx-auto px-6 py-12 flex-grow">
    <div class="max-w-md mx-auto">
        
        <div class="mb-6">
            <h2 class="text-2xl font-black uppercase text-emerald-500 tracking-tight gaming-font">Nastavení Účtu</h2>
            <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mt-1">
                Zde můžeš změnit své herní jméno nebo přístupové heslo
            </p>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 shadow-2xl">
            <form action="<?= BASE_URL ?>/index.php?url=user/update" method="post" class="space-y-5">
                
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Uživatelské jméno</label>
                    <input type="text" name="nickname" required 
       value="<?= htmlspecialchars((string)($_SESSION['user_name'] ?? '')) ?>"
                           class="w-full bg-slate-950 border border-slate-800 rounded-lg px-4 py-3 text-slate-200 text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Nové Heslo</label>
                    <input type="password" name="password" 
                           placeholder="••••••••"
                           class="w-full bg-slate-950 border border-slate-800 rounded-lg px-4 py-3 text-slate-200 text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                    <p class="text-[10px] text-slate-500 mt-1.5 italic">Ponech prázdné, pokud heslo nechceš měnit.</p>
                </div>

                <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black py-3 rounded-lg text-xs uppercase tracking-widest transition-all transform hover:-translate-y-0.5 shadow-lg shadow-emerald-950/50">
                    Uložit změny
                </button>
            </form>
        </div>

    </div>
</main>

<?php require_once '../app/views/layout/footer.php'; ?>