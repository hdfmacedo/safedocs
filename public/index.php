<?php
require_once __DIR__ . '/../src/Common.php';
require_once __DIR__ . '/../src/Auth.php';
Auth::start();
User::init();

if (isset($_GET['logout'])) {
    Auth::logout();
    header('Location: index.php');
    exit;
}

$dark = isset($_COOKIE['dark']) ? 'dark' : '';
$user = Auth::user();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$user) {
    if (Auth::login($_POST['username'], $_POST['password'])) {
        header('Location: index.php');
        exit;
    } else {
        $error = 'Credenciais inválidas';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<title>SafeDocs</title>
</head>
<body class="<?php echo $dark; ?>">
<?php if (!$user): ?>
<div class="login-container">
    <h1>Login</h1>
    <?php if (!empty($error)): ?><p class="error"><?php echo $error; ?></p><?php endif; ?>
    <form method="post">
        <label>Usuário:<br><input type="text" name="username" required></label><br>
        <label>Senha:<br><input type="password" name="password" required></label><br>
        <button type="submit">Entrar</button>
    </form>
    <p class="link"><a href="register.php">Cadastre-se</a></p>
</div>
<?php else: ?>
<div class="layout">
    <nav class="menu">
        <ul>
            <li><a href="index.php">Início</a></li>
            <?php if ($user['type'] === 'Admin'): ?>
            <li>Admin
                <ul>
                    <li><a href="users.php">Usuários</a></li>
                    <li><a href="product_lines.php">Linhas de Produto</a></li>
                </ul>
            </li>
            <?php endif; ?>
            <li><a href="change_password.php">Trocar Senha</a></li>
        </ul>
        <div class="bottom">
            <button onclick="location.href='?logout=1'">Logout</button>
            <button id="dark-toggle" class="toggle">
                <span class="sun">☀</span>
                <span class="moon">🌙</span>
                <span class="knob"></span>
            </button>
        </div>
    </nav>
    <main class="content">
        <h1>Bem-vindo, <?php echo htmlspecialchars($user['username']); ?></h1>
    </main>
</div>
<script src="toggle.js"></script>
<?php endif; ?>
</body>
</html>
