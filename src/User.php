<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Logger.php';

class User {
    public $id;
    public $username;
    public $type;

    public static function init() {
        $db = Database::getConnection();

        $stmt = sqlsrv_query($db, "SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'users'");
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC);
        if ($row[0] == 0) {
            $sql = "CREATE TABLE users (
                id INT IDENTITY(1,1) PRIMARY KEY,
                username NVARCHAR(255) UNIQUE,
                password NVARCHAR(255),
                type NVARCHAR(50),
                last_login DATETIME NULL
            )";
            sqlsrv_query($db, $sql);
        }

        $stmt = sqlsrv_query($db, "SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'last_login'");
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC);
        if ($row[0] == 0) {
            sqlsrv_query($db, 'ALTER TABLE users ADD last_login DATETIME NULL');
        }

        // Create admin if not exists
        $stmt = sqlsrv_query($db, 'SELECT COUNT(*) FROM users WHERE username = ?', ['admin']);
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC);
        if ($row[0] == 0) {
            $hash = password_hash('admin', PASSWORD_DEFAULT);
            sqlsrv_query($db, 'INSERT INTO users (username, password, type) VALUES (?, ?, ?)', ['admin', $hash, 'Admin']);
            Logger::info('system', 'init', 'Created default admin user');
        }
    }

    public static function register($username, $password) {
        $db = Database::getConnection();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = sqlsrv_query($db, 'INSERT INTO users (username, password, type) VALUES (?, ?, ?)', [$username, $hash, 'User']);
        return $stmt !== false;
    }

    public static function authenticate($username, $password) {
        $db = Database::getConnection();
        $stmt = sqlsrv_query($db, 'SELECT * FROM users WHERE username = ?', [$username]);
        if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            if (password_verify($password, $row['password'])) {
                return $row;
            }
        }
        return false;
    }

    public static function all() {
        $db = Database::getConnection();
        $stmt = sqlsrv_query($db, 'SELECT id, username, type, last_login FROM users');
        $users = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $users[] = $row;
        }
        return $users;
    }

    public static function updateType($id, $type) {
        $db = Database::getConnection();
        $stmt = sqlsrv_query($db, 'UPDATE users SET type = ? WHERE id = ?', [$type, $id]);
        return $stmt !== false;
    }

    public static function recordLogin($id) {
        $db = Database::getConnection();
        sqlsrv_query($db, 'UPDATE users SET last_login = GETDATE() WHERE id = ?', [$id]);
    }

    public static function changePassword($id, $old, $new) {
        $db = Database::getConnection();
        $stmt = sqlsrv_query($db, 'SELECT password FROM users WHERE id = ?', [$id]);
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        if (!$row || !password_verify($old, $row['password'])) {
            return false;
        }
        $hash = password_hash($new, PASSWORD_DEFAULT);
        $stmt = sqlsrv_query($db, 'UPDATE users SET password = ? WHERE id = ?', [$hash, $id]);
        return $stmt !== false;
    }
}
?>
