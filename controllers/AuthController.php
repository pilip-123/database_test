<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {

    public function login() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = User::findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: index.php");
            exit();
        } else {
            header("Location: index.php?controller=auth&action=showLogin&error=1");
            exit();
        }
    }

    public function showLogin() {
        require_once __DIR__ . '/../Views/Auth/Login.php';
        exit();
    }

    public function register() {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (empty($name) || empty($email) || empty($password)) {
            header("Location: index.php?controller=auth&action=showLogin&error=Please fill all fields");
            exit();
        }
        
        // Check if user already exists
        if (User::findByEmail($email)) {
            header("Location: index.php?controller=auth&action=showLogin&error=Email already exists");
            exit();
        }
        
        User::createLocal($name, $email, $password);
        header("Location: index.php?controller=auth&action=showLogin&success=1");
        exit();
    }

    public function googleLogin() {
        $user = User::findOrCreateSocial(
            $_POST['name'],
            $_POST['email'],
            'google',
            $_POST['google_id']
        );

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: index.php");
        exit();
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?controller=auth&action=showLogin");
        exit();
    }
}
?>
