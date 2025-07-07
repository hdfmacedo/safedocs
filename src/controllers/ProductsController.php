<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Product.php';
require_once __DIR__ . '/../ProductLine.php';

class ProductsController extends BaseController {
    public function index(): void {
        $user = Auth::user();
        if (!$user || $user['type'] !== 'Admin') {
            header('Location: index.php');
            exit;
        }
        Product::init();
        ProductLine::init();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $line = (int)$_POST['product_line_id'];
            if (isset($_POST['id'])) {
                Product::update((int)$_POST['id'], $_POST['name'], $_POST['description'], $line);
                Logger::info($user['username'], 'update_product', 'Updated product ' . $_POST['id']);
            } else {
                Product::create($_POST['name'], $_POST['description'], $line);
                Logger::info($user['username'], 'create_product', 'Created product');
            }
            header('Location: products.php');
            exit;
        }
        $products = Product::all();
        $lines = ProductLine::all();
        $this->render('products', ['products' => $products, 'lines' => $lines, 'user' => $user, 'title' => 'Produtos']);
    }
}
?>
