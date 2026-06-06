<?php
// Cesty k modelům (opraveno přes __DIR__)
require_once __DIR__ . '/../../models/Database.php';
require_once __DIR__ . '/../../models/User.php';

// Logika pro role 
$role = null;
if (isset($_SESSION['user_id'])) {
    $db = new Database();
    $userModel = new User($db->getConnection());
    $gameCount = $userModel->getGameCount($_SESSION['user_id']);
    
    function getUserRole($gameCount) {
        if ($gameCount >= 10) return ['label' => 'GAMER', 'color' => 'text-yellow-400', 'border' => 'border-yellow-400'];
        if ($gameCount >= 5)  return ['label' => 'AMATEUR', 'color' => 'text-blue-400', 'border' => 'border-blue-400'];
        return ['label' => 'NOOB', 'color' => 'text-slate-400', 'border' => 'border-slate-400'];
    }
    $role = getUserRole($gameCount);
}
?>

<!DOCTYPE html>
<html lang="cs" class="h-full bg-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herní Vault</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600;700&family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>.gaming-font { font-family: 'Rajdhani', sans-serif; }</style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex flex-col">

<nav class="bg-slate-900 border-b border-slate-800 sticky top-0 z-50">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        
        <a href="<?= BASE_URL ?>/index.php" class="flex items-center group">
            <img src="/WA-2026-Rocha-Pinheiro-Daniel/GamesApp/public/logo/logo.svg" alt="Logo" class="h-20 w-20 mr-3">
            <span class="text-2xl font-black text-slate-100 uppercase tracking-widest gaming-font">
                Herní <span class="text-emerald-500">Vault</span>
            </span>
        </a>

        <div class="flex items-center space-x-6 text-M font-bold uppercase tracking-wider">
            <a href="<?= BASE_URL ?>/index.php" class="text-slate-400 hover:text-emerald-400 transition-colors">Katalog</a>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="<?= BASE_URL ?>/index.php?url=game/create" class="bg-emerald-950/40 text-emerald-400 hover:bg-emerald-500 hover:text-slate-950 border border-emerald-900/50 px-3 py-2 rounded font-black transition-all">
                    + Přidat Hru
                </a>
                
                <div class="flex items-center space-x-4 border-l border-slate-2000 pl-6">
                    <div class="flex items-center space-x-2">
                        <span class="text-slate-200 font-bold"><?= htmlspecialchars($_SESSION['user_name'] ?? 'Uživatel') ?></span>
                        
                        <?php if ($role): ?>
                            <span class="text-[9px] font-black uppercase px-2 py-0.5 rounded border <?= $role['color'] . ' ' . $role['border'] ?>">
                                <?= $role['label'] ?>
                            </span>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                            <span class="text-[9px] font-black uppercase text-rose-500 border border-rose-500 px-2 py-0.5 rounded">ADMIN</span>
                        <?php endif; ?>
                    </div>

                    <a href="<?= BASE_URL ?>/index.php?url=user/settings" class="text-slate-400 hover:text-emerald-400 transition-colors" title="Nastavení">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
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
        foreach (['success', 'error'] as $type):
            if (!empty($_SESSION['messages'][$type])):
                foreach ($_SESSION['messages'][$type] as $msg): ?>
                    <div class="<?= $type === 'success' ? 'bg-emerald-950/40 border-emerald-500/30 text-emerald-400' : 'bg-rose-950/40 border-rose-500/30 text-rose-400' ?> border text-xs font-bold uppercase px-4 py-3 rounded-xl mb-3">
                        <?= htmlspecialchars($msg) ?>
                    </div>
                <?php endforeach;
            endif;
        endforeach;
        unset($_SESSION['messages']);
    endif; 
    ?>
</div>



