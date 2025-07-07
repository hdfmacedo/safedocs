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
    <tr><th>Nome</th><th>Descrição</th><th>Linha</th><th>Ações</th></tr>
    <?php foreach ($products as $p): ?>
    <?php $formId = 'prod-form-' . $p['id']; ?>
    <tr data-id="<?php echo $p['id']; ?>">
        <td>
            <span class="view"><?php echo htmlspecialchars($p['name']); ?></span>
            <input form="<?php echo $formId; ?>" type="text" name="name" value="<?php echo htmlspecialchars($p['name']); ?>" class="edit-input" style="display:none;" required>
        </td>
        <td>
            <span class="view"><?php echo htmlspecialchars($p['description']); ?></span>
            <textarea form="<?php echo $formId; ?>" name="description" rows="2" cols="20" class="edit-input" style="display:none;" required><?php echo htmlspecialchars($p['description']); ?></textarea>
        </td>
        <td>
            <span class="view"><?php echo htmlspecialchars($p['line_name']); ?></span>
            <select form="<?php echo $formId; ?>" name="product_line_id" class="edit-input" style="display:none;">
                <?php foreach ($lines as $l): ?>
                <option value="<?php echo $l['id']; ?>" <?php if ($l['id'] == $p['product_line_id']) echo 'selected'; ?>><?php echo htmlspecialchars($l['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </td>
        <td>
            <form id="<?php echo $formId; ?>" method="post" style="display:none;">
                <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
            </form>
            <button type="button" class="btn edit-btn">Editar</button>
            <span class="edit-buttons" style="display:none;">
                <button form="<?php echo $formId; ?>" class="btn save-btn" type="submit">Salvar</button>
                <button type="button" class="btn cancel-btn">Cancelar</button>
            </span>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
