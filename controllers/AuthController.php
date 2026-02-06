<?php
session_start();
require_once __DIR__ . '/../models/User.php';

class AuthController {

    public function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = User::findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: index.php");
        } else {
            echo "Login failed";
        }
    }

    public function register() {
        User::createLocal($_POST['name'], $_POST['email'], $_POST['password']);
        header("Location: index.php");
    }

    public function googleLogin() {
        $user = User::findOrCreateSocial(
            $_POST['name'],
            $_POST['email'],
            'google',
            $_POST['google_id']
        );

        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
    }
}