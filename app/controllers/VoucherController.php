<?php
class VoucherController {
    private $voucherModel;
    private $accountModel;

    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->voucherModel = new VoucherModel($this->db);
        $this->accountModel = new AccountModel($this->db);

    }

    public function index() {
        if (!Auth::isAdmin()) {
            header('Location: /chieu2/account/login');
            exit;
        }
        // Hiển thị tất cả các voucher
        $vouchers = $this->voucherModel->getAllVouchers();
        include_once 'app/views/voucher/index.php';
    }

    public function listVoucher() {
        if (!Auth::isLoggedIn()) {
            header('Location: /chieu2/account/login');
            exit;
        }
        // Hiển thị tất cả các voucher
        $vouchers = $this->voucherModel->getAllVouchers();
        include_once 'app/views/voucher/listvoucher.php';
    }
    public function saveVoucher() {
        if (!Auth::isLoggedIn()) {
            // Nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
            header('Location: /chieu2/account/login');
            exit;
        }
        $user = $this->accountModel->getAccountByUsername($_SESSION['username']);
        $userId = $user->id;
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            // Lấy ID của voucher từ request POST
            $voucherId = $_POST['id'];
    
            // Gọi phương thức trong model để lưu voucher cho người dùng hiện tại
            $result = $this->voucherModel->saveVoucherForUser($voucherId, $userId);
    
            // Kiểm tra kết quả trả về từ model
            if ($result === true) {
                // Nếu lưu voucher thành công, trả về thông báo thành công
                echo json_encode(['Success' => true]);
            } else {
                // Nếu có lỗi xảy ra, trả về thông báo lỗi
                echo json_encode(['Success' => false, 'Message' => 'Error saving voucher.']);
            }
        } else {
            // Nếu không phải là yêu cầu POST hoặc không có tham số id, trả về thông báo lỗi
            echo json_encode(['Success' => false, 'Message' => 'Invalid request.']);
        }
    }
    
    public function create() {
        if (!Auth::isAdmin()) {
            header('Location: /chieu2/account/login');
            exit;
        }
        // Hiển thị form tạo mới voucher
        include_once 'app/views/voucher/create.php';
    }

    public function store() {
        if (!Auth::isAdmin()) {
            header('Location: /chieu2/account/login');
            exit;
        }
        // Xử lý dữ liệu từ form tạo mới và lưu vào cơ sở dữ liệu
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'], $_POST['description'], $_POST['value'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $value = $_POST['value'];
            $result = $this->voucherModel->addVoucher($name, $description, $value);
            if ($result === true) {
                // Chuyển hướng về trang danh sách voucher sau khi lưu thành công
                header("Location: /chieu2/voucher/index");
            } else {
                // Xử lý lỗi nếu có
                $errors = $result;
                include_once 'app/views/voucher/create.php';
            }
        }
    }

    public function edit($id) {
        if (!Auth::isAdmin()) {
            header('Location: /chieu2/account/login');
            exit;
        }
        // Hiển thị form chỉnh sửa voucher
        $voucher = $this->voucherModel->getVoucherById($id);
        if ($voucher) {
            include_once 'app/views/voucher/edit.php';
        } else {
            // Xử lý khi không tìm thấy voucher
            echo "Voucher not found!";
        }
    }

    public function update() {
        if (!Auth::isAdmin()) {
            header('Location: /chieu2/account/login');
            exit;
        }
        // Xử lý dữ liệu từ form chỉnh sửa và cập nhật vào cơ sở dữ liệu
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'], $_POST['name'], $_POST['description'], $_POST['value'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $value = $_POST['value'];
            $result = $this->voucherModel->updateVoucher($id, $name, $description, $value);
            if ($result === true) {
                // Chuyển hướng về trang danh sách voucher sau khi cập nhật thành công
                header("Location: /chieu2/voucher/index");
            } else {
                // Xử lý lỗi nếu có
                $errors = $result;
                $voucher = $this->voucherModel->getVoucherById($id);
                include_once 'app/views/voucher/edit.php';
            }
        }
    }

    public function delete() {
        if (!Auth::isAdmin()) {
            header('Location: /chieu2/account/login');
            exit;
        }
        // Xóa voucher
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
            $id = $_POST["id"];
            $result = $this->voucherModel->deleteVoucher($id);
            if ($result) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
    }
}
?>
