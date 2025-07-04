<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../User.php';

class ChangePasswordController extends BaseController {
    public function index(): void {
        $user = Auth::user();
        if (!$user) {
            header('Location: index.php');
            exit;
        }
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok = User::changePassword($user['id'], $_POST['old_password'], $_POST['new_password']);
            if ($ok) {
                Logger::info($user['username'], 'change_password', 'Password changed');
                $message = 'Senha alterada.';
            } else {
                $message = 'Senha atual incorreta.';
            }
        }
        $this->render('change_password', ['user' => $user, 'message' => $message, 'title' => 'Trocar Senha']);
    }
}
?>
