<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<title><?= htmlspecialchars($title ?? '') ?></title>
</head>
<body class="<?= $dark ?>">
<?php if (isset($user)): ?>
<div class="layout">
    <?php require __DIR__ . '/partials/menu.php'; ?>
    <main class="content">
        <?= $content ?>
    </main>
</div>
<?php else: ?>
<?= $content ?>
<?php endif; ?>
<script src="toggle.js"></script>
<script src="edit.js"></script>
</body>
</html>
