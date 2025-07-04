<?php
require_once __DIR__ . '/../src/controllers/UsersController.php';
Auth::start();
User::init();
$controller = new UsersController();
$controller->index();
?>
