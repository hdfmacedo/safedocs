<nav class="menu">
    <ul>
        <li><a href="index.php">Início</a></li>
        <?php if ($user['type'] === 'Admin'): ?>
        <li>Admin
            <ul>
                <li><a href="users.php">Usuários</a></li>
                <li><a href="product_lines.php">Linhas de Produto</a></li>
                <li><a href="products.php">Produtos</a></li>
            </ul>
        </li>
        <?php endif; ?>
        <li><a href="change_password.php">Trocar Senha</a></li>
    </ul>
    <div class="bottom">
        <button class="btn" onclick="location.href='?logout=1'">Logout</button>
        <button id="dark-toggle" class="toggle"><span class="sun">☀</span><span class="moon">🌙</span><span class="knob"></span></button>
    </div>
</nav>
