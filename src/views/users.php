<h1>Usuários</h1>
<table>
    <tr><th>Nome</th><th>Tipo</th><th>Last login</th><th>Ações</th></tr>
    <?php foreach ($users as $u): ?>
    <?php $formId = 'user-form-' . $u['id']; ?>
    <tr data-id="<?php echo $u['id']; ?>">
        <td>
            <span class="view"><?php echo htmlspecialchars($u['username']); ?></span>
        </td>
        <td>
            <span class="view"><?php echo htmlspecialchars($u['type']); ?></span>
            <select form="<?php echo $formId; ?>" name="type" class="edit-input" style="display:none;">
                <option value="User" <?php if ($u['type']==='User') echo 'selected'; ?>>User</option>
                <option value="Admin" <?php if ($u['type']==='Admin') echo 'selected'; ?>>Admin</option>
            </select>
        </td>
        <td><?php
            if ($u['last_login']) {
                echo $u['last_login']->format('d/m/Y H:i:s');
                $diff = (new DateTime())->diff($u['last_login']);
                if ($diff->days > 0) {
                    echo ' (' . $diff->days . ' days ago)';
                } elseif ($diff->h > 0) {
                    echo ' (' . $diff->h . ' hours ago)';
                } elseif ($diff->i > 0) {
                    echo ' (' . $diff->i . ' minutes ago)';
                }
            } else {
                echo 'Never';
            }
        ?></td>
        <td>
            <form id="<?php echo $formId; ?>" method="post" style="display:none;">
                <input type="hidden" name="id" value="<?php echo $u['id']; ?>">
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
