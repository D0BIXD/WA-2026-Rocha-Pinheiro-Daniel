<?php require_once '../app/views/layout/header.php'; ?>

<div class="max-w-md mx-auto py-12">
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-black uppercase text-emerald-400 tracking-tight">Nová Registrace</h2>
        <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-1">Vytvořte si profil správce her</p>
    </div>

    <div class="bg-slate-900 border border-slate-800 rounded-xl p-8 shadow-2xl">
        <form action="<?= BASE_URL ?>/index.php?url=auth/storeUser" method="post" class="space-y-4">
            <div>
                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Uživatelské jméno (Username)</label>
                <input type="text" name="username" required class="w-full bg-slate-950 border border-slate-800 rounded p-2.5 text-slate-200 text-sm focus:outline-none focus:border-emerald-500">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Přezdívka (GamerTag)</label>
                <input type="text" name="nickname" class="w-full bg-slate-950 border border-slate-800 rounded p-2.5 text-slate-200 text-sm focus:outline-none focus:border-emerald-500">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">E-mailová adresa</label>
                <input type="email" name="email" required class="w-full bg-slate-950 border border-slate-800 rounded p-2.5 text-slate-200 text-sm focus:outline-none focus:border-emerald-500">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Heslo</label>
                <input type="password" name="password" required class="w-full bg-slate-950 border border-slate-800 rounded p-2.5 text-slate-200 text-sm focus:outline-none focus:border-emerald-500">
            </div>

            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-slate-950 font-black py-3 rounded text-sm uppercase tracking-wider transition-colors mt-4">
                Vytvořit účet
            </button>
        </form>

        <div class="text-center border-t border-slate-800 pt-5 mt-5">
            <p class="text-slate-500 text-xs">Už máte účet? <a href="<?= BASE_URL ?>/index.php?url=auth/login" class="text-emerald-400 font-bold hover:underline">Přihlaste se</a></p>
        </div>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>