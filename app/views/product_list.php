<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Prodavnica</title>
    <link rel="stylesheet" href="/mvc_project/public/styles/main.css">
    <link rel="stylesheet" href="/mvc_project/public/styles/product_list_style.css">
</head>

<body>
    <div class="container">
        <h2 class="page-title">Lista proizvoda</h2>

        <div class="filteri">


            <form method="GET" action="/mvc_project/public/index.php" class="category-filter">
                <label for="category">Izaberite kategoriju:</label>
                <select name="category_id" id="category" onchange="this.form.submit()">
                    <option value="">Sve kategorije</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" <?= isset($_GET['category_id']) && $_GET['category_id'] == $category['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>


            <form method="GET" action="/mvc_project/public/index.php">
                <label for="sort">
                    <i class="bi bi-filter"></i> Sortiraj po:
                </label>
                <select name="sort" id="sort" onchange="this.form.submit()">
                    <option value="name_asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'name_asc' ? 'selected' : '' ?>>Naziv (A-Z)</option>
                    <option value="name_desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'name_desc' ? 'selected' : '' ?>>Naziv (Z-A)</option>
                    <option value="price_asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'price_asc' ? 'selected' : '' ?>>Cena (rastuće)</option>
                    <option value="price_desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'price_desc' ? 'selected' : '' ?>>Cena (opadajuće)</option>
                </select>
            </form>

            <form method="GET" action="/mvc_project/public/index.php" class="search-form">
                <input type="text" name="search" placeholder="Pretraži proizvode..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                <button type="submit">Pretraga</button>
            </form>
        </div>

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