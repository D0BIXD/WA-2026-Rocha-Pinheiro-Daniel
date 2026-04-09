<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Knihovna - Seznam</title>
</head>
<body class="bg-sky-50 text-slate-800 font-sans min-h-screen">

    <header class="bg-white shadow-sm border-b border-sky-100">
        <div class="max-w-6xl mx-auto px-4 py-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-sky-700 tracking-tight">Aplikace Knihovna</h1>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="<?= BASE_URL ?>/index.php" class="text-sky-600 hover:text-sky-800 font-medium transition">Seznam knih</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?url=book/create" class="bg-sky-600 text-white px-4 py-2 rounded-lg hover:bg-sky-700 transition shadow-sm text-sm">+ Přidat knihu</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-10">
        
        <?php if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])): ?>
            <div class="mb-8 space-y-3">
                <?php foreach ($_SESSION['messages'] as $type => $messages): ?>
                    <?php 
                        $styles = [
                            'success' => 'bg-green-50 border-green-200 text-green-700',
                            'error'   => 'bg-red-50 border-red-200 text-red-700',
                            'notice'  => 'bg-amber-50 border-amber-200 text-amber-700'
                        ][$type] ?? 'bg-sky-50 border-sky-200 text-sky-700';
                    ?>
                    <?php foreach ($messages as $message): ?>
                        <div class="<?= $styles ?> border px-4 py-3 rounded-xl flex items-center shadow-sm animate-fade-in">
                            <span class="font-medium"><?= htmlspecialchars($message) ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <?php unset($_SESSION['messages']); ?>
            </div>
        <?php endif; ?>
        
        <div class="flex justify-between items-end mb-6">
            <h2 class="text-3xl font-extrabold text-slate-900">Dostupné knihy</h2>
            <p class="text-slate-500 text-sm">Celkem nalezeno: <span class="font-bold text-sky-600"><?= count($books) ?></span></p>
        </div>

        <?php if (!empty($books)): ?>
            <div class="bg-white rounded-2xl shadow-xl shadow-sky-100/50 overflow-hidden border border-sky-50">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-sky-600 text-white text-sm uppercase tracking-wider">
                            <th class="px-6 py-4 font-semibold">ID</th>
                            <th class="px-6 py-4 font-semibold">Název a autor</th>
                            <th class="px-6 py-4 font-semibold">ISBN</th>
                            <th class="px-6 py-4 font-semibold text-center">Rok</th>
                            <th class="px-6 py-4 font-semibold text-right">Cena</th>
                            <th class="px-6 py-4 font-semibold text-center">Akce</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sky-50">
                        <?php foreach ($books as $book): ?>
                            <tr class="hover:bg-sky-50/50 transition-colors group">
                                <td class="px-6 py-4 text-slate-400 font-mono text-xs italic">#<?= htmlspecialchars($book['id']) ?></td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-900"><?= htmlspecialchars($book['title']) ?></div>
                                    <div class="text-sm text-sky-600"><?= htmlspecialchars($book['author']) ?></div>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500 font-medium"><?= htmlspecialchars($book['isbn']) ?></td>
                                <td class="px-6 py-4 text-sm text-center font-semibold text-slate-600"><?= htmlspecialchars($book['year']) ?></td>
                                <td class="px-6 py-4 text-right">
                                    <span class="bg-sky-100 text-sky-700 px-3 py-1 rounded-full font-bold text-sm">
                                        <?= number_format($book['price'], 2, ',', ' ') ?> Kč
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center space-x-2 opacity-80 group-hover:opacity-100 transition-opacity">
                                        <a title="Detail" href="<?= BASE_URL ?>/index.php?url=book/show/<?= $book['id'] ?>" class="p-2 bg-slate-100 text-slate-600 rounded-lg hover:bg-sky-200 hover:text-sky-700 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a title="Upravit" href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <a title="Smazat" href="<?= BASE_URL ?>/index.php?url=book/delete/<?= $book['id'] ?>" onclick="return confirm('Opravdu chcete tuto knihu smazat?')" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-2xl p-12 text-center shadow-sm border border-sky-100">
                <div class="text-sky-200 mb-4 flex justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <p class="text-xl text-slate-600 font-medium">V databázi zatím nejsou žádné knihy.</p>
                <a href="<?= BASE_URL ?>/index.php?url=book/create" class="inline-block mt-6 text-sky-600 hover:underline font-bold">Přidejte svou první knihu &rarr;</a>
            </div>
        <?php endif; ?>
    </main>

    <footer class="mt-10 py-8 border-t border-sky-100 text-center text-slate-400 text-sm">
        <p>&copy; WA 2026 - výukový projekt</p>
    </footer>

</body>
</html>