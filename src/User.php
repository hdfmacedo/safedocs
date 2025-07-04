<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Logger.php';

class User {
    public $id;
    public $username;
    public $type;

    public static function init() {
        $db = Database::getConnection();
        $db->exec("CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT UNIQUE,
            password TEXT,
            type TEXT
        )");

        // Create admin if not exists
        $stmt = $db->prepare('SELECT COUNT(*) FROM users WHERE username = ?');
        $stmt->execute(['admin']);
        if ($stmt->fetchColumn() == 0) {
            $hash = password_hash('admin', PASSWORD_DEFAULT);
            $stmt = $db->prepare('INSERT INTO users (username, password, type) VALUES (?, ?, ?)');
            $stmt->execute(['admin', $hash, 'Admin']);
            Logger::info('system', 'init', 'Created default admin user');
        }
    }

    public static function register($username, $password) {
        $db = Database::getConnection();
        $stmt = $db->prepare('INSERT INTO users (username, password, type) VALUES (?, ?, ?)');
        return $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT), 'User']);
    }

    public static function authenticate($username, $password) {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
?>
