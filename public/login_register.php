<?php

require_once __DIR__ . '/../app/controllers/AuthController.php';


$controller = new AuthController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $controller->register($username, $email, $password);
    } elseif (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $controller->login($email, $password);
    }
}

include __DIR__ . '/../app/views/login_register_view.php';
