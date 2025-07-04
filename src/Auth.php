<?php
require_once __DIR__ . '/User.php';

class Auth {
    public static function start() {
        if (session_status() == PHP_SESSION_NONE) {
            $config = parse_ini_file(__DIR__ . '/../conf.env');
            $secret = $config['SESSION_SECRET'] ?? 'secret';
            session_name('safedocs');
            session_start([
                'cookie_httponly' => true,
                'cookie_samesite' => 'Lax'
            ]);
        }
    }

    public static function login($username, $password) {
        $user = User::authenticate($username, $password);
        if ($user) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'type' => $user['type']
            ];
            Logger::info($user['username'], 'login', 'User logged in');
            return true;
        }
        Logger::error($username, 'login', 'Failed login');
        return false;
    }

    public static function logout() {
        if (isset($_SESSION['user'])) {
            Logger::info($_SESSION['user']['username'], 'logout', 'User logged out');
        }
        $_SESSION = [];
        session_destroy();
    }

    public static function user() {
        return $_SESSION['user'] ?? null;
    }
}
?>
