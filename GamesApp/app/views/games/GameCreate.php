<?php require_once '../app/views/layout/header.php'; ?>

<div class="max-w-2xl mx-auto">
    <div class="mb-6 flex justify-between items-end">
        <div>
            <h2 class="text-2xl font-black uppercase text-emerald-400">Přidat Hru</h2>
            <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Uložení nového kousku do databáze</p>
        </div>
        <a href="<?= BASE_URL ?>/index.php" class="text-xs text-slate-400 hover:text-emerald-400 font-bold uppercase tracking-wider">← Zpět</a>
    </div>

    <div class="bg-slate-900 border border-slate-800 rounded-xl p-8 shadow-2xl">
        <form action="<?= BASE_URL ?>/index.php?url=game/store" method="post" enctype="multipart/form-data" class="space-y-5">
            <div>
                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Název Hry</label>
                <input type="text" name="title" required class="w-full bg-slate-950 border border-slate-800 rounded p-3 text-slate-200 text-sm focus:outline-none focus:border-emerald-500">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Vývojář (Developer)</label>
                    <input type="text" name="developer" required class="w-full bg-slate-950 border border-slate-800 rounded p-3 text-slate-200 text-sm focus:outline-none focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Žánrová Kategorie</label>
                    <select name="category_id" required class="w-full bg-slate-950 border border-slate-800 rounded p-3 text-slate-200 text-sm focus:outline-none focus:border-emerald-500">
                        <option value="">-- Vyberte --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Rok vydání</label>
                    <input type="number" name="year" required class="w-full bg-slate-950 border border-slate-800 rounded p-3 text-slate-200 text-sm focus:outline-none focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Cena (Kč)</label>
                    <input type="number" step="0.01" name="price" required class="w-full bg-slate-950 border border-slate-800 rounded p-3 text-slate-200 text-sm focus:outline-none focus:border-emerald-500">
                </div>
            </div>

            <div>
                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Popis hry</label>
                <textarea name="description" rows="4" class="w-full bg-slate-950 border border-slate-800 rounded p-3 text-slate-200 text-sm focus:outline-none focus:border-emerald-500"></textarea>
            </div>

            <div>
                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Obrázek / Cover</label>
                <input type="file" name="images[]" class="text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-bold file:bg-slate-950 file:text-emerald-400 hover:file:bg-slate-800 cursor-pointer">
            </div>

            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-slate-950 font-black py-3 rounded text-sm uppercase tracking-wider transition-colors mt-4">
                Uložit hru do Vaultu
            </button>
        </form>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>