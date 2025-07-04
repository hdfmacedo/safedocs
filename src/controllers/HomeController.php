<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../User.php';

class HomeController extends BaseController {
    public function index(): void {
        $user = Auth::user();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$user) {
            if (Auth::login($_POST['username'], $_POST['password'])) {
                header('Location: index.php');
                exit;
            }
            $error = 'Credenciais inválidas';
        }
        $this->render('home', ['user' => $user, 'error' => $error ?? null, 'title' => 'SafeDocs']);
    }
}
?>
