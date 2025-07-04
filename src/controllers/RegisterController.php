<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../User.php';

class RegisterController extends BaseController {
    public function register(): void {
        $err = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (User::register($_POST['username'], $_POST['password'])) {
                Logger::info($_POST['username'], 'register', 'User registered');
                header('Location: index.php');
                exit;
            }
            $err = 'Failed to register';
        }
        $this->render('register', ['err' => $err, 'title' => 'Register']);
    }
}
?>
