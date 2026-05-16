<?php require_once '../app/views/layout/header.php'; ?>

<main class="container mx-auto px-6 py-12 flex-grow">
    <div class="max-w-2xl mx-auto">
        
        <div class="mb-6 flex justify-between items-end">
            <div>
                <h2 class="text-2xl font-black uppercase text-emerald-400 tracking-tight">Upravit Hru</h2>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mt-1">
                    Editujete záznam: <span class="text-emerald-500/80"><?= htmlspecialchars($game['title']) ?></span>
                </p>
            </div>
            <a href="<?= BASE_URL ?>/index.php" class="text-xs text-slate-400 hover:text-emerald-400 font-bold uppercase tracking-wider transition-colors flex items-center group">
                <span class="mr-1.5 transform group-hover:-translate-x-0.5 transition-transform">←</span> Zpět
            </a>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-8 shadow-2xl">
            <form action="<?= BASE_URL ?>/index.php?url=game/update/<?= $game['id'] ?>" method="post" enctype="multipart/form-data" class="space-y-5">
                
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Název Hry</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($game['title']) ?>" required 
                           class="w-full bg-slate-950 border border-slate-800 rounded p-3 text-slate-200 text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Vývojář (Developer)</label>
                        <input type="text" name="developer" value="<?= htmlspecialchars($game['developer']) ?>" required 
                               class="w-full bg-slate-950 border border-slate-800 rounded p-3 text-slate-200 text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Žánrová Kategorie</label>
                        <select name="category_id" required 
                                class="w-full bg-slate-950 border border-slate-800 rounded p-3 text-slate-200 text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all cursor-pointer">
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $game['category_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Rok vydání</label>
                        <input type="number" name="year" value="<?= htmlspecialchars($game['year']) ?>" required 
                               class="w-full bg-slate-950 border border-slate-800 rounded p-3 text-slate-200 text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Cena (Kč)</label>
                        <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($game['price']) ?>" required 
                               class="w-full bg-slate-950 border border-slate-800 rounded p-3 text-slate-200 text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Popis hry</label>
                    <textarea name="description" rows="4" 
                              class="w-full bg-slate-950 border border-slate-800 rounded p-3 text-slate-200 text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all"><?= htmlspecialchars($game['description'] ?? '') ?></textarea>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Změnit Obrázek / Cover</label>
                    <div class="bg-slate-950 border border-slate-800 rounded p-4 flex flex-col items-start gap-2">
                        <input type="file" id="images" name="images[]" class="hidden">
                        <label id="file-label" for="images" class="bg-slate-800 hover:bg-slate-700 border border-slate-700 hover:border-emerald-500 text-emerald-400 px-4 py-2 rounded text-xs font-black uppercase tracking-wider cursor-pointer transition-all">
                            Vybrat nový soubor
                        </label>
                        <div class="mt-1">
                            <p id="file-title" class="text-xs font-bold text-slate-400 uppercase">Ponechte prázdné</p>
                            <p id="file-info" class="text-[10px] text-slate-500 uppercase tracking-wide">Pokud nechcete současný obal měnit</p>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-slate-950 font-black py-3.5 rounded text-sm uppercase tracking-wider transition-all transform hover:-translate-y-0.5 active:translate-y-0 shadow-lg shadow-emerald-900/20 mt-4">
                    Uložit změny do Vaultu
                </button>
            </form>
        </div>
    </div>
</main>

<script>
    const fileInput = document.getElementById('images');
    const fileTitle = document.getElementById('file-title');
    const fileInfo = document.getElementById('file-info');
    const fileLabel = document.getElementById('file-label');

    fileInput.addEventListener('change', function(event) {
        const files = event.target.files;
        if (files.length === 0) {
            fileTitle.textContent = 'Ponechte prázdné';
            fileInfo.textContent = 'Pokud nechcete současný obal měnit';
            fileTitle.className = 'text-xs font-bold text-slate-400 uppercase';
            fileLabel.className = 'bg-slate-800 hover:bg-slate-700 border border-slate-700 hover:border-emerald-500 text-emerald-400 px-4 py-2 rounded text-xs font-black uppercase tracking-wider cursor-pointer transition-all';
        } else {
            fileTitle.textContent = files.length === 1 ? 'Nová obálka připravena' : 'Soubory připraveny';
            fileTitle.className = 'text-xs font-black text-emerald-400 uppercase tracking-wide';
            fileInfo.textContent = files.length === 1 ? files[0].name : 'Vybráno celkem: ' + files.length + ' souborů';
            fileLabel.className = 'bg-emerald-950/40 hover:bg-emerald-900/40 border border-emerald-800 text-emerald-400 px-4 py-2 rounded text-xs font-black uppercase tracking-wider cursor-pointer transition-all';
        }
    });
</script>

<?php require_once '../app/views/layout/footer.php'; ?>