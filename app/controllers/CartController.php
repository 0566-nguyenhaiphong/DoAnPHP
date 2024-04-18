<?php
class CartController
{

    private $productModel;
    private $accountModel;

    private $cartModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
        $this->cartModel = new CartModel($this->db);
        $this->accountModel = new AccountModel($this->db);

    }


    public function updateQuality($id)
    {
        $newQuantity = $_POST['quality'];
        foreach ($_SESSION['cart'] as &$item) {
            if ($item->id == $id) {
                $item->quantity = $newQuantity;

                break;
            }
        }
        $total = $this->calculateTotal(); // Tính toán lại tổng tiền
        $_SESSION['total'] = $total; // Lưu tổng tiền vào session
        header('Location: /chieu2/cart/show');
    }

    public function Add($id)
    {
        // Khởi tạo một phiên cart nếu chưa tồn tại
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Lấy sản phẩm từ ProductModel bằng $id
        $product = $this->productModel->getProductById($id);

        // Nếu sản phẩm tồn tại, thêm vào giỏ hàng
        if ($product) {
            // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
            $productExist = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item->id == $id) {
                    $item->quantity++;
                    $productExist = true;
                    break;
                }
            }

            // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm mới vào
            if (!$productExist) {
                $product->quantity = 1;
                $_SESSION['cart'][] = $product;
            }
            header('Location: /chieu2/cart/show');
           
        } else {
            echo "Không tìm thấy sản phẩm với ID này!";
        }
    }
    public function removeItem($id)
    {
    // Check if the cart session exists
    if (isset($_SESSION['cart'])) {
        // Loop through the cart items
        foreach ($_SESSION['cart'] as $key => $item) {
            // If the item ID matches the provided ID, remove it from the cart
            if ($item->id == $id) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
    }
    // Redirect back to the cart page after removing the item
    header('Location: /chieu2/cart/show');
    }
    public function calculateTotal()
{
    $total = 0;
    // Check if the cart session exists
    if (isset($_SESSION['cart'])) {
        // Loop through the cart items
        foreach ($_SESSION['cart'] as $item) {
            // Calculate the total for each item and add it to the total
            $total += $item->quantity * $item->price; // Assuming there's a 'price' property for each item
        }
    }
    return $total;

}
public function checkout()
    {
        $user = $this->accountModel->getAccountByUsername($_SESSION['username']);
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_SESSION['cart'])) {
                // Lấy thông tin giao hàng từ form
                $customer_name = $_POST["name"];
                $phone = $_POST["phone"];
                $email = $_POST["email"];
                $address = $_POST["address"];
                $payment_method = $_POST["payment-method"];
                $total_amount = $this->cartModel->calculateTotal();

                try {
                    // Bắt đầu transaction
                    $this->cartModel->beginTransaction();

                    // Insert thông tin giao hàng vào bảng orders
                    $orderId = $this->cartModel->createOrder($customer_name, $phone, $email, $address, $payment_method, $total_amount);

                    // Insert các sản phẩm trong giỏ hàng vào bảng order_detail
                    foreach ($_SESSION['cart'] as $item) {
                        $productId = $item->id;
                        $quantity = $item->quantity;
                        $price = $item->price;
                        $userId = $user->id;
                        // Insert thông tin sản phẩm vào bảng order_detail
                        $this->cartModel->addProductToOrder($orderId, $productId, $userId, $quantity, $price);
                    }

                    // Commit transaction
                    $this->cartModel->commit();

                    // Xóa session cart sau khi thanh toán
                    unset($_SESSION['cart']);

                    // Chuyển hướng đến trang xác nhận đơn hàng
                    header('Location: /chieu2/cart/confirmation');
                    exit();
                } catch (PDOException $e) {
                    // Nếu có lỗi xảy ra, rollback transaction và hiển thị thông báo lỗi
                    $this->cartModel->rollBack();
                    echo "Có lỗi xảy ra khi xử lý đơn hàng: " . $e->getMessage();
                }
            } else {
                // Nếu giỏ hàng rỗng, chuyển hướng quay lại trang giỏ hàng
                header('Location: /chieu2/cart');
                exit();
            }
        } else {
            // Nếu form chưa được gửi đi, chuyển hướng về trang thanh toán
            header('Location: /chieu2/cart/checkOutForm');
            exit();
        }
    }



public function confirmation()
{
    // Display a confirmation message or page
    include_once 'app/views/cart/confirmation.php';
}




    function show()
    {
        include_once 'app/views/cart/cartView.php';
    }
    function checkOutForm()
    {
        if (!Auth::isLoggedIn()) {
            header('Location: /chieu2/account/login');
            exit;
        }
        include_once 'app/views/cart/checkout.php';
    }
    public function orderList()
    {
        if (!Auth::isAdmin()) {
            header('Location: /chieu2/account/login');
            exit;
        }

        $orders = $this->cartModel->getAllOrders();
        include_once 'app/views/cart/orderList.php';
    }
    public function orderDetail($orderId)
    {
        if (!Auth::isAdmin()) {
            header('Location: /chieu2/account/login');
            exit; // Stop further execution
        }
        // Kiểm tra xem orderId có tồn tại không
        if (!$orderId) {
            echo "ID đơn hàng không hợp lệ";
            return;
        }
    
        // Truy vấn vào cơ sở dữ liệu để lấy thông tin của đơn hàng
        $stmt_order = $this->db->prepare("SELECT * FROM orders_table WHERE id = ?");
        $stmt_order->execute([$orderId]);
        $order = $stmt_order->fetch(PDO::FETCH_ASSOC);
    
        // Kiểm tra nếu không tìm thấy đơn hàng
        if (!$order) {
            echo "Không tìm thấy đơn hàng";
            return;
        }
    
        // Truy vấn vào cơ sở dữ liệu để lấy chi tiết sản phẩm trong đơn hàng
        $stmt_order_detail = $this->db->prepare("SELECT od.*, p.name AS product_name FROM order_detail od JOIN products p ON od.product_id = p.id WHERE order_id = ?");
    
        $stmt_order_detail->execute([$orderId]);
        $orderDetails = $stmt_order_detail->fetchAll(PDO::FETCH_ASSOC);
    
        $totalAmount = 0;
        foreach ($orderDetails as $detail) {
            $totalAmount += $detail['quantity'] * $detail['price'];
        }
    
        // Update cột 'total' trong bảng 'order_detail' với giá trị mới
        foreach ($orderDetails as $detail) {
            $stmt_update_total = $this->db->prepare("UPDATE order_detail SET total = ? WHERE id = ?");
            $stmt_update_total->execute([$detail['quantity'] * $detail['price'], $detail['id']]);
        }
    
        // Hiển thị view để hiển thị chi tiết đơn hàng
        include_once 'app/views/cart/orderDetail.php';
    }
    public function userOrders()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::isLoggedIn()) {
            // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
            header('Location: /chieu2/account/login');
            exit;
        }
        $user = $this->accountModel->getAccountByUsername($_SESSION['username']);

    
        // Lấy ID của người dùng hiện đang đăng nhập
        $userId = $user->id; // Đây là một phương thức giả định để lấy ID của người dùng
    
        // Lấy danh sách đơn hàng của người dùng từ model
        $userOrders = $this->cartModel->getUserOrders($userId);
    
        // Nếu không có đơn hàng nào, hiển thị thông báo
        if (empty($userOrders)) {
            echo "Không có đơn hàng nào!";
            return;
        }
    
        // Hiển thị danh sách đơn hàng của người dùng
        include_once 'app/views/cart/userOrders.php';
    }
    

    public function updateStatus($orderId)
        {
            if (!Auth::isAdmin()) {
                header('Location: /chieu2/account/login');
                exit;
            }

            $newStatus = $_POST['status'];

            $this->cartModel->updateOrderStatus($orderId, $newStatus);

            header('Location: /chieu2/cart/orderList');
            exit;
        }
        public function orderDetailUser($orderId)
        {
            if (!Auth::isLoggedIn()) {
                header('Location: /chieu2/account/login');
                exit; // Stop further execution
            }
            // Kiểm tra xem orderId có tồn tại không
            if (!$orderId) {
                echo "ID đơn hàng không hợp lệ";
                return;
            }
        
            // Truy vấn vào cơ sở dữ liệu để lấy thông tin của đơn hàng
            $stmt_order = $this->db->prepare("SELECT * FROM orders_table WHERE id = ?");
            $stmt_order->execute([$orderId]);
            $order = $stmt_order->fetch(PDO::FETCH_ASSOC);
        
            // Kiểm tra nếu không tìm thấy đơn hàng
            if (!$order) {
                echo "Không tìm thấy đơn hàng";
                return;
            }
        
            // Truy vấn vào cơ sở dữ liệu để lấy chi tiết sản phẩm trong đơn hàng
            $stmt_order_detail = $this->db->prepare("SELECT od.*, p.name AS product_name FROM order_detail od JOIN products p ON od.product_id = p.id WHERE order_id = ?");
        
            $stmt_order_detail->execute([$orderId]);
            $orderDetails = $stmt_order_detail->fetchAll(PDO::FETCH_ASSOC);
        
            $totalAmount = 0;
            foreach ($orderDetails as $detail) {
                $totalAmount += $detail['quantity'] * $detail['price'];
            }
        
            // Update cột 'total' trong bảng 'order_detail' với giá trị mới
            foreach ($orderDetails as $detail) {
                $stmt_update_total = $this->db->prepare("UPDATE order_detail SET total = ? WHERE id = ?");
                $stmt_update_total->execute([$detail['quantity'] * $detail['price'], $detail['id']]);
            }
        
            // Hiển thị view để hiển thị chi tiết đơn hàng
            include_once 'app/views/cart/orderDetailUser.php';
        }
    }
   
