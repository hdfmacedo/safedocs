<?php
require_once __DIR__ . '/../src/controllers/ReadmeController.php';
Auth::start();
User::init();
$controller = new ReadmeController();
$controller->show();
?>
