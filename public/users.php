<?php
require_once __DIR__ . '/../src/Auth.php';
Auth::start();
User::init();

$user = Auth::user();
if (!$user || $user['type'] !== 'Admin') {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'], $_POST['type'])) {
        if (User::updateType((int)$_POST['id'], $_POST['type'])) {
            Logger::info($user['username'], 'update_user', 'Changed user ' . $_POST['id'] . ' to ' . $_POST['type']);
        }
    }
    header('Location: users.php');
    exit;
}

$users = User::all();
$dark = isset($_COOKIE['dark']) ? 'dark' : '';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<title>Usuários</title>
</head>
<body class="<?php echo $dark; ?>">
<div class="layout">
    <nav class="menu">
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><strong>Usuários</strong></li>
            <li><a href="change_password.php">Trocar Senha</a></li>
        </ul>
        <div class="bottom">
            <button onclick="location.href='index.php?logout=1'">Logout</button>
            <button id="dark-toggle" class="toggle-switch"><span class="light">☀</span><span class="dark">🌙</span></button>
        </div>
    </nav>
    <main class="content">
        <h1>Usuários</h1>
        <table>
            <tr><th>Nome</th><th>Tipo</th><th>Ação</th></tr>
            <?php foreach ($users as $u): ?>
            <tr>
                <td><?php echo htmlspecialchars($u['username']); ?></td>
                <td><?php echo htmlspecialchars($u['type']); ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $u['id']; ?>">
                        <select name="type">
                            <option value="User" <?php if ($u['type']==='User') echo 'selected'; ?>>User</option>
                            <option value="Admin" <?php if ($u['type']==='Admin') echo 'selected'; ?>>Admin</option>
                        </select>
                        <button type="submit">Salvar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</div>
<script src="toggle.js"></script>
</body>
</html>
