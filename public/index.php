<?php

require_once '../app/controllers/ProductController.php';

$action = $_GET['action'] ?? 'index';

$controller = new ProductController();

switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store();
        break;
    case 'delete':
        $controller->delete();
        break;
}
