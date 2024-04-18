<?php
class HomeController {
    private $db;
    private $productModel;

    function __construct(){
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }
    function index() {
        $products = $this->productModel->readAll();
        include_once 'app/views/home/index.php';
    }
}