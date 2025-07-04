<?php
require_once __DIR__ . '/../src/Auth.php';
Auth::start();
User::init();

if (isset($_GET['logout'])) {
    Auth::logout();
    header('Location: login.php');
    exit;
}

$user = Auth::user();
$dark = isset($_COOKIE['dark']) ? 'dark' : '';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<title>Home</title>
</head>
<body class="<?php echo $dark; ?>">
<?php if ($user): ?>
    <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?></h1>
    <p>Type: <?php echo htmlspecialchars($user['type']); ?></p>
    <p><a href="?logout=1">Logout</a></p>
<?php else: ?>
    <p><a href="login.php">Login</a> | <a href="register.php">Register</a></p>
<?php endif; ?>
<p><a href="readme.php">View README</a></p>
<p><a href="?dark=toggle">Toggle dark mode</a></p>
<?php
if (isset($_GET['dark']) && $_GET['dark'] === 'toggle') {
    if (isset($_COOKIE['dark'])) {
        setcookie('dark', '', time()-3600);
    } else {
        setcookie('dark', '1', time()+3600*24*30);
    }
    header('Location: index.php');
}
?>
</body>
</html>
