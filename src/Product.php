<?php
require_once __DIR__ . '/Database.php';

class Product {
    public static function init() {
        $db = Database::getConnection();
        $stmt = sqlsrv_query($db, "SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'products'");
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC);
        if ($row[0] == 0) {
            $sql = "CREATE TABLE products (\n".
                   "id INT IDENTITY(1,1) PRIMARY KEY,\n".
                   "name NVARCHAR(255),\n".
                   "description NVARCHAR(MAX),\n".
                   "product_line_id INT,\n".
                   "FOREIGN KEY(product_line_id) REFERENCES product_lines(id)\n".
                   ")";
            sqlsrv_query($db, $sql);
        }
    }

    public static function all() {
        $db = Database::getConnection();
        $stmt = sqlsrv_query($db, 'SELECT p.*, l.name AS line_name FROM products p LEFT JOIN product_lines l ON p.product_line_id = l.id');
        $items = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $items[] = $row;
        }
        return $items;
    }

    public static function create($name, $desc, $line) {
        $db = Database::getConnection();
        $stmt = sqlsrv_query($db, 'INSERT INTO products (name, description, product_line_id) VALUES (?, ?, ?)', [$name, $desc, $line]);
        return $stmt !== false;
    }

    public static function update($id, $name, $desc, $line) {
        $db = Database::getConnection();
        $stmt = sqlsrv_query($db, 'UPDATE products SET name = ?, description = ?, product_line_id = ? WHERE id = ?', [$name, $desc, $line, $id]);
        return $stmt !== false;
    }
}
?>
