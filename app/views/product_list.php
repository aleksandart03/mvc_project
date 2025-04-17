<html>

<head>
    <title>Prodavnica</title>
    <link rel="stylesheet" href="/mvc_project/public/styles/main.css">
    <link rel="stylesheet" href="/mvc_project/public/styles/product_list_style.css">
</head>

<body>
    <div class="container">
        <h2 class="page-title">Lista proizvoda</h2>

        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <h3 class="product-name"><?= $product->name ?></h3>
                <p class="product-description"><?= $product->description ?></p>
                <p class="product-price">Cena: €<?= number_format($product->price, 2) ?></p>
                <a href="/mvc_project/public/index.php?action=edit&id=<?= $product->id ?>" class="edit-btn">Izmeni</a>
                <a href="/mvc_project/public/index.php?action=delete&id=<?= $product->id ?>" class="delete-btn" onclick="return confirm('Da li ste sigurni da želite da obrišete ovaj proizvod?')">Obriši</a>
            </div>
        <?php endforeach; ?>

        <br><br>
        <a href="/mvc_project/public/index.php?action=create" class="add-product-btn">Dodaj novi proizvod</a>
    </div>
</body>

</html>