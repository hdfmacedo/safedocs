<h1>Trocar Senha</h1>
<?php if ($message) echo '<p>' . htmlspecialchars($message) . '</p>'; ?>
<form method="post">
    <label>Senha Atual:<br><input type="password" name="old_password" required></label><br>
    <label>Nova Senha:<br><input type="password" name="new_password" required></label><br>
    <button class="btn" type="submit">Salvar</button>
</form>
