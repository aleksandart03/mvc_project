<head>
    <title>Dodavanje proizovda</title>
    <link rel="stylesheet" href="/mvc_project/public/styles/main.css">
    <link rel="stylesheet" href="/mvc_project/public/styles/add_style.css">
</head>

<a href="/mvc_project/public/admin.php" class="back-link">← Nazad na listu proizvoda</a>

<div class="form-container">
    <h2 class="form-title">Dodaj novi proizvod</h2>

    <form action="/mvc_project/public/admin.php?action=store" method="POST" class="product-form">
        <div class="form-group">
            <label for="name">Naziv:</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label for="description">Opis:</label>
            <textarea name="description" required></textarea>
        </div>

        <div class="form-group">
            <label for="price">Cena (€):</label>
            <input type="number" name="price" step="0.01" required>
        </div>

        <input type="submit" value="Dodaj proizvod" class="submit-btn">
    </form>
</div>