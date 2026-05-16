<?php require_once '../app/views/layout/header.php'; ?>

<?php 
// Pojistka proti prázdným datům
if (!isset($game) || !$game) {
    echo "<div class='max-w-2xl mx-auto p-10 text-center bg-slate-900 border border-slate-800 rounded-xl'>";
    echo "<h1 class='text-2xl font-black uppercase text-rose-500 mb-2'>Hra nenalezena!</h1>";
    echo "<p class='text-slate-400 text-sm mb-6 uppercase tracking-wider font-bold'>Zkontrolujte platnost ID v databázi.</p>";
    echo "<a href='".BASE_URL."/index.php' class='inline-block bg-emerald-600 hover:bg-emerald-500 text-slate-950 px-6 py-2.5 rounded font-black text-xs uppercase tracking-wider transition-colors'>Zpět do Vaultu</a></div>";
    require_once '../app/views/layout/footer.php';
    exit;
}

// DEKÓDOVÁNÍ OBRÁZKŮ: Převod JSON textu z DB na PHP pole
$images = json_decode($game['images'] ?? '[]', true);
?>

<div class="max-w-4xl mx-auto py-6">
    
    <div class="mb-6 flex justify-end">
        <a href="<?= BASE_URL ?>/index.php" class="text-xs text-slate-400 hover:text-emerald-400 font-bold uppercase tracking-wider transition-colors flex items-center group">
            <span class="mr-1.5 transform group-hover:-translate-x-0.5 transition-transform">←</span> Zpět do katalogu
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start mb-10">
        
        <div class="md:col-span-1">
            <div class="bg-slate-900 border border-slate-800 rounded-xl p-3 shadow-2xl">
                <?php if (!empty($images)): ?>
                    <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($images[0]) ?>" 
                         alt="Obal hry <?= htmlspecialchars($game['title']) ?>" 
                         class="w-full h-auto object-cover rounded border border-slate-800 transition-all duration-300 hover:border-emerald-500/50 shadow-inner">
                <?php else: ?>
                    <div class="w-full aspect-[3/4] bg-slate-950 border border-dashed border-slate-800 rounded flex flex-col items-center justify-center text-slate-600 p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 mb-2 text-slate-700">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        <span class="text-[9px] font-black uppercase tracking-widest text-slate-500 text-center">NO COVER DETECTED</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="md:col-span-2 bg-slate-900 border border-slate-800 rounded-xl p-8 shadow-2xl space-y-6">
            
            <div class="flex justify-between items-center border-b border-slate-800 pb-4">
                <div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-emerald-500 bg-emerald-950/50 border border-emerald-900/50 px-2.5 py-1 rounded">
                        DATA ID: <?= htmlspecialchars($game['id']) ?>
                    </span>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Developer</p>
                    <p class="text-sm font-black text-slate-200 uppercase tracking-wide"><?= htmlspecialchars($game['developer']) ?></p>
                </div>
            </div>

            <div>
                <h1 class="text-3xl font-black uppercase tracking-tight text-slate-100">
                    <?= htmlspecialchars($game['title']) ?>
                </h1>
            </div>

            <div class="grid grid-cols-2 gap-4 bg-slate-950 border border-slate-800 rounded p-4">
                <div>
                    <span class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider">Rok vydání</span>
                    <span class="text-sm font-black text-slate-300"><?= htmlspecialchars($game['year']) ?></span>
                </div>
                <div>
                    <span class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider">Hodnota ve Vaultu</span>
                    <span class="text-sm font-black text-emerald-400"><?= number_format($game['price'], 0, ',', ' ') ?> Kč</span>
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-2">Popis záznamu (Description)</label>
                <div class="bg-slate-950 border border-slate-800 rounded p-4 text-slate-400 text-sm leading-relaxed whitespace-pre-line">
                    <?= htmlspecialchars($game['description'] ?? 'K tomuto titulu nebyl do systému zaveden žádný podrobný popis.') ?>
                </div>
            </div>

        </div>
    </div>

    <div class="max-w-2xl border-t border-slate-800 pt-8">
        <div class="mb-6">
            <h3 class="text-lg font-black uppercase text-emerald-400 tracking-tight">Hráčské logy</h3>
            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Vaše osobní poznámky a postřehy k titulu</p>
        </div>

        <form action="<?= BASE_URL ?>/index.php?url=game/addComment/<?= $game['id'] ?>" method="post" class="mb-8">
            <textarea name="content" required placeholder="Zadejte log (např. splněné achievementy, herní doba, hodnocení...)" 
                class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 placeholder-slate-600 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all text-sm mb-3" rows="3"></textarea>
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-slate-950 font-black px-5 py-2.5 rounded text-xs uppercase tracking-widest transition-colors shadow-lg shadow-emerald-900/10">
                Uložit záznam do logu
            </button>
        </form>

        <div class="space-y-4">
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="bg-slate-900 border-l-2 border-l-emerald-500 border-y-slate-800 border-r-slate-800 rounded-r-xl p-4 shadow-md">
                        <p class="text-slate-300 text-sm leading-relaxed"><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
                        <div class="mt-3 text-[9px] font-bold text-slate-500 uppercase tracking-widest">
                            TIMESTAMP: <?= date('d. m. Y | H:i', strtotime($comment['created_at'])) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="bg-slate-900/40 border border-slate-800 rounded-xl p-6 text-center">
                    <p class="text-slate-600 italic text-sm font-medium uppercase tracking-wider">Log je prázdný. Žádné záznamy k této hře.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

<?php require_once '../app/views/layout/footer.php'; ?>