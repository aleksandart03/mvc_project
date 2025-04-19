<?php

require_once '../app/models/User.php';

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
        session_start();
    }

    public function login($email, $password)
    {
        $result = $this->userModel->login($email, $password);

        if ($result['success']) {
            $_SESSION['user_id'] = $result['user']['id'];
            $_SESSION['role'] = $result['user']['role'];
            $_SESSION['username'] = $result['user']['username'];

            if ($result['user']['role'] === 'admin') {
                header("Location: /mvc_project/public/admin.php");
            } else {
                header("Location: /mvc_project/public/index.php");
            }
            exit;
        } else {

            echo $result['message'];
        }
    }

    public function register($username, $email, $password)
    {
        $result = $this->userModel->register($username, $email, $password);

        if ($result['success']) {
            header("Location: login.php?msg=success");
            exit;
        } else {
            echo $result['message'];
        }
    }
}
