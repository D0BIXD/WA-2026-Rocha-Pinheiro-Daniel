<?php require_once '../app/views/layout/header.php'; ?>    

    <main class="container mx-auto px-6 py-12">
        
        <!-- Nadpis s moderním gradientem -->
        <div class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-4xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500">
                    Knižní katalog
                </h2>
                <p class="text-blue-500/80 font-medium mt-1">Správa a přehled dostupných titulů</p>
            </div>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="<?= BASE_URL ?>/index.php?url=book/create" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg shadow-lg shadow-blue-200 transition-all transform hover:-translate-y-0.5 font-semibold flex items-center">
                    <span class="mr-2">+</span> Přidat knihu
                </a>
            <?php endif; ?>
        </div>
        
        <!-- Hlavní karta s tabulkou -->
        <div class="bg-white border border-blue-100 rounded-2xl overflow-hidden shadow-xl shadow-blue-100/50">
            <?php if (empty($books)): ?>
                <div class="p-16 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-50 text-blue-400 rounded-full mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <p class="text-blue-900/60 font-medium italic">Katalog je momentálně prázdný.</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-blue-50/50 border-b border-blue-100">
                                <th class="px-6 py-5 font-bold uppercase text-xs text-blue-600 tracking-widest text-center w-16">ID</th>
                                <th class="px-6 py-5 font-bold uppercase text-xs text-blue-600 tracking-widest">Titul a Autor</th>
                                <th class="px-6 py-5 font-bold uppercase text-xs text-blue-600 tracking-widest text-center">Vydáno</th>
                                <th class="px-6 py-5 font-bold uppercase text-xs text-blue-600 tracking-widest text-right">Cena</th>
                                <th class="px-6 py-5 font-bold uppercase text-xs text-blue-600 tracking-widest text-center">Správa</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-blue-50">
                            <?php foreach ($books as $book): ?>
                                <tr class="hover:bg-blue-50/30 transition-all group">
                                    <td class="px-6 py-5 text-center text-blue-300 font-mono text-sm">#<?= htmlspecialchars($book['id']) ?></td>
                                    <td class="px-6 py-5">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition-colors">
                                                <?= htmlspecialchars($book['title']) ?>
                                            </span>
                                            <span class="text-slate-500 text-sm"><?= htmlspecialchars($book['author']) ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-bold border border-blue-100">
                                            <?= htmlspecialchars($book['year']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-right font-black text-blue-700">
                                        <?= number_format($book['price'], 0, ',', ' ') ?> Kč
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex justify-center items-center space-x-4">
                                            <a href="<?= BASE_URL ?>/index.php?url=book/show/<?= $book['id'] ?>" class="p-2 text-blue-400 hover:text-blue-600 hover:bg-blue-100 rounded-lg transition-all" title="Zobrazit detail">
                                                Detail
                                            </a>
                                            
                                            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $book['created_by']): ?>
                                                <div class="h-4 w-[1px] bg-blue-100"></div>
                                                <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>" class="p-2 text-amber-500 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-all" title="Upravit">
                                                    Upravit
                                                </a>
                                                <a href="<?= BASE_URL ?>/index.php?url=book/delete/<?= $book['id'] ?>" onclick="return confirm('Opravdu chcete tuto knihu smazat?')" class="p-2 text-rose-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" title="Smazat">
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