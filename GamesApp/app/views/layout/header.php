<!DOCTYPE html>
<html lang="cs" class="h-full bg-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herní Vault</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600;700&family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .gaming-font {
            font-family: 'Rajdhani', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex flex-col selection:bg-emerald-500 selection:text-slate-950">

    <nav class="bg-slate-900 border-b border-slate-800 sticky top-0 z-50 backdrop-blur-md bg-slate-900/90">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            
            <a href="<?= BASE_URL ?>/index.php" class="flex items-center group transition-transform hover:-translate-y-0.5">
                <img src="<?= BASE_URL ?>/logo/logo.svg" 
                     alt="Logo" 
                     class="h-12 w-12 mr-4 transition-all duration-300 drop-shadow-[0_0_6px_rgba(16,185,129,0.4)] group-hover:drop-shadow-[0_0_12px_rgba(16,185,129,0.7)] group-hover:scale-105">
                
                <span class="text-2xl font-black text-slate-100 uppercase tracking-widest drop-shadow-md group-hover:text-white transition-colors gaming-font">
                    Herní <span class="text-emerald-500 group-hover:text-emerald-400">Vault</span>
                </span>
            </a>

            <div class="flex items-center space-x-6 text-xs font-bold uppercase tracking-wider">
                <a href="<?= BASE_URL ?>/index.php" class="text-slate-400 hover:text-emerald-400 transition-colors">Katalog</a>
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="<?= BASE_URL ?>/index.php?url=game/create" class="bg-emerald-950/40 text-emerald-400 hover:bg-emerald-500 hover:text-slate-950 border border-emerald-900/50 px-3 py-2 rounded font-black transition-all">
                        + Přidat Hru
                    </a>
                    
                    <div class="flex items-center space-x-4 border-l border-slate-800 pl-6">
                        
                        <div class="flex items-center space-x-1.5">
                            <span class="text-slate-500 text-[10px]">Hráč:</span>
                            <span class="text-slate-200 font-black">
                                <?= htmlspecialchars($_SESSION['user_name'] ?? 'Uživatel') ?>
                            </span>
                        </div>
                        
                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                            <span class="bg-rose-950/50 text-rose-500 border border-rose-900/50 text-[9px] px-1.5 py-0.5 rounded font-black tracking-widest">ADMIN</span>
                        <?php endif; ?>

                        <a href="<?= BASE_URL ?>/index.php?url=user/settings" 
                           class="text-slate-400 hover:text-emerald-400 transition-all duration-300 hover:rotate-45 p-1 rounded hover:bg-slate-800/50" 
                           title="Nastavení účtu">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                            </svg>
                        </a>
                        
                        <a href="<?= BASE_URL ?>/index.php?url=auth/logout" class="text-rose-500 hover:text-rose-400 transition-colors">Odhlásit</a>
                    </div>
                <?php else: ?>
                    <div class="flex items-center space-x-4 border-l border-slate-800 pl-6">
                        <a href="<?= BASE_URL ?>/index.php?url=auth/login" class="text-slate-400 hover:text-slate-200 transition-colors">Přihlášení</a>
                        <a href="<?= BASE_URL ?>/index.php?url=auth/register" class="bg-slate-800 hover:bg-slate-700 text-slate-200 px-3 py-2 rounded transition-colors">Registrace</a>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </nav>

    <div class="container mx-auto px-6 mt-6 max-w-4xl">
        <?php 
        if (isset($_SESSION['messages'])): 
            
            // Úspěšné zprávy (Success)
            if (!empty($_SESSION['messages']['success'])): 
                foreach ($_SESSION['messages']['success'] as $msg): ?>
                    <div class="bg-emerald-950/40 border border-emerald-500/30 text-emerald-400 text-xs font-bold uppercase tracking-wider px-4 py-3 rounded-xl mb-3 flex items-center shadow-lg shadow-emerald-950/20 animate-fade-in">
                        <span class="mr-2 text-emerald-500 text-sm">✓</span> <?= htmlspecialchars($msg) ?>
                    </div>
                <?php endforeach;
            endif;

            // Chybové zprávy (Error)
            if (!empty($_SESSION['messages']['error'])): 
                foreach ($_SESSION['messages']['error'] as $msg): ?>
                    <div class="bg-rose-950/40 border border-rose-500/30 text-rose-400 text-xs font-bold uppercase tracking-wider px-4 py-3 rounded-xl mb-3 flex items-center shadow-lg shadow-rose-950/20 animate-fade-in">
                        <span class="mr-2 text-rose-500 text-sm">⚠</span> <?= htmlspecialchars($msg) ?>
                    </div>
                <?php endforeach;
            endif;

            // Vyčištění session zpráv
            unset($_SESSION['messages']);
        endif; 
        ?>
    </div>