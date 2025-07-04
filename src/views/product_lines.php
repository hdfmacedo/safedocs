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
