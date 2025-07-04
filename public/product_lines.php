<?php
require_once __DIR__ . '/../src/Common.php';
require_once __DIR__ . '/../src/Auth.php';
require_once __DIR__ . '/../src/ProductLine.php';
Auth::start();
User::init();
ProductLine::init();

$user = Auth::user();
if (!$user || $user['type'] !== 'Admin') {
    header('Location: index.php');
    exit;
}

$dark = isset($_COOKIE['dark']) ? 'dark' : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        ProductLine::update((int)$_POST['id'], $_POST['name'], $_POST['description']);
        Logger::info($user['username'], 'update_product_line', 'Updated line ' . $_POST['id']);
    } else {
        ProductLine::create($_POST['name'], $_POST['description']);
        Logger::info($user['username'], 'create_product_line', 'Created product line');
    }
    header('Location: product_lines.php');
    exit;
}

$lines = ProductLine::all();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<title>Linhas de Produto</title>
</head>
<body class="<?php echo $dark; ?>">
<div class="layout">
    <nav class="menu">
        <ul>
            <li><a href="index.php">Início</a></li>
            <li>Admin
                <ul>
                    <li><a href="users.php">Usuários</a></li>
                    <li><a href="product_lines.php"><strong>Linhas de Produto</strong></a></li>
                </ul>
            </li>
        </ul>
        <div class="bottom">
            <button onclick="location.href='index.php?logout=1'">Logout</button>
            <button id="dark-toggle" class="toggle"><span class="sun">☀</span><span class="moon">🌙</span><span class="knob"></span></button>
        </div>
    </nav>
    <main class="content">
        <h1>Linhas de Produto</h1>
        <h2>Nova Linha</h2>
        <form method="post">
            <label>Nome:<br><input type="text" name="name" required></label><br>
            <label>Descrição:<br><textarea name="description" rows="3" cols="40" required></textarea></label><br>
            <button type="submit">Adicionar</button>
        </form>
        <h2>Existentes</h2>
        <table>
            <tr><th>Nome</th><th>Descrição</th><th>Ação</th></tr>
            <?php foreach ($lines as $l): ?>
            <tr>
                <td><?php echo htmlspecialchars($l['name']); ?></td>
                <td><?php echo htmlspecialchars($l['description']); ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $l['id']; ?>">
                        <input type="text" name="name" value="<?php echo htmlspecialchars($l['name']); ?>" required>
                        <textarea name="description" rows="2" cols="20" required><?php echo htmlspecialchars($l['description']); ?></textarea>
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
