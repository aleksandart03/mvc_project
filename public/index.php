<?php

session_start();

require_once '../autoload.php';

$action = $_GET['action'] ?? 'index';

$controller = new ProductController();

switch ($action) {
    case 'index':
        $controller->index();
        break;
}
