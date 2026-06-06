<?php require_once '../app/views/layout/header.php'; ?>

<main class="container mx-auto px-6 py-12 flex-grow">
    <div class="max-w-2xl mx-auto">
        
        <div class="mb-6 flex justify-between items-end">
            <div>
                <h2 class="text-2xl font-black uppercase text-amber-500 tracking-tight">Upravit Log</h2>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mt-1">
                    Editace vašeho osobního postřehu
                </p>
            </div>
            <a href="<?= BASE_URL ?>/index.php?url=game/show/<?= $comment['game_id'] ?>" class="text-xs text-slate-400 hover:text-emerald-400 font-bold uppercase tracking-wider transition-colors flex items-center group">
                <span class="mr-1.5 transform group-hover:-translate-x-0.5 transition-transform">←</span> Zpět
            </a>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-8 shadow-2xl">
            <form action="<?= BASE_URL ?>/index.php?url=game/updateComment/<?= $comment['id'] ?>" method="post">
                
                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Obsah logu</label>
                <textarea name="content" required rows="5" 
                          class="w-full bg-slate-950 border border-slate-800 rounded-xl p-4 text-slate-200 text-sm focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-all mb-6"><?= htmlspecialchars($comment['content']) ?></textarea>

                <button type="submit" class="w-full bg-amber-600 hover:bg-amber-500 text-slate-950 font-black py-3 rounded text-sm uppercase tracking-wider transition-all transform hover:-translate-y-0.5 shadow-lg shadow-amber-900/20">
                    Přepsat záznam v databázi
                </button>
            </form>
        </div>
    </div>
</main>

<?php require_once '../app/views/layout/footer.php'; ?>