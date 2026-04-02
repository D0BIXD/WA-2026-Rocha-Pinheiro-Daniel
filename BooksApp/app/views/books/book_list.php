<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knihovna - Seznam</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <header>
        <h1>Aplikace Knihovna</h1>
        <nav>
            <ul>
                <li><a href="<?= BASE_URL ?>/index.php">Seznam knih</a></li>
                <li><a href="<?= BASE_URL ?>/index.php?url=book/create">Přidat novou knihu</a></li>
            </ul>
        </nav>
    </header>

<main>
    <h2>Dostupné knihy</h2>

    <?php if (!empty($books)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Název</th>
                    <th>Autor</th>
                    <th>ISBN</th>
                    <th>Rok</th>
                    <th>Cena</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?= htmlspecialchars($book['id']) ?></td>
                        <td><?= htmlspecialchars($book['title']) ?></td>
                        <td><?= htmlspecialchars($book['author']) ?></td>
                        <td><?= htmlspecialchars($book['isbn']) ?></td>
                        <td><?= htmlspecialchars($book['year']) ?></td>
                        <td><?= htmlspecialchars($book['price']) ?> Kč</td>
                        <td>
                            <a href="<?= BASE_URL ?>/index.php?url=book/show/<?= $book['id'] ?>">Detail</a> | 
                            <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>">Upravit</a> | 
                            <a href="<?= BASE_URL ?>/index.php?url=book/delete/<?= $book['id'] ?>" onclick="return confirm('Opravdu chcete tuto knihu smazat?')">Smazat</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>V databázi zatím nejsou žádné knihy. <a href="/WA-2026-Rocha-Pinheiro-Daniel/BooksApp/public/index.php?url=book/create">Přidejte první!</a></p>
    <?php endif; ?>
</main>

<footer>
    <p>&copy; WA 2026 - výukový projekt</p>
</footer>

</body>
</html>