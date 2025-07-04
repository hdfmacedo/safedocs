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
<button id="dark-toggle" class="toggle-switch"><span class="light">☀</span><span class="dark">🌙</span></button>
<script src="toggle.js"></script>
</body>
</html>
