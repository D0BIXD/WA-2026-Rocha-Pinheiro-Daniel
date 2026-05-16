<?php require_once '../app/views/layout/header.php'; ?>

<div class="max-w-md mx-auto py-12">
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-black uppercase text-emerald-400 tracking-tight">Přihlášení do Vaultu</h2>
        <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-1">Vítejte zpět, vojáku</p>
    </div>

    <div class="bg-slate-900 border border-slate-800 rounded-xl p-8 shadow-2xl">
        <form action="<?= BASE_URL ?>/index.php?url=auth/authenticate" method="post" class="space-y-5">
            <div>
                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">E-mail</label>
                <input type="email" name="email" required autofocus class="w-full bg-slate-950 border border-slate-800 rounded p-3 text-slate-200 text-sm focus:outline-none focus:border-emerald-500">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Heslo</label>
                <input type="password" name="password" required class="w-full bg-slate-950 border border-slate-800 rounded p-3 text-slate-200 text-sm focus:outline-none focus:border-emerald-500">
            </div>

            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-slate-950 font-black py-3 rounded text-sm uppercase tracking-wider transition-colors mt-2">
                Vstoupit
            </button>
        </form>

        <div class="text-center border-t border-slate-800 pt-5 mt-5">
            <p class="text-slate-500 text-xs">Nemáte ještě účet? <a href="<?= BASE_URL ?>/index.php?url=auth/register" class="text-emerald-400 font-bold hover:underline">Zaregistrujte se</a></p>
        </div>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>