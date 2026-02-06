<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {

    public function login() {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            // Set session cookie path before starting
            session_set_cookie_params(3600, '/');
            session_start();
        }
        
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            header("Location: index.php?controller=auth&action=showLogin&error=Please enter email and password");
            exit();
        }

        $user = User::findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['logged_in'] = true;
            $_SESSION['login_time'] = time();
            
            // Write and close the session before redirect
            session_write_close();
            
            header("Location: index.php");
            exit();
        } else {
            header("Location: index.php?controller=auth&action=showLogin&error=Invalid email or password");
            exit();
        }
    }

    public function showLogin() {
        require_once __DIR__ . '/../Views/Auth/Login.php';
        exit();
    }

    public function register() {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            // Set session cookie path before starting
            session_set_cookie_params(3600, '/');
            session_start();
        }
        
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
        header("Location: index.php?controller=auth&action=showLogin&success=Registration successful! Please login.");
        exit();
    }

    public function googleLogin() {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            // Set session cookie path before starting
            session_set_cookie_params(3600, '/');
            session_start();
        }
        
        $user = User::findOrCreateSocial(
            $_POST['name'],
            $_POST['email'],
            'google',
            $_POST['google_id']
        );

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['logged_in'] = true;
        $_SESSION['login_time'] = time();
        header("Location: index.php");
        exit();
    }

    public function logout() {
        // Clear all session variables
        $_SESSION = array();
        
        // Destroy the session
        session_destroy();
        
        // Redirect to login page
        header("Location: index.php?controller=auth&action=showLogin&message=You have been logged out");
        exit();
    }
}
?>
