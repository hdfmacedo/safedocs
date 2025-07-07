<h1>Linhas de Produto</h1>
<h2>Nova Linha</h2>
<form method="post">
    <label>Nome:<br><input type="text" name="name" required></label><br>
    <label>Descrição:<br><textarea name="description" rows="3" cols="40" required></textarea></label><br>
    <button class="btn" type="submit">Adicionar</button>
</form>
<h2>Existentes</h2>
<table>
    <tr><th>Nome</th><th>Descrição</th><th>Ações</th></tr>
    <?php foreach ($lines as $l): ?>
    <?php $formId = 'line-form-' . $l['id']; ?>
    <tr data-id="<?php echo $l['id']; ?>">
        <td>
            <span class="view"><?php echo htmlspecialchars($l['name']); ?></span>
            <input form="<?php echo $formId; ?>" type="text" name="name" value="<?php echo htmlspecialchars($l['name']); ?>" class="edit-input" style="display:none;" required>
        </td>
        <td>
            <span class="view"><?php echo htmlspecialchars($l['description']); ?></span>
            <textarea form="<?php echo $formId; ?>" name="description" rows="2" cols="20" class="edit-input" style="display:none;" required><?php echo htmlspecialchars($l['description']); ?></textarea>
        </td>
        <td>
            <form id="<?php echo $formId; ?>" method="post" style="display:none;">
                <input type="hidden" name="id" value="<?php echo $l['id']; ?>">
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
