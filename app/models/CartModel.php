<?php
class CartModel {
    private $conn;
    private $table_order = "orders_table";
    private $table_order_detail = "order_detail";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function beginTransaction() {
        $this->conn->beginTransaction();
    }

    public function commit() {
        $this->conn->commit();
    }

    public function rollBack() {
        $this->conn->rollBack();
    }

    public function calculateTotal() {
        $total = 0;
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $total += $item->quantity * $item->price;
            }
        }
        return $total;
    }
    

    public function createOrder($customer_name, $phone, $email, $address, $payment_method, $total_amount) {
        $query = "INSERT INTO " . $this->table_order . " (customer_name, phone, status, note, email, address, payment_method, total_amount) VALUES (:customer_name, :phone, 1, 'Đơn hàng ổn định', :email, :address, :payment_method, :total_amount)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':customer_name', $customer_name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':payment_method', $payment_method);
        $stmt->bindParam(':total_amount', $total_amount);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function addProductToOrder($orderId, $productId, $userId, $quantity, $price) {
        $query = "INSERT INTO " . $this->table_order_detail . " (order_id, product_id, user_id, quantity, price) VALUES (:order_id, :product_id, :user_id, :quantity, :price)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $orderId);
        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':price', $price);
        $stmt->execute();
    }

    public function getAllOrders() {
        $query = "SELECT * FROM " . $this->table_order;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getUserOrders($userId) {
        $query = "SELECT o.* FROM orders_table o 
                  INNER JOIN order_detail od ON o.id = od.order_id
                  WHERE od.user_id = :userId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    

    public function getOrderById($orderId) {
        $query = "SELECT * FROM " . $this->table_order . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $orderId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderDetails($orderId) {
        $query = "SELECT * FROM " . $this->table_order_detail . " WHERE order_id = :order_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $orderId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function calculateOrderTotal($orderDetails) {
        $totalAmount = 0;
        foreach ($orderDetails as $detail) {
            $totalAmount += $detail['quantity'] * $detail['price'];
        }
        return $totalAmount;
    }

    public function updateOrderDetailTotal($detailId, $total) {
        $query = "UPDATE " . $this->table_order_detail . " SET total = :total WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':id', $detailId);
        $stmt->execute();
    }

    public function updateOrderStatus($orderId, $newStatus) {
        $query = "UPDATE " . $this->table_order . " SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $newStatus);
        $stmt->bindParam(':id', $orderId);
        $stmt->execute();
    }
}
