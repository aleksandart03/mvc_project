<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/checkout.css">
</head>

<body>

    <div class="container">
        <h2>Checkout</h2>

        <?php if (!empty($products)): ?>
            <div class="checkout-container">
                <h3>Proizvodi u vašoj korpi:</h3>
                <?php
                $totalPrice = 0;
                foreach ($products as $product):
                    $productTotal = $product['price'] * $product['quantity'];
                    $totalPrice += $productTotal;
                ?>
                    <div class="checkout-item">
                        <h4><?= htmlspecialchars($product['name']) ?></h4>
                        <p>Cena: €<?= number_format($product['price'], 2) ?></p>
                        <p>Količina: <?= $product['quantity'] ?></p>
                        <p>Ukupno: €<?= number_format($productTotal, 2) ?></p>
                    </div>
                <?php endforeach; ?>

                <span class="total-price">Ukupna cena: €<?= number_format($totalPrice, 2) ?></span>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <form method="POST" action="checkout.php?action=processCheckout">
                        <button type="submit" class="btn btn-success checkout-button">Završi kupovinu</button>
                    </form>
                <?php else: ?>
                    <form method="POST" action="checkout.php?action=processCheckout">
                        <div class="form-group">
                            <label for="guest_name">Ime:</label>
                            <input type="text" name="guest_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="guest_email">Email:</label>
                            <input type="email" name="guest_email" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success checkout-button">Završi kupovinu kao gost</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center mt-5">
                <p>Vaša korpa je prazna.</p>
                <a href="index.php" class="btn btn-primary mt-3">⬅️ Povratak na prodavnicu</a>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>