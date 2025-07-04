<?php
require_once __DIR__ . '/../src/Auth.php';
Auth::start();
User::init();
$user = Auth::user();
$dark = isset($_COOKIE['dark']) ? 'dark' : '';
$path = __DIR__ . '/../README.md';
$readme = file_exists($path) ? file_get_contents($path) : 'README not available.';
Logger::info($user['username'] ?? 'guest', 'readme', 'Viewed README');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<title>README</title>
</head>
<body class="<?php echo $dark; ?>">
<h1>README</h1>
<pre><?php echo htmlspecialchars($readme); ?></pre>
<p><a href="index.php">Back</a></p>
<p><a href="?dark=toggle">Toggle dark mode</a></p>
<?php
if (isset($_GET['dark']) && $_GET['dark'] === 'toggle') {
    if (isset($_COOKIE['dark'])) {
        setcookie('dark', '', time()-3600);
    } else {
        setcookie('dark', '1', time()+3600*24*30);
    }
    header('Location: readme.php');
}
?>
</body>
</html>
