<!DOCTYPE html>
<html lang="cs" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Herní Vault</title>
</head>
<body class="bg-slate-950 text-slate-100 font-sans min-h-screen flex flex-col">

<header class="bg-slate-900 border-b border-slate-800/80 shadow-xl mb-8">
    <div class="max-w-6xl mx-auto px-6 py-5 flex justify-between items-center">
        <h1 class="text-xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-400 tracking-wider uppercase">
            Herní Vault
        </h1>
        <nav>
            <ul class="flex items-center space-x-6">
                <li>
                    <a href="<?= BASE_URL ?>/index.php" class="text-xs font-bold uppercase tracking-widest text-slate-400 hover:text-emerald-400 transition-colors">Katalog</a>
                </li>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <li>
                        <span class="text-xs font-medium text-slate-500 uppercase">Hráč: <strong class="text-emerald-400"><?= htmlspecialchars($_SESSION['user_name']) ?></strong></span>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>/index.php?url=auth/logout" class="text-xs font-bold uppercase tracking-widest text-rose-400 hover:text-rose-300 transition-colors">Odhlásit</a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?= BASE_URL ?>/index.php?url=auth/login" class="text-xs font-bold uppercase tracking-widest text-slate-400 hover:text-emerald-400 transition-colors">Přihlásit</a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>/index.php?url=auth/register" class="bg-slate-800 hover:bg-slate-700 text-emerald-400 px-4 py-2 rounded-md text-xs font-black uppercase tracking-wider transition-all border border-slate-700">
                            Registrace
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

<main class="max-w-6xl mx-auto px-6 flex-grow w-full">
    <?php if (isset($_SESSION['messages'])): ?>
        <div class="mb-6 space-y-2">
            <?php foreach ($_SESSION['messages'] as $type => $messages): 
                $style = ($type === 'success') ? 'bg-emerald-950/80 text-emerald-400 border-emerald-900/50' : 
                         (($type === 'error') ? 'bg-rose-950/80 text-rose-400 border-rose-900/50' : 'bg-amber-950/80 text-amber-400 border-amber-900/50');
            ?>
                <?php foreach ($messages as $msg): ?>
                    <div class="<?= $style ?> border px-4 py-3 rounded-xl text-xs font-bold uppercase tracking-wider shadow-md">
                        <?= htmlspecialchars($msg) ?>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
            <?php unset($_SESSION['messages']); ?>
        </div>
    <?php endif; ?>