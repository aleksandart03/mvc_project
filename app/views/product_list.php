<html>

<head>
    <title>Prodavnica</title>
    <style>
        body {
            font-family: Arial;
        }

        .product {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            width: 300px;
        }
    </style>
</head>

<body>
    <h2>Lista proizvoda</h2>

    <?php foreach ($products as $product): ?>
        <div>
            <h3><?= $product->name ?></h3>
            <p><?= $product->description ?></p>
            <p>Cena: €<?= number_format($product->price, 2) ?></p>
            <a href="/mvc_project/public/index.php?action=delete&id=<?= $product->id ?>" onclick="return confirm('Da li ste sigurni da želite da obrišete ovaj proizvod?')">🗑 Obriši</a>
        </div>
    <?php endforeach; ?>
    <br></br>
    <a href="/mvc_project/public/index.php?action=create">Dodaj novi proizvod</a>
</body>

</html>