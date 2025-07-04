<?php
require_once __DIR__ . '/../src/Auth.php';
Auth::start();
User::init();

$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (User::register($_POST['username'], $_POST['password'])) {
        Logger::info($_POST['username'], 'register', 'User registered');
        header('Location: login.php');
        exit;
    } else {
        $err = 'Failed to register';
    }
}
$dark = isset($_COOKIE['dark']) ? 'dark' : '';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<title>Register</title>
</head>
<body class="<?php echo $dark; ?>">
<h1>Register</h1>
<?php if ($err) echo "<p style='color:red;'>$err</p>"; ?>
<form method="post">
<label>User: <input type="text" name="username"></label><br>
<label>Password: <input type="password" name="password"></label><br>
<button type="submit">Register</button>
</form>
<p><a href="login.php">Login</a></p>
<p><a href="readme.php">View README</a></p>
<p><a href="?dark=toggle">Toggle dark mode</a></p>
<?php
if (isset($_GET['dark']) && $_GET['dark'] === 'toggle') {
    if (isset($_COOKIE['dark'])) {
        setcookie('dark', '', time()-3600);
    } else {
        setcookie('dark', '1', time()+3600*24*30);
    }
    header('Location: register.php');
}
?>
</body>
</html>
