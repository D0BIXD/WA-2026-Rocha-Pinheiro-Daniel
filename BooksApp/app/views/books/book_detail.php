<?php require_once '../app/views/layout/header.php'; ?>

<main class="container mx-auto px-6 py-12 flex-grow">
    <div class="max-w-4xl mx-auto">
        
        <!-- Tlačítko zpět -->
        <div class="mb-8">
            <a href="<?= BASE_URL ?>/index.php" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-bold transition-all group">
                <span class="mr-2 transform group-hover:-translate-x-1 transition-transform">←</span> 
                Zpět na přehled knih
            </a>
        </div>

        <div class="bg-white border border-blue-100 rounded-3xl shadow-xl shadow-blue-100/50 overflow-hidden flex flex-col md:flex-row">
            
            <!-- Levá strana: Obrázek -->
            <div class="md:w-1/2 bg-blue-50/50 p-8 flex items-center justify-center border-r border-blue-50">
                <?php 
                // Dekódování JSONu z databáze
                $images = json_decode($book['images'], true);
                
                // Pokud to není JSON (např. starší záznam), zkusíme to vzít jako čistý řetězec v poli
                if (json_last_error() !== JSON_ERROR_NONE && !empty($book['images'])) {
                    $images = [$book['images']];
                }

                if (!empty($images) && is_array($images)): ?>
                    <!-- OPRAVA CESTY: Odstraněno /public/, pokud je v BASE_URL -->
                    <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($images[0]) ?>" 
                         alt="Obálka" 
                         class="rounded-2xl shadow-2xl max-h-[500px] w-auto object-contain">
                <?php else: ?>
                    <div class="text-blue-200 text-center">
                        <svg class="w-40 h-40 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <p class="mt-2 font-bold uppercase tracking-widest text-xs">Bez obálky</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Pravá strana: Informace -->
            <div class="md:w-1/2 p-8 md:p-12 flex flex-col">
                <div class="mb-2">
                    <span class="bg-blue-100 text-blue-700 text-[10px] font-black uppercase tracking-[0.2em] px-3 py-1 rounded-full">
                        Katalogové ID: #<?= $book['id'] ?>
                    </span>
                </div>

                <h1 class="text-4xl font-black text-slate-800 leading-tight mb-2"><?= htmlspecialchars($book['title']) ?></h1>
                <p class="text-xl text-blue-500 font-medium italic mb-8">by <?= htmlspecialchars($book['author']) ?></p>

                <div class="space-y-6 mb-10">
                    <div class="flex border-b border-blue-50 pb-4">
                        <div class="w-1/2">
                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Rok vydání</span>
                            <span class="text-slate-700 font-semibold"><?= htmlspecialchars($book['year']) ?></span>
                        </div>
                        <div class="w-1/2">
                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">ISBN</span>
                            <span class="text-slate-700 font-semibold"><?= htmlspecialchars($book['isbn'] ?: '---') ?></span>
                        </div>
                    </div>

                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Popis knihy</span>
                        <p class="text-slate-600 leading-relaxed italic">
                            <?= !empty($book['description']) ? nl2br(htmlspecialchars($book['description'])) : 'Tato kniha zatím nemá žádný popis.' ?>
                        </p>
                    </div>

                    <div class="bg-blue-50/50 rounded-2xl p-6 flex justify-between items-center">
                        <div>
                            <span class="block text-[10px] font-bold text-blue-900/40 uppercase tracking-widest mb-1">Cena v obchodě</span>
                            <span class="text-3xl font-black text-blue-600"><?= number_format($book['price'], 2, ',', ' ') ?> <small class="text-lg">Kč</small></span>
                        </div>
                        <?php if ($book['link']): ?>
                        <a href="<?= htmlspecialchars($book['link']) ?>" target="_blank" class="bg-white text-blue-600 border border-blue-200 hover:bg-blue-600 hover:text-white transition-all p-3 rounded-xl shadow-sm">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Akce pro majitele -->
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $book['created_by']): ?>
                <div class="mt-auto flex gap-3">
                    <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>" class="flex-1 text-center bg-slate-800 text-white font-bold py-3 rounded-xl hover:bg-slate-900 transition-all text-sm uppercase tracking-widest">
                        Upravit
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php require_once '../app/views/layout/footer.php'; ?>