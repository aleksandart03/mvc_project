<?php
session_start();
require_once '../autoload.php';

$action = $_GET['action'] ?? 'index';

$controller = new CartController();

switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'increase':
        $controller->increaseQuantity();
        break;
    case 'decrease':
        $controller->decreaseQuantity();
        break;
    case 'remove':
        $controller->removeProduct();
        break;
    case 'clear':
        $controller->clearCart();
        break;
}
