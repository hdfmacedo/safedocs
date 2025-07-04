<?php
class Database {
    private static $conn;

    public static function getConnection() {
        if (!self::$conn) {
            $config = parse_ini_file(__DIR__ . '/../conf.env');
            foreach($config as $c => $v) {
                if (is_string($v)) {
                    $config[$c] = trim($v);
                }
            }
            $server = $config['SERVER'] ?? 'localhost';
            $info = [
                'Database' => $config['DATABASE'] ?? 'safedocs',
                'UID' => $config['DB_USER'] ?? '',
                'PWD' => $config['DB_PASS'] ?? '',
                'CharacterSet' => 'UTF-8'
            ];
            self::$conn = sqlsrv_connect($server, $info);
            if (!self::$conn) {
                throw new Exception(print_r(sqlsrv_errors(), true));
            }
        }
        return self::$conn;
    }
}
?>
