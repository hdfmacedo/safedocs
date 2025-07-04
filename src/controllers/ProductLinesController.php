<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../ProductLine.php';

class ProductLinesController extends BaseController {
    public function index(): void {
        $user = Auth::user();
        if (!$user || $user['type'] !== 'Admin') {
            header('Location: index.php');
            exit;
        }
        ProductLine::init();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id'])) {
                ProductLine::update((int)$_POST['id'], $_POST['name'], $_POST['description']);
                Logger::info($user['username'], 'update_product_line', 'Updated line ' . $_POST['id']);
            } else {
                ProductLine::create($_POST['name'], $_POST['description']);
                Logger::info($user['username'], 'create_product_line', 'Created product line');
            }
            header('Location: product_lines.php');
            exit;
        }
        $lines = ProductLine::all();
        $this->render('product_lines', ['lines' => $lines, 'user' => $user, 'title' => 'Linhas de Produto']);
    }
}
?>
