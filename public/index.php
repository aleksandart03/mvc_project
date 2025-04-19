<?php

session_start();

require_once '../app/controllers/ProductController.php';

$action = $_GET['action'] ?? 'index';

$controller = new ProductController();

switch ($action) {
    case 'index':
        $controller->index();
        break;
}
