<?php
class AccountModel{
    private $conn;
    private $table_name = "account";

    public function __construct($db) {
        $this->conn = $db;
    }

    function getAccountByUsername($email){
        $query = "SELECT * FROM " . $this->table_name . " where email = :email";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":email", $email);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    function save($username, $name, $password, $role="user"){

        $query = "INSERT INTO " . $this->table_name . " (email, name, password, role) VALUES (:username, :name, :password, :role)";
        
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $name = htmlspecialchars(strip_tags($name));
        $username = htmlspecialchars(strip_tags($username));

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    function getAllUsers() {
        // Truy vấn cơ sở dữ liệu để lấy thông tin của tất cả người dùng
        $stmt = $this->conn->query("SELECT * FROM account");
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $users;
    }
    function deleteUser($id) {
        // Chuẩn bị câu truy vấn xóa người dùng
        $stmt = $this->conn->prepare("DELETE FROM account WHERE id = ?");
        
        // Thực thi truy vấn
        $stmt->execute([$id]);

        // Trả về true nếu xóa thành công, false nếu không thành công
        return $stmt->rowCount() > 0;
    }

    function lockUser($id) {
        
        $query = "UPDATE " . $this->table_name . " SET locked = 1 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    function updateProfile($email, $name,  $phone, $address) {
        try {
            // Chuẩn bị truy vấn SQL
            $query = "UPDATE " . $this->table_name . " SET email= :email, name = :name, phone = :phone, address = :address WHERE name = :name";
    
            // Chuẩn bị câu lệnh SQL
            $stmt = $this->conn->prepare($query);
    
            // Bind giá trị và tham số
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
    
            // Thực thi câu lệnh
            if ($stmt->execute()) {
                // Trả về true nếu cập nhật thành công
                return true;
            } else {
                // Trả về false nếu cập nhật thất bại
                return false;
            }
        } catch (PDOException $e) {
            // Xử lý ngoại lệ nếu có lỗi xảy ra
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
    
    
}