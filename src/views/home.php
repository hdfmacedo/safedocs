<?php if (!$user): ?>
<div class="login-container">
    <h1>Login</h1>
    <?php if (!empty($error)): ?><p class="error"><?php echo $error; ?></p><?php endif; ?>
    <form method="post">
        <label>Usuário:<br><input type="text" name="username" required></label><br>
        <label>Senha:<br><input type="password" name="password" required></label><br>
        <button class="btn" type="submit">Entrar</button>
    </form>
    <p class="link"><a href="register.php">Cadastre-se</a></p>
</div>
<?php else: ?>
<h1>Bem-vindo, <?php echo htmlspecialchars($user['username']); ?></h1>
<?php endif; ?>
