<?php require_once '../app/views/layout/header.php'; ?>

<div class="container mx-auto px-6 py-8 max-w-xl">
    <h2 class="text-3xl font-black text-slate-100 uppercase tracking-widest gaming-font mb-8">
        Nastavení <span class="text-emerald-500">Profilu</span>
    </h2>

    <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 shadow-xl">
        
        <form action="<?= BASE_URL ?>/index.php?url=user/update" method="POST" class="space-y-6">
            
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">Registrovaný E-mail</label>
                <input type="email" 
                       value="<?= htmlspecialchars($_SESSION['user_email'] ?? 'E-mail není v session uložen') ?>" 
                       readonly 
                       disabled
                       class="w-full bg-slate-950 border border-slate-800 rounded p-2 text-slate-500 cursor-not-allowed opacity-60">
                <p class="text-[10px] text-slate-600 mt-1">E-mailovou adresu nelze z bezpečnostních důvodů měnit.</p>
            </div>

            <div>
                <label for="nickname" class="block text-sm font-medium text-slate-400 mb-1">Přezdívka (Nickname)</label>
                <input type="text" 
                       name="nickname" 
                       id="nickname" 
                       value="<?= htmlspecialchars($_SESSION['user_name'] ?? '') ?>" 
                       class="w-full bg-slate-950 border border-slate-700 focus:border-emerald-500 rounded p-2 text-white transition-colors">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-400 mb-1">Nové heslo (nechte prázdné, pokud nechcete měnit)</label>
                <input type="password" 
                       name="password" 
                       id="password" 
                       minlength="6" 
                       pattern="(?=.*\d).{6,}" 
                       title="Heslo musí obsahovat alespoň 6 znaků a jednu číslici"
                       class="w-full bg-slate-950 border border-slate-700 focus:border-emerald-500 rounded p-2 text-white transition-colors">
                <p class="text-[10px] text-slate-500 mt-1">Minimálně 6 znaků a alespoň jedna číslice.</p>
            </div>

            <div class="pt-2">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2 px-6 rounded transition-colors text-sm w-full">
                    ULOŽIT ZMĚNY
                </button>
            </div>
        </form>

        <div class="border-t border-rose-950/40 mt-10 pt-6">
            <h4 class="text-rose-500 font-bold text-sm uppercase tracking-wider mb-2">Nebezpečná zóna</h4>
            <p class="text-xs text-slate-400 mb-4">Smazáním účtu trvale odstraníte celý svůj profil, přidané hry i komentáře. Tuto akci nelze vrátit zpět.</p>
            
            <form action="<?= BASE_URL ?>/index.php?url=user/delete" method="POST" onsubmit="return confirm('Opravdu chcete trvale smazat svůj účet? Tato akce je nevratná!');">
                <button type="submit" class="bg-rose-950/40 border border-rose-500/30 text-rose-400 hover:bg-rose-600 hover:text-white font-bold py-2 px-4 rounded transition-all text-sm w-full">
                    TRVALE SMAZAT ÚČET
                </button>
            </form>
        </div>

    </div>
</div>