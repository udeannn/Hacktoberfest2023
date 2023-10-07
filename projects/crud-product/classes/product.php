<?php
require_once 'database.php';

class Product {
    private $conn;

    // Constructor
    public function __construct() {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    // Execute queries SQL
    public function runQuery($sql) {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    // Insert
    public function insert($product_name, $price_buy, $price_sell, $stock, $product_image) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO product (product_name, price_buy, price_sell, stock, product_image) VALUES (:product_name, :price_buy, :price_sell, :stock, :product_image)");
            $stmt->bindparam(":product_name", $product_name);
            $stmt->bindparam(":price_buy", $price_buy);
            $stmt->bindparam(":price_sell", $price_sell);
            $stmt->bindparam(":stock", $stock);
            $stmt->bindparam(":product_image", $product_image);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Update
    public function update($product_name, $price_buy, $price_sell, $stock, $product_image, $id) {
        try {
            $stmt = $this->conn->prepare("UPDATE product SET product_name=:product_name, price_buy=:price_buy, price_sell=:price_sell, stock=:stock, product_image=:product_image WHERE id=:id");
            $stmt->bindparam(":product_name", $product_name);
            $stmt->bindparam(":price_buy", $price_buy);
            $stmt->bindparam(":price_sell", $price_sell);
            $stmt->bindparam(":stock", $stock);
            $stmt->bindparam(":product_image", $product_image);
            $stmt->bindparam(":id", $id);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Delete
    public function delete($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM product WHERE id=:id");
            $stmt->bindparam(":id", $id);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Redirect URL method
    public function redirect($url) {
        header("Location: $url");
    }
}
