<?php
require_once __DIR__ . '/../src/controllers/ChangePasswordController.php';
Auth::start();
User::init();
$controller = new ChangePasswordController();
$controller->index();
?>
