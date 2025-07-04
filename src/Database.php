<?php
class Database {
    private static $pdo;

    public static function getConnection() {
        if (!self::$pdo) {
            $config = parse_ini_file(__DIR__ . '/../conf.env');
            $dsn = $config['DSN'] ?? '';
            $user = $config['DB_USER'] ?? '';
            $pass = $config['DB_PASS'] ?? '';
            self::$pdo = new PDO($dsn, $user, $pass);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
}
?>
