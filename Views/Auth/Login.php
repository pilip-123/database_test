<form method="POST" action="/public/index.php?action=login">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

<form method="POST" action="/public/index.php?action=googleLogin">
    <input type="hidden" name="google_id" value="123456">
    <input type="hidden" name="name" value="Google User">
    <input type="hidden" name="email" value="google@gmail.com">
    <button type="submit">Login with Google</button>
</form>