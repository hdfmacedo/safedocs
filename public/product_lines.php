<?php
require_once __DIR__ . '/../src/controllers/ProductLinesController.php';
Auth::start();
User::init();
$controller = new ProductLinesController();
$controller->index();
?>
