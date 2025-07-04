<?php
require_once __DIR__ . '/../src/Auth.php';
Auth::start();
User::init();
$user = Auth::user();
if (!$user) {
    header('Location: login.php');
    exit;
}
$err = '';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old = $_POST['old_password'] ?? '';
    $new = $_POST['new_password'] ?? '';
    if (User::authenticate($user['username'], $old) && User::updatePassword($user['id'], $new)) {
        Logger::info($user['username'], 'change_password', 'Password changed');
        $msg = 'Senha atualizada';
    } else {
        $err = 'Falha ao trocar senha';
        Logger::error($user['username'], 'change_password', 'Failed password change');
    }
}
$dark = isset($_COOKIE['dark']) ? 'dark' : '';
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
        <?php if ($user['type'] === 'Admin'): ?>
        <li><a href="users.php">Usuários</a></li>
        <?php endif; ?>
        <li><strong>Trocar Senha</strong></li>
    </ul>
    <div class="bottom">
        <button onclick="location.href='index.php?logout=1'">Logout</button>
        <button id="dark-toggle" class="toggle-switch"><span class="light">☀</span><span class="dark">🌙</span></button>
    </div>
</nav>
<main class="content">
    <h1>Trocar Senha</h1>
    <?php if ($err) echo "<p style='color:red;'>$err</p>"; ?>
    <?php if ($msg) echo "<p style='color:green;'>$msg</p>"; ?>
    <form method="post">
        <label>Senha atual: <input type="password" name="old_password" required></label><br>
        <label>Nova senha: <input type="password" name="new_password" required></label><br>
        <button type="submit">Salvar</button>
    </form>
</main>
</div>
<script src="toggle.js"></script>
</body>
</html>
