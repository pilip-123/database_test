<?php
// Fixed base path - change this if deploying to a different directory
$basePath = '/database_test/';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Shop Control</title>
    <base href="<?php echo $basePath; ?>">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            width: 300px;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-login {
            background-color: #007bff;
            color: white;
        }
        .btn-google {
            background-color: #db4437;
            color: white;
        }
        .btn-register {
            background-color: #28a745;
            color: white;
        }
        button:hover {
            opacity: 0.9;
        }
        .error {
            color: red;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Shop Control Login</h2>
        
        <?php if (isset($_GET['error'])): ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>
        
        <?php if (isset($_GET['success'])): ?>
            <p class="success" style="color: green; margin: 10px 0;">Registration successful! Please login.</p>
        <?php endif; ?>
        
        <form method="POST" action="?controller=auth&action=login">
            <input type="email" name="email" placeholder="Email" required autocomplete="off">
            <input type="password" name="password" placeholder="Password" required autocomplete="off">
            <button type="submit" class="btn-login">Login</button>
        </form>

        <form method="POST" action="?controller=auth&action=googleLogin">
            <input type="hidden" name="google_id" value="123456">
            <input type="hidden" name="name" value="Google User">
            <input type="hidden" name="email" value="google@gmail.com">
            <button type="submit" class="btn-google">Login with Google</button>
        </form>

        <form method="POST" action="?controller=auth&action=register" id="registerForm">
            <input type="text" name="name" id="regName" placeholder="Name" required autocomplete="off">
            <input type="email" name="email" id="regEmail" placeholder="Email" required autocomplete="off">
            <input type="password" name="password" id="regPassword" placeholder="Password" required autocomplete="off">
            <button type="submit" class="btn-register">Register</button>
        </form>

        <script>
        // Reset form values after successful login/registration or error
        function resetForms() {
            const urlParams = new URLSearchParams(window.location.search);
            
            // Reset registration form if there's an error or success message
            if (urlParams.has('error') || urlParams.has('success')) {
                document.getElementById('registerForm').reset();
            }
            
            // Reset login form if there's an error message
            if (urlParams.has('error')) {
                document.querySelector('form[action="?controller=auth&action=login"]').reset();
            }
            
            // Clean up URL to remove query parameters
            if (urlParams.has('error') || urlParams.has('success')) {
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        }
        
        // Run reset when page loads
        document.addEventListener('DOMContentLoaded', resetForms);
        </script>
    </div>
</body>
</html>
