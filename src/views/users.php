<h1>Usuários</h1>
<table>
    <tr><th>Nome</th><th>Tipo</th><th>Last login</th><th>Actions</th></tr>
    <?php foreach ($users as $u): ?>
    <tr>
        <td><?php echo htmlspecialchars($u['username']); ?></td>
        <td><?php echo htmlspecialchars($u['type']); ?></td>
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
            <form method="post" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $u['id']; ?>">
                <select name="type">
                    <option value="User" <?php if ($u['type']==='User') echo 'selected'; ?>>User</option>
                    <option value="Admin" <?php if ($u['type']==='Admin') echo 'selected'; ?>>Admin</option>
                </select>
                <button class="btn" type="submit">Salvar</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
