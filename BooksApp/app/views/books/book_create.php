<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>-->
    <title>Document</title>
</head>
<body>
    <div>
        <div>
            <h2>Přidat novou knihu</h2>
            <p>Vyplňte údaje a uložte novou knihu do databáze</p>
        </div>

        <div>
        <form action="">
            <div>
                <div>
                    <label for="title">Název knihy<span>*</span></label>
                    <input type="text" id="title" name="title" required>
                </div>
            </div>

            <div>
                <div>
                    <label for="author">Autor Knihy<span>*</span></label>
                    <input type="text" id="author" name="author" placeholder="Příjmení, jméno" required>
                </div>
            </div>

            <div>
                <div>
                    <label for="isbn">ISBN<span>*</span></label>
                    <input type="text" id="isbn" name="isbn" required>
                </div>
            </div>

            <div>
                <div>
                    <label for="category">Kategorie</label>
                    <input type="text" id="category" name="category">
                </div>
            </div>

            <div>
                <div>
                    <label for="subcategory">Podkategorie</label>
                    <input type="text" id="subcategory" name="subcategory">
                </div>
            </div>

            <div>
                <div>
                    <label for="year">Rok vydání<span>*</span></label>
                    <input type="number" id="year" name="year" required>
                </div>
            </div>

            <div>
                <div>
                    <label for="price">Cena knihy</label>
                    <input type="number" id="price" name="price" step="1">
                </div>
            </div>
            
            <div>
                <div>
                    <label for="link">Odkaz</label>
                    <input type="text" id="link" name="link">
                </div>
            </div>

             <div>
                <div>
                    <label for="description">Popis knihy</label>
                    <textarea id="description" name="description" rows="10">Popis knihy: </textarea>
                </div>
            </div>

            <div>
                        <label>Obrázky (můžete nahrát více)</label>
                        <label>
                            <span>Klikni pro výběr souborů</span>
                            <span>JPG / PNG / WebP – více souborů najednou</span>
                            <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden">
                        </label>
                    </div>

            <div>
                <div>
                    <button type = "submit">Odeslat</button>
                </div>
            </div>
        </form>
        </div>
    </div>
    
</body>
</html>