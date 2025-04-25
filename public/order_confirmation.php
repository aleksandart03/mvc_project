<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$orderId = isset($_GET['order_id']) ? intval($_GET['order_id']) : null;
?>

<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <title>Potvrda narudžbine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .confirmation-box {
            margin-top: 80px;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .btn-home {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center">
        <div class="confirmation-box text-center col-md-8">
            <?php if ($orderId): ?>
                <h1 class="text-success">✅ Narudžbina je uspešno kreirana!</h1>
                <p class="fs-5">Vaša šifra narudžbine je: <strong>#<?= htmlspecialchars($orderId) ?></strong></p>
                <p>Hvala što ste kupovali kod nas. Uskoro ćete dobiti potvrdu putem email-a ako ste ga uneli.</p>
            <?php else: ?>
                <h1 class="text-danger">❌ Došlo je do greške</h1>
                <p>Nažalost, nismo mogli da pronađemo informacije o vašoj narudžbini.</p>
            <?php endif; ?>

            <a href="index.php" class="btn btn-primary btn-home">⬅️ Nazad na prodavnicu</a>
        </div>
    </div>
</body>

</html>