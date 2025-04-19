<!DOCTYPE html>
<html>

<head>
    <title>Izmeni proizvod</title>
    <link rel="stylesheet" href="/mvc_project/public/styles/main.css">
    <link rel="stylesheet" href="/mvc_project/public/styles/edit_product.css">
</head>

<body>
    <div class="container">
        <a class="back-link" href="/mvc_project/public/admin.php">⬅ Nazad na listu proizvoda</a>

        <h2 class="form-title">Izmeni proizvod</h2>

        <form class="product-form" action="/mvc_project/public/admin.php?action=update" method="POST">
            <input type="hidden" name="id" value="<?= ($product->id) ?>">

            <label for="name">Naziv:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($product->name) ?>" required>

            <label for="description">Opis:</label>
            <textarea name="description" required><?= htmlspecialchars($product->description) ?></textarea>

            <label for="price">Cena (€):</label>
            <input type="number" name="price" step="0.01" value="<?= htmlspecialchars($product->price) ?>" required>



            <input class="submit-btn" type="submit" value="Sačuvaj izmene">
        </form>
    </div>
</body>

</html>