<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Logger.php';

class ProductLine {
    public static function init() {
        $db = Database::getConnection();
        $stmt = sqlsrv_query($db, "SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'product_lines'");
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC);
        if ($row[0] == 0) {
            $sql = "CREATE TABLE product_lines (
                id INT IDENTITY(1,1) PRIMARY KEY,
                name NVARCHAR(255),
                description NVARCHAR(MAX)
            )";
            sqlsrv_query($db, $sql);
        }
    }

    public static function all() {
        $db = Database::getConnection();
        $stmt = sqlsrv_query($db, 'SELECT * FROM product_lines');
        $lines = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $lines[] = $row;
        }
        return $lines;
    }

    public static function create($name, $desc) {
        $db = Database::getConnection();
        $stmt = sqlsrv_query($db, 'INSERT INTO product_lines (name, description) VALUES (?, ?)', [$name, $desc]);
        return $stmt !== false;
    }

    public static function update($id, $name, $desc) {
        $db = Database::getConnection();
        $stmt = sqlsrv_query($db, 'UPDATE product_lines SET name = ?, description = ? WHERE id = ?', [$name, $desc, $id]);
        return $stmt !== false;
    }
}
?>
