<?php require_once '../app/views/layout/header.php'; ?>

    <main class="container mx-auto px-6 py-12 flex-grow">
        
        <div class="max-w-3xl mx-auto">
            <!-- Nadpis a navigace zpět -->
            <div class="mb-8 flex items-end justify-between">
                <div>
                    <h2 class="text-4xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500 uppercase">
                        Nová kniha
                    </h2>
                    <p class="text-blue-500/80 font-medium mt-1">Vyplňte údaje pro uložení do katalogu</p>
                </div>
                <a href="<?= BASE_URL ?>/index.php" class="text-blue-600 hover:text-blue-800 transition-all text-sm font-bold uppercase tracking-wider flex items-center">
                    <span class="mr-2">←</span> Zpět do katalogu
                </a>
            </div>
            
            <!-- Karta formuláře -->
            <div class="bg-white border border-blue-100 rounded-2xl shadow-xl shadow-blue-100/50 p-8 md:p-10">
                <form action="<?= BASE_URL ?>/index.php?url=book/store" method="post" enctype="multipart/form-data" class="space-y-6">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <!-- Název knihy -->
                        <div class="md:col-span-2">
                            <label for="title" class="block text-xs font-bold text-blue-900/40 mb-2 uppercase tracking-widest">Název knihy <span class="text-rose-500">*</span></label>
                            <input type="text" id="title" name="title" required 
                                   placeholder="Např. Velký Gatsby"
                                   class="w-full bg-blue-50/30 border border-blue-100 rounded-xl px-5 py-3 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-400/10 transition-all">
                        </div>
                        
                        <!-- Autor -->
                        <div>
                            <label for="author" class="block text-xs font-bold text-blue-900/40 mb-2 uppercase tracking-widest">Autor <span class="text-rose-500">*</span></label>
                            <input type="text" id="author" name="author" placeholder="Příjmení Jméno" required 
                                   class="w-full bg-blue-50/30 border border-blue-100 rounded-xl px-5 py-3 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-400/10 transition-all">
                        </div>
                        
                        <!-- ISBN -->
                        <div>
                            <label for="isbn" class="block text-xs font-bold text-blue-900/40 mb-2 uppercase tracking-widest">ISBN <span class="text-rose-500">*</span></label>
                            <input type="text" id="isbn" name="isbn" placeholder="978-..."
                                   class="w-full bg-blue-50/30 border border-blue-100 rounded-xl px-5 py-3 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-400/10 transition-all">
                        </div>

                        <!-- Rok vydání -->
                        <div>
                            <label for="year" class="block text-xs font-bold text-blue-900/40 mb-2 uppercase tracking-widest">Rok vydání <span class="text-rose-500">*</span></label>
                            <input type="number" id="year" name="year" required 
                                   class="w-full bg-blue-50/30 border border-blue-100 rounded-xl px-5 py-3 text-slate-700 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-400/10 transition-all">
                        </div>
                        
                        <!-- Cena -->
                        <div>
                            <label for="price" class="block text-xs font-bold text-blue-900/40 mb-2 uppercase tracking-widest">Cena (Kč)</label>
                            <input type="number" id="price" name="price" step="0.5" 
                                   class="w-full bg-blue-50/30 border border-blue-100 rounded-xl px-5 py-3 text-slate-700 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-400/10 transition-all">
                        </div>

                        <!-- Kategorie -->
                        <div>
                            <label for="category" class="block text-xs font-bold text-blue-900/40 mb-2 uppercase tracking-widest">Kategorie <span class="text-rose-500">*</span></label>
                            <select id="category" name="category" required
                                    class="w-full bg-blue-50/30 border border-blue-100 rounded-xl px-5 py-3 text-slate-700 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-400/10 transition-all appearance-none cursor-pointer">
                                <option value="">-- Vyberte kategorii --</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= htmlspecialchars($cat['id']) ?>">
                                        <?= htmlspecialchars($cat['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <!-- Podkategorie -->
                           <div>
                            <label for="subcategory" class="block text-xs font-bold text-blue-900/40 mb-2 uppercase tracking-widest">Podkategorie <span class="text-rose-500">*</span></label>
                            <select id="subcategory" name="subcategory" required
                                    class="w-full bg-blue-50/30 border border-blue-100 rounded-xl px-5 py-3 text-slate-700 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-400/10 transition-all appearance-none cursor-pointer">
                                <option value="">-- Vyberte kategorii --</option>
                                <?php foreach ($subcategories as $subcat): ?>
                                    <option value="<?= htmlspecialchars($subcat['id']) ?>">
                                        <?= htmlspecialchars($subcat['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        
                        <!-- Odkaz -->
                        <div class="md:col-span-2">
                            <label for="link" class="block text-xs font-bold text-blue-900/40 mb-2 uppercase tracking-widest">Externí odkaz</label>
                            <input type="text" id="link" name="link" placeholder="https://www.databazeknih.cz/..." 
                                   class="w-full bg-blue-50/30 border border-blue-100 rounded-xl px-5 py-3 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-400/10 transition-all">
                        </div>
                        
                        <!-- Popis -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-xs font-bold text-blue-900/40 mb-2 uppercase tracking-widest">Popis knihy</label>
                            <textarea id="description" name="description" rows="4" 
                                      class="w-full bg-blue-50/30 border border-blue-100 rounded-xl px-5 py-3 text-slate-700 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-400/10 transition-all resize-none"></textarea>
                        </div>    
                        
                        <!-- Obrázky -->
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-blue-900/40 mb-3 uppercase tracking-widest">Obálka knihy</label>
                            <div class="w-full">
                                <label for="images" class="flex flex-col items-center justify-center w-full h-32 border-2 border-blue-100 border-dashed rounded-2xl cursor-pointer bg-blue-50/30 hover:bg-blue-50 hover:border-blue-300 transition-all group">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center">
                                        <svg class="w-8 h-8 text-blue-400 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span id="file-title" class="text-sm text-blue-900/60 font-bold uppercase tracking-tight">Vyberte soubory</span>
                                        <span id="file-info" class="text-xs text-blue-400 mt-1 font-medium italic">Žádné soubory</span>
                                    </div>
                                    <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden">
                                </label>
                            </div>
                        </div>
                        
                        <!-- Tlačítko Odeslat -->
                        <div class="md:col-span-2 mt-4">
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black py-4 px-4 rounded-xl shadow-lg shadow-blue-200 transition-all uppercase tracking-widest text-sm transform hover:-translate-y-1 active:scale-95">
                                Uložit knihu do katalogu
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <script>
            const fileInput = document.getElementById('images');
            const fileTitle = document.getElementById('file-title');
            const fileInfo = document.getElementById('file-info');

            fileInput.addEventListener('change', function(event) {
                const files = event.target.files;
                
                if (files.length === 0) {
                    fileTitle.textContent = 'Vyberte soubory';
                    fileInfo.textContent = 'Žádné soubory';
                    fileTitle.classList.remove('text-blue-600');
                } else {
                    fileTitle.textContent = files.length === 1 ? 'Soubor připraven' : 'Soubory připraveny';
                    fileTitle.classList.add('text-blue-600');
                    fileInfo.textContent = files.length === 1 ? files[0].name : 'Vybráno celkem: ' + files.length + ' souborů';
                }
            });
        </script>    
    </main>

<?php require_once '../app/views/layout/footer.php'; ?>