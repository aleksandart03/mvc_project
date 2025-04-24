<link rel="stylesheet" href="styles/korpa.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<a href="index.php" class="back-btn">Nazad na shop</a>

<h2>Vaša korpa:</h2>
<?php if (!empty($products)): ?>
    <div class="cart-container">
        <?php
        $totalPrice = 0;
        foreach ($products as $product):
            $productTotal = $product['price'] * $product['quantity'];
            $totalPrice += $productTotal;
        ?>
            <div class="cart-item">
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p>Cena: €<?= number_format($product['price'], 2) ?></p>
                <p>Ukupno: €<?= number_format($productTotal, 2) ?></p>

                <form method="POST" action="cart.php?action=increase" class="quantity-form">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <button type="submit" class="increase-btn"><i class="bi bi-plus-lg"></i></button>
                </form>

                <span class="quantity-display"> Količina: <?= $product['quantity'] ?></span>

                <form method="POST" action="cart.php?action=decrease" class="quantity-form">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <button type="submit" class="decrease-btn"><i class="bi bi-dash-lg"></i></button>
                </form>
                <a href="cart.php?action=remove&id=<?= $product['id'] ?>" class="remove-btn">Obriši</a>
            </div>
        <?php endforeach; ?>
    </div>

    <p><strong class="cena">Ukupna cena: €<?= number_format($totalPrice, 2) ?></strong></p>

    <form method="GET" action="cart.php">
        <input type="hidden" name="action" value="clear">
        <button type="submit" class="clear-cart-btn">Očisti korpu</button>
    </form>
<?php else: ?>
    <p>Vaša korpa je prazna.</p>
<?php endif; ?>