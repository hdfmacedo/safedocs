<?php
require_once __DIR__ . '/../src/Auth.php';
Auth::start();
User::init();

$user = Auth::user();
if (!$user) {
    header('Location: index.php');
    exit;
}

$dark = isset($_COOKIE['dark']) ? 'dark' : '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ok = User::changePassword($user['id'], $_POST['old_password'], $_POST['new_password']);
    if ($ok) {
        Logger::info($user['username'], 'change_password', 'Password changed');
        $message = 'Senha alterada.';
    } else {
        $message = 'Senha atual incorreta.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<title>Trocar Senha</title>
</head>
<body class="<?php echo $dark; ?>">
<div class="layout">
    <nav class="menu">
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="change_password.php"><strong>Trocar Senha</strong></a></li>
        </ul>
        <div class="bottom">
            <button onclick="location.href='index.php?logout=1'">Logout</button>
            <button id="dark-toggle" class="toggle"><span class="sun">☀</span><span class="moon">🌙</span><span class="knob"></span></button>
        </div>
    </nav>
    <main class="content">
        <h1>Trocar Senha</h1>
        <?php if ($message) echo '<p>' . htmlspecialchars($message) . '</p>'; ?>
        <form method="post">
            <label>Senha Atual:<br><input type="password" name="old_password" required></label><br>
            <label>Nova Senha:<br><input type="password" name="new_password" required></label><br>
            <button type="submit">Salvar</button>
        </form>
    </main>
</div>
<script src="toggle.js"></script>
</body>
</html>
