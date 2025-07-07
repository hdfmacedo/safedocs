<h1>Produtos</h1>
<h2>Novo Produto</h2>
<form method="post">
    <label>Nome:<br><input type="text" name="name" required></label><br>
    <label>Descrição:<br><textarea name="description" rows="3" cols="40" required></textarea></label><br>
    <label>Linha:<br>
        <select name="product_line_id">
            <?php foreach ($lines as $l): ?>
            <option value="<?php echo $l['id']; ?>"><?php echo htmlspecialchars($l['name']); ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <button class="btn" type="submit">Adicionar</button>
</form>
<h2>Existentes</h2>
<table>
    <tr><th>Nome</th><th>Descrição</th><th>Linha</th><th>Ação</th></tr>
    <?php foreach ($products as $p): ?>
    <tr>
        <td><?php echo htmlspecialchars($p['name']); ?></td>
        <td><?php echo htmlspecialchars($p['description']); ?></td>
        <td><?php echo htmlspecialchars($p['line_name']); ?></td>
        <td>
            <form method="post" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                <input type="text" name="name" value="<?php echo htmlspecialchars($p['name']); ?>" required>
                <textarea name="description" rows="2" cols="20" required><?php echo htmlspecialchars($p['description']); ?></textarea>
                <select name="product_line_id">
                    <?php foreach ($lines as $l): ?>
                    <option value="<?php echo $l['id']; ?>" <?php if ($l['id'] == $p['product_line_id']) echo 'selected'; ?>><?php echo htmlspecialchars($l['name']); ?></option>
                    <?php endforeach; ?>
                </select>
                <button class="btn" type="submit">Salvar</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
