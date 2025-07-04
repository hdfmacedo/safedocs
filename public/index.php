<?php
require_once __DIR__ . '/../src/controllers/HomeController.php';
Auth::start();
User::init();
if (isset($_GET['logout'])) {
    Auth::logout();
    header('Location: index.php');
    exit;
}
$controller = new HomeController();
$controller->index();
?>
