<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <title>Prodavnica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/product_list_style.css">
</head>

<body>

    <?php if (!isset($_SESSION['user_id'])): ?>
        <div class="login-register-link">
            <a href="/mvc_project/public/login_register.php" class="btn btn-outline-primary">Prijavi se / Registruj</a>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="logout-link">
            <span class="me-2">Dobrodošli, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
            <a href="/mvc_project/public/logout.php" class="btn btn-outline-danger">Logout</a>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['added_to_cart'])): ?>
        <div class="alert alert-success animated-alert">
            Proizvod je dodat u korpu!
        </div>
        <?php unset($_SESSION['added_to_cart']); ?>
    <?php endif; ?>


    <a href="/mvc_project/public/cart.php" class="ikonica text-dark"><i class='bx bxs-cart'></i></a>

    <div class="container">

        <h2 class="page-title">Prodavnica mobilnih uređaja i laptopova</h2>

        <div class="filteri">
            <form method="GET" action="/mvc_project/public/index.php" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="category" class="form-label">Kategorija</label>
                    <select name="category_id" id="category" class="form-select" onchange="this.form.submit()">
                        <option value="">Sve kategorije</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" <?= (($_GET['category_id'] ?? '') == $category['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="sort" class="form-label"><i class="bi bi-filter"></i> Sortiranje</label>
                    <select name="sort" id="sort" class="form-select" onchange="this.form.submit()">
                        <option value="">Bez sortiranja</option>
                        <option value="name_asc" <?= ($_GET['sort'] ?? '') == 'name_asc' ? 'selected' : '' ?>>Naziv (A-Z)</option>
                        <option value="name_desc" <?= ($_GET['sort'] ?? '') == 'name_desc' ? 'selected' : '' ?>>Naziv (Z-A)</option>
                        <option value="price_asc" <?= ($_GET['sort'] ?? '') == 'price_asc' ? 'selected' : '' ?>>Cena (rastuće)</option>
                        <option value="price_desc" <?= ($_GET['sort'] ?? '') == 'price_desc' ? 'selected' : '' ?>>Cena (opadajuće)</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="search" class="form-label">Pretraga</label>
                    <div class="input-group">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Pretraži proizvode..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                        <button class="btn btn-primary" type="submit">Traži</button>
                    </div>
                </div>
            </form>

            <div class="mt-3 text-end">
                <a href="/mvc_project/public/index.php#" class="btn btn-secondary">Resetuj filtere</a>
            </div>
        </div>

        <p class="total-products-info">
            Prikazano <?= count($products) ?> od ukupno <?= $totalProducts ?> proizvoda
        </p>

        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4">
                    <div class="product-card">
                        <h5><?= htmlspecialchars($product->name) ?></h5>
                        <p><?= htmlspecialchars($product->description) ?></p>
                        <p class="fw-bold">Cena: €<?= number_format($product->price, 2) ?></p>
                        <form method="POST" action="/mvc_project/public/index.php?action=add_to_cart">
                            <input type="hidden" name="product_id" value="<?= $product->id ?>">
                            <div class="mb-2">
                                <label for="quantity_<?= $product->id ?>" class="form-label">Količina:</label>
                                <input type="number" id="quantity_<?= $product->id ?>" name="quantity" value="1" min="1" max="20" class="form-control" style="width: 80px;">
                            </div>
                            <button type="submit" class="btn btn-success add-to-cart-btn">Dodaj u korpu</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <nav class="mt-4">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>

    </div>

    <script>
        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                btn.classList.remove('bounce');
                void btn.offsetWidth;
                btn.classList.add('bounce');
            });
        });
    </script>

</body>

</html>