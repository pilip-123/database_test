<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Get controller and action from URL
$controller = $_GET['controller'] ?? 'product';
$action = $_GET['action'] ?? 'index';

// Allow auth actions without login
$authActions = ['login', 'register', 'googleLogin', 'logout', 'showLogin'];
$isAuthController = ($controller === 'auth');
$isAuthAction = in_array($action, $authActions);

// Check if user is logged in (skip for auth actions)
if (!isset($_SESSION['user_id']) && !($isAuthController && $isAuthAction)) {
    // User is not logged in, show login page directly
    require_once __DIR__ . '/Views/Auth/Login.php';
    exit();
}

// Format controller name
$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = __DIR__ . '/controllers/' . $controllerName . '.php';

// Check if controller file exists
if (file_exists($controllerFile)) {
    // Include the controller file
    require_once $controllerFile;
    
    // Check if class exists
    if (class_exists($controllerName)) {
        // Create controller instance
        $controllerInstance = new $controllerName();
        
        // Check if action method exists
        if (method_exists($controllerInstance, $action)) {
            // Execute the action
            $controllerInstance->$action();
        } else {
            die("Error: Action '$action' not found in controller '$controllerName'.");
        }
    } else {
        die("Error: Class '$controllerName' not found in file '$controllerFile'.");
    }
} else {
    die("Error: Controller file not found: $controllerFile");
}
?>