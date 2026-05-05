<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Knihovna</title>
</head>
<body class="bg-sky-50 text-slate-800 font-sans min-h-screen">

<header class="bg-white shadow-sm border-b border-sky-100 mb-8">
    <div class="max-w-6xl mx-auto px-4 py-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-sky-700 tracking-tight">Aplikace Knihovna</h1>
        <nav>
                   <nav class="mt-4 md:mt-0">
                <ul class="flex items-center space-x-6">
                    <li>
                        <a href="<?= BASE_URL ?>/index.php" class="hover:text-blue-400 transition-colors font-medium">Seznam knih</a>
                    </li>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li>
                            <a href="<?= BASE_URL ?>/index.php?url=book/create" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-md transition-all shadow-inner border border-blue-500">
                                + Přidat knihu
                            </a>
                        </li>
                        <li class="text-slate-400 text-sm">
                            Ahoj, <span class="text-white font-semibold tracking-wide"><?= htmlspecialchars($_SESSION['user_name']) ?></span>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>/index.php?url=auth/logout" class="text-rose-400 hover:text-white transition-colors text-sm uppercase tracking-wider font-medium">
                                Odhlásit
                            </a>
                        </li>

                    <?php else: ?>
                        <li>
                            <a href="<?= BASE_URL ?>/index.php?url=auth/login" class="hover:text-blue-400 transition-colors font-medium">Přihlásit</a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>/index.php?url=auth/register" class="bg-slate-700 hover:bg-slate-600 text-white px-4 py-2 rounded-md transition-all shadow-inner border border-slate-600">
                                Registrace
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </nav>
    </div>
</header>

<main class="max-w-6xl mx-auto px-4 pb-12">
    <?php if (isset($_SESSION['messages'])): ?>
        <div class="mb-6 space-y-2">
            <?php foreach ($_SESSION['messages'] as $type => $messages): 
                $style = ($type === 'success') ? 'bg-green-50 text-green-700 border-green-200' : 
                         (($type === 'error') ? 'bg-red-50 text-red-700 border-red-200' : 'bg-amber-50 text-amber-700 border-amber-200');
            ?>
                <?php foreach ($messages as $msg): ?>
                    <div class="<?= $style ?> border px-4 py-3 rounded-xl text-sm font-medium shadow-sm">
                        <?= htmlspecialchars($msg) ?>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; unset($_SESSION['messages']); ?>
        </div>
    <?php endif; ?>