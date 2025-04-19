<?php
session_start();
require_once '../app/controllers/AdminController.php';

$controller = new AdminController();


$action = $_GET['action'] ?? '';

switch ($action) {
    case 'create':
        $controller->create();
        break;

    case 'store':
        $controller->store();
        break;

    case 'edit':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $controller->edit($id);
        }
        break;

    case 'update':
        $controller->update();
        break;

    case 'delete':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $controller->delete($id);
        }
        break;

    default:
        $controller->index();
        break;
}
