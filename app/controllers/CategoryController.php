<?php
class CategoryController {
    private $categoryModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    public function index() {
        if (!Auth::isAdmin()) {
            header('Location: /chieu2/account/login');
            exit;
        }
        // Hiển thị tất cả các danh mục
        $categories = $this->categoryModel->getAllCategories();
        include_once 'app/views/category/index.php';
    }

    public function create() {
        if (!Auth::isAdmin()) {
            header('Location: /chieu2/account/login');
            exit;
        }
        // Hiển thị form tạo mới danh mục
        include_once 'app/views/category/create.php';
    }

    public function store() {
        // Xử lý dữ liệu từ form tạo mới và lưu vào cơ sở dữ liệu
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
            $name = $_POST['name'];
            $result = $this->categoryModel->addCategory($name);
            if ($result === true) {
                // Chuyển hướng về trang danh sách danh mục sau khi lưu thành công
                header("Location: index");
            } else {
                // Xử lý lỗi nếu có
                $errors = $result;
                include_once 'app/views/category/create.php';
            }
        }
    }

    public function edit($id) {
        if (!Auth::isAdmin()) {
            header('Location: /chieu2/account/login');
            exit;
        }
        // Hiển thị form chỉnh sửa danh mục
        $category = $this->categoryModel->getCategoryById($id);
        if ($category) {
            include_once 'app/views/category/edit.php';
        } else {
            // Xử lý khi không tìm thấy danh mục
            include_once 'app/views/share/not-found.php';
        }
    }

    public function update() {
        // Xử lý dữ liệu từ form chỉnh sửa và cập nhật vào cơ sở dữ liệu
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'], $_POST['name'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $result = $this->categoryModel->updateCategory($id, $name);
            if ($result === true) {
                // Chuyển hướng về trang danh sách danh mục sau khi cập nhật thành công
                header("Location: index");
            } else {
                // Xử lý lỗi nếu có
                $errors = $result;
                $category = $this->categoryModel->getCategoryById($id);
                include_once 'app/views/category/edit.php';
            }
        }
    }

    public function delete() {
        if (!Auth::isAdmin()) {
            header('Location: /chieu2/account/login');
            exit;
        }
        // Xóa danh mục
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
            $id = $_POST["id"];
            $result = $this->categoryModel->deleteCategory($id);
            if ($result) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
    }
}
?>
