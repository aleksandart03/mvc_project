<?php
session_start();
require_once '../autoload.php';

$action = $_GET['action'] ?? 'index';

$controller = new CheckoutController();

switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'processCheckout':
        $controller->processCheckout();
        break;
}
