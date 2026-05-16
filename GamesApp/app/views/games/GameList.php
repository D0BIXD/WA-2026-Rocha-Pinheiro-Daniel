<?php require_once '../app/views/layout/header.php'; ?>    

<main class="container mx-auto px-6 py-12">
    
    <div class="flex justify-between items-center mb-10">
        <div>
            <h2 class="text-4xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-500 uppercase">
                Herní katalog
            </h2>
            <p class="text-emerald-500/60 text-xs font-bold uppercase tracking-wider mt-1">Správa a přehled herních titulů ve Vaultu</p>
        </div>
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="<?= BASE_URL ?>/index.php?url=game/create" class="bg-emerald-600 hover:bg-emerald-500 text-slate-950 px-5 py-2.5 rounded-lg shadow-lg shadow-emerald-900/40 transition-all transform hover:-translate-y-0.5 font-black text-xs uppercase tracking-wider">
                + Přidat hru
            </a>
        <?php endif; ?>
    </div>
    
    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-2xl">
        <?php if (empty($games)): ?>
            <div class="p-12 text-center">
                <p class="text-slate-500 italic text-lg">Ve Vaultu zatím nejsou žádné hry.</p>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="<?= BASE_URL ?>/index.php?url=game/create" class="inline-block mt-4 text-xs font-black text-emerald-400 hover:text-emerald-300 uppercase tracking-widest">
                        Přidejte první hru hned teď!
                    </a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-950/60 border-b border-slate-800">
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 Union uppercase tracking-widest w-16">ID</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Název hry</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Vývojář</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Rok vydání</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Cena</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-right w-64">Akce</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60">
                        <?php foreach ($games as $game): ?>
                            <tr class="hover:bg-slate-950/40 transition-colors group">
                                <td class="px-6 py-4 text-sm font-bold text-slate-600"><?= htmlspecialchars($game['id']) ?></td>
                                
                                <td class="px-6 py-4 text-sm font-bold text-slate-200 group-hover:text-emerald-400 transition-colors">
                                    <?= htmlspecialchars($game['title']) ?>
                                </td>
                                
                                <td class="px-6 py-4 text-sm font-medium text-slate-400"><?= htmlspecialchars($game['developer']) ?></td>
                                
                                <td class="px-6 py-4 text-sm font-medium text-slate-400"><?= htmlspecialchars($game['year']) ?></td>
                                
                                <td class="px-6 py-4 text-sm font-black text-emerald-400">
                                    <?= number_format($game['price'], 0, ',', ' ') ?> Kč
                                </td>
                                
                                <td class="px-6 py-4 text-sm font-bold text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        
                                        <a href="<?= BASE_URL ?>/index.php?url=game/show/<?= $game['id'] ?>" 
                                           class="p-2 text-xs text-emerald-400 hover:text-emerald-300 hover:bg-slate-950 rounded-lg transition-all uppercase tracking-wider" title="Detail hry">
                                            Detail
                                        </a>

                                        <?php 
                                        $isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
                                        $isLoggedIn = isset($_SESSION['user_id']);
                                        $isAuthor = $isLoggedIn && $_SESSION['user_id'] === $game['created_by'];

                                        if ($isAuthor || $isAdmin): 
                                        ?>
                                            <div class="h-4 w-[1px] bg-slate-800"></div>
                                            
                                            <a href="<?= BASE_URL ?>/index.php?url=game/edit/<?= $game['id'] ?>" 
                                               class="p-2 text-xs text-amber-500 hover:text-amber-400 hover:bg-slate-950 rounded-lg transition-all uppercase tracking-wider" title="Upravit">
                                                Upravit
                                            </a>
                                            
                                            <a href="<?= BASE_URL ?>/index.php?url=game/delete/<?= $game['id'] ?>" 
                                               onclick="return confirm('Opravdu chcete tuto hru smazat z Vaultu?')" 
                                               class="p-2 text-xs text-rose-500 hover:text-rose-400 hover:bg-slate-950 rounded-lg transition-all uppercase tracking-wider" title="Smazat">
                                                Smazat
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php require_once '../app/views/layout/footer.php'; ?>