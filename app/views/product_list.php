<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Prodavnica</title>
    <link rel="stylesheet" href="/mvc_project/public/styles/main.css">
    <link rel="stylesheet" href="/mvc_project/public/styles/product_list_style.css">
</head>

<body>

    <?php if (!isset($_SESSION['user_id'])): ?>
        <div class="login-register-link">
            <a href="/mvc_project/public/login_register.php">Prijavi se / Registruj</a>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="logout-link">
            <span>Dobrodošli, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
            <a href="/mvc_project/public/logout.php">Logout</a>
        </div>
    <?php endif; ?>


    <div class="container">

        <h2 class="page-title">Lista proizvoda</h2>

        <div class="filteri">
            <form method="GET" action="/mvc_project/public/index.php" class="combined-filters">
                <label for="category">Izaberite kategoriju:</label>
                <select name="category_id" id="category" onchange="this.form.submit()">
                    <option value="">Sve kategorije</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" <?= (($_GET['category_id'] ?? '') == $category['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="sort"><i class="bi bi-filter"></i> Sortiraj po:</label>
                <select name="sort" id="sort" onchange="this.form.submit()">
                    <option value="">Bez sortiranja</option>
                    <option value="name_asc" <?= ($_GET['sort'] ?? '') == 'name_asc' ? 'selected' : '' ?>>Naziv (A-Z)</option>
                    <option value="name_desc" <?= ($_GET['sort'] ?? '') == 'name_desc' ? 'selected' : '' ?>>Naziv (Z-A)</option>
                    <option value="price_asc" <?= ($_GET['sort'] ?? '') == 'price_asc' ? 'selected' : '' ?>>Cena (rastuće)</option>
                    <option value="price_desc" <?= ($_GET['sort'] ?? '') == 'price_desc' ? 'selected' : '' ?>>Cena (opadajuće)</option>
                </select>

                <input type="text" name="search" placeholder="Pretraži proizvode..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                <button type="submit">Pretraga</button>
            </form>
            <div class="reset-container">
                <a href="/mvc_project/public/index.php#" class="reset-btn">Resetuj filtere</a>
            </div>

        </div>
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <h3 class="product-name"><?= $product->name ?></h3>
                    <p class="product-description"><?= $product->description ?></p>
                    <p class="product-price">Cena: €<?= number_format($product->price, 2) ?></p>
                    <form method="POST" action="index.php">
                        <input type="hidden" name="product_id" value="<?= $product->id ?>">
                        <button type="submit" name="add_to_cart" class="add-to-cart-btn">Dodaj u korpu</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>




    </div>
</body>

</html>