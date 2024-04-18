<?php
class VoucherModel {
    private $conn;
    private $table_name = "voucher";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllVouchers() {
        $query = "SELECT id, name, isSave, isUse, value, description FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getVoucherById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function saveVoucherForUser($id, $user_id) {
        $query = "UPDATE " . $this->table_name . " SET user_id=:user_id WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $user_id); // Chỉnh sửa thành :user_id để thiết lập giá trị của user_id
    
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    public function addVoucher($name, $description, $value) {
        $query = "INSERT INTO " . $this->table_name . " (name, description, value) VALUES (:name, :description, :value)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':value', $value);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function updateVoucher($id, $name, $description, $value) {
        $query = "UPDATE " . $this->table_name . " SET name=:name, description=:description, value=:value WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':value', $value);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function deleteVoucher($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
