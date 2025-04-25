<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <title>Vaša korpa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


    <link rel="stylesheet" href="styles/korpa.css">
</head>

<body class="bg-light">
    <div class="container py-5">

        <a href="index.php" class="btn btn-outline-secondary mb-4"><i class="bi bi-arrow-left"></i> Nazad na prodavnicu</a>

        <h2 class="mb-4 text-center">🛒 Vaša korpa</h2>

        <?php if (!empty($products)): ?>
            <div class="row g-4">
                <?php
                $totalPrice = 0;
                foreach ($products as $product):
                    $productTotal = $product['price'] * $product['quantity'];
                    $totalPrice += $productTotal;
                ?>
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                                <p class="card-text mb-1">Cena: <strong>€<?= number_format($product['price'], 2) ?></strong></p>
                                <p class="card-text mb-3">Ukupno: <strong>€<?= number_format($productTotal, 2) ?></strong></p>

                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <form method="POST" action="cart.php?action=decrease" class="d-inline">
                                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                        <button type="submit" class="btn btn-outline-secondary btn-sm" title="Ukloni"><i class="bi bi-dash-lg"></i></button>
                                    </form>

                                    <span class="fw-semibold">Količina: <?= $product['quantity'] ?></span>

                                    <form method="POST" action="cart.php?action=increase" class="d-inline">
                                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                        <button type="submit" class="btn btn-outline-secondary btn-sm" title="Dodaj"><i class="bi bi-plus-lg"></i></button>
                                    </form>

                                    <a href="cart.php?action=remove&id=<?= $product['id'] ?>" class="btn btn-outline-danger btn-sm ms-auto">🗑️ Ukloni</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="text-end mt-5">
                <h4 class="fw-bold">Ukupna cena: €<?= number_format($totalPrice, 2) ?></h4>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4 flex-wrap">
                <form method="GET" action="checkout.php">
                    <button type="submit" class="btn btn-success">✅ Završi kupovinu</button>
                </form>
                <form method="GET" action="cart.php">
                    <input type="hidden" name="action" value="clear">
                    <button type="submit" class="btn btn-outline-danger">🧹 Očisti korpu</button>
                </form>
            </div>

        <?php else: ?>
            <div class="alert alert-info text-center">
                Vaša korpa je prazna. <br>
                <a href="index.php" class="btn btn-primary mt-3">⬅️ Vrati se na kupovinu</a>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>