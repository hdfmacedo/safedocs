<?php
require_once __DIR__ . '/../src/Auth.php';
Auth::start();
User::init();

$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (Auth::login($_POST['username'], $_POST['password'])) {
        header('Location: index.php');
        exit;
    } else {
        $err = 'Invalid credentials';
    }
}
$dark = isset($_COOKIE['dark']) ? 'dark' : '';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<title>Login</title>
</head>
<body class="<?php echo $dark; ?>">
<h1>Login</h1>
<?php if ($err) echo "<p style='color:red;'>$err</p>"; ?>
<form method="post">
<label>User: <input type="text" name="username"></label><br>
<label>Password: <input type="password" name="password"></label><br>
<button type="submit">Login</button>
</form>
<p><a href="register.php">Register</a></p>
<button id="dark-toggle" class="toggle-switch"><span class="light">☀</span><span class="dark">🌙</span></button>
<script src="toggle.js"></script>
</body>
</html>
