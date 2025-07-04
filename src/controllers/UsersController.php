<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../User.php';

class UsersController extends BaseController {
    public function index(): void {
        $user = Auth::user();
        if (!$user || $user['type'] !== 'Admin') {
            header('Location: index.php');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['type'])) {
            if (User::updateType((int)$_POST['id'], $_POST['type'])) {
                Logger::info($user['username'], 'update_user', 'Changed user ' . $_POST['id']);
            }
            header('Location: users.php');
            exit;
        }
        $users = User::all();
        $this->render('users', ['users' => $users, 'user' => $user, 'title' => 'Usuários']);
    }
}
?>
