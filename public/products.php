<?php
require_once __DIR__ . '/../src/controllers/ProductsController.php';
Auth::start();
User::init();
$controller = new ProductsController();
$controller->index();
?>
