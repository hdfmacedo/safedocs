<?php
require_once __DIR__ . '/../src/controllers/RegisterController.php';
Auth::start();
User::init();
$controller = new RegisterController();
$controller->register();
?>
