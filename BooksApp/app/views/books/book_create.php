<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přidat knihu</title>
</head>
<body>
    <div>
        <div>
            <h2>Přidat novou knihu</h2>
            <p>Vyplňte údaje a uložte novou knihu do databáze</p>
        </div>

        <div>
        <form action="/WA-2026-Rocha-Pinheiro-Daniel/BooksApp/public/index.php?url=book/store" method="POST">
            <div>
                <label for="title">Název knihy<span>*</span></label>
                <input type="text" id="title" name="title" required>
            </div>

            <div>
                <label for="author">Autor Knihy<span>*</span></label>
                <input type="text" id="author" name="author" placeholder="Příjmení, jméno" required>
            </div>

            <div>
                <label for="isbn">ISBN<span>*</span></label>
                <input type="text" id="isbn" name="isbn" required>
            </div>

            <div>
                <label for="category">Kategorie</label>
                <input type="text" id="category" name="category">
            </div>

            <div>
                <label for="subcategory">Podkategorie</label>
                <input type="text" id="subcategory" name="subcategory">
            </div>

            <div>
                <label for="year">Rok vydání<span>*</span></label>
                <input type="number" id="year" name="year" required>
            </div>

            <div>
                <label for="price">Cena knihy</label>
                <input type="number" id="price" name="price" step="1">
            </div>
            
            <div>
                <label for="link">Odkaz</label>
                <input type="text" id="link" name="link">
            </div>

             <div>
                <label for="description">Popis knihy</label>
                <textarea id="description" name="description" rows="5">Popis knihy: </textarea>
            </div>

            <div>
                <button type="submit">Uložit do databáze</button>
            </div>
        </form>
        </div>
    </div>
</body>
</html>