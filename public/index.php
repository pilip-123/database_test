<?php
require_once '../controllers/AuthController.php';

$action = $_GET['action'] ?? '';

$auth = new AuthController();

switch ($action) {
    case 'login':
        $auth->login();
        break;

    case 'register':
        $auth->register();
        break;

    case 'googleLogin':
        $auth->googleLogin();
        break;

    case 'logout':
        $auth->logout();
        break;

    default:
        require_once '../views/auth/login.php';
}