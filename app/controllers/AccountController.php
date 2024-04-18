<?php

class AccountController{

    private $db;
    private $accountModel;

    function __construct(){
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
    }

    function login(){
        include_once 'app/views/account/login.php';
    }

    function register(){
        include_once 'app/views/account/register.php';
    }

    function save(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $fullName = $_POST['fullname'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';

            $errors =[];
            if(empty($username)){
                $errors['username'] = "Vui long nhap userName!";
            }
            if(empty($fullName)){
                $errors['fullname'] = "Vui long nhap fullName!";
            }
            if(empty($password)){
                $errors['password'] = "Vui long nhap password!";
            }
            if($password != $confirmPassword){
                $errors['confirmPass'] = "Mat khau va xac nhan chua dung";
            }
            //kiểm tra username đã được đăng ký chưa?
            $account = $this->accountModel->getAccountByUsername($username);

            if($account){
                $errors['account'] = "Tai khoan nay da co nguoi dang ky!";
            }
            
            if(count($errors) > 0){
                include_once 'app/views/account/register.php';
            }else{
                $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                
                $result = $this->accountModel->save($username, $fullName, $password);
                
                if($result){
                    header('Location: /chieu2/account/login');
                }
            }
        }       
       
    }
    function checkLogin(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $errors =[];
            if(empty($username)){
                $errors['username'] = "Vui long nhap userName!";
            }
            if(empty($password)){
                $errors['password'] = "Vui long nhap password!";
            }
            if(count($errors) > 0){
                include_once 'app/views/account/login.php';
            }
            $account = $this->accountModel->getAccountByUsername($username);
            
            if($account && password_verify($password, $account->password)){
                //dang nhap thanh cong
                //luu trang thai dang nhap
                $_SESSION['username'] = $account->email;
                $_SESSION['role'] = $account->role;

                if($account->locked == 1){

                    $errors['locked'] = "Tai khoan cua ban dang bi khoa!";
                    include_once 'app/views/account/login.php';
                }
                if($account->role == "admin"){
                    header('Location: /chieu2');
                }
                else{
                    header('Location: /chieu2/home');
                }
            }else{
                $errors['account'] = "Dang nhap that bai!";
                include_once 'app/views/account/login.php';
            }
        }
    }

    function logout(){
        
        unset($_SESSION['username']);
        unset($_SESSION['role']);

        header('Location: /chieu2');
    }
    function index() {
        if ($_SESSION['role'] !== 'admin') {
            header('Location: /chieu2'); 
            exit;
        }

        $users = $this->accountModel->getAllUsers();

        include_once 'app/views/account/index.php';
    }
   
    function deleteUser($id) {
      
        if ($_SESSION['role'] !== 'admin') {
            header('Location: /chieu2'); 
            exit;
        }

        // Xóa người dùng từ cơ sở dữ liệu
        $result = $this->accountModel->deleteUser($id);

        // Chuyển hướng người dùng sau khi xóa
        header('Location: /chieu2/account/index');
    }
    function lockUser($id) {
        if ($_SESSION['role'] !== 'admin') {
            header('Location: /chieu2'); 
            exit;
        }
    
        $result = $this->accountModel->lockUser($id);
    
        // Chuyển hướng người dùng sau khi khóa
        header('Location: /chieu2/account/index');
    }
    function viewProfile() {
        // Kiểm tra đăng nhập
        if (!Auth::isLoggedIn()) {
            // Chuyển hướng người dùng đến trang đăng nhập nếu chưa đăng nhập
            header('Location: /chieu2/account/login');
            exit;
        }
    
        // Truy xuất thông tin người dùng từ cơ sở dữ liệu
        $user = $this->accountModel->getAccountByUsername($_SESSION['username']);
    
        // Kiểm tra và gán giá trị mặc định nếu không có số điện thoại và địa chỉ
        $phone = ($user->phone != 0) ? $user->phone : 'Chưa có';
        $address = ($user->address != null) ? $user->address : 'Chưa có';
    
        // include trang profile và truyền dữ liệu người dùng
        include_once 'app/views/account/profile.php';
    }
    
    
    
    function editProfile() {
        // Kiểm tra đăng nhập
        if (!Auth::isLoggedIn()) {
            // Chuyển hướng người dùng đến trang đăng nhập nếu chưa đăng nhập
            header('Location: /chieu2/account/login');
            exit;
        }
    
        // Lấy thông tin người dùng từ model
        $user = $this->accountModel->getAccountByUsername($_SESSION['username']);
    
        // Bao gồm trang editProfile.php và truyền biến $user
        include_once 'app/views/account/editProfile.php';
    }
    
    function updateProfile() {
        // Kiểm tra đăng nhập
        if (!Auth::isLoggedIn()) {
            // Chuyển hướng người dùng đến trang đăng nhập nếu chưa đăng nhập
            header('Location: /chieu2/account/login');
            exit;
        }
    
        // Kiểm tra nếu yêu cầu là POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy thông tin từ biểu mẫu
            $fullname = $_POST['fullname'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';
    
            // Kiểm tra và xử lý dữ liệu đầu vào
            if (empty($fullname) || empty($email) || empty($phone) || empty($address)) {
                // Nếu thiếu thông tin, gán thông báo lỗi
                $error_message = "Vui lòng điền đầy đủ thông tin.";
            } else {
                // Nếu thông tin hợp lệ, thực hiện cập nhật
                $result = $this->accountModel->updateProfile($email, $fullname, $phone, $address);
    
                if ($result) {
                    header('Location: /chieu2/account/viewProfile');
                    exit;
                } else {
                    // Nếu cập nhật không thành công, gán thông báo lỗi
                    $error_message = "Có lỗi xảy ra trong quá trình cập nhật thông tin cá nhân.";
                }
            }
        } else {
            // Nếu không phải là yêu cầu POST, gán thông báo lỗi
            $error_message = "Yêu cầu không hợp lệ.";
        }
    
        // Lấy thông tin người dùng từ model
        $user = $this->accountModel->getAccountByUsername($_SESSION['username']);
        include_once 'app/views/account/editProfile.php';
    }
    

}