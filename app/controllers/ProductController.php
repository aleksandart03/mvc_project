<?php

require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../models/CategoryModel.php';
require_once __DIR__ . '/../../config/db.php';


class ProductController
{
    private $db;

    public function __construct()
    {

        $database = new Database();

        $this->db = $database->getConnection();
    }

    public function index()
    {

        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories();


        $sort = $_GET['sort'] ?? null;
        $search = $_GET['search'] ?? null;
        $category_id = $_GET['category_id'] ?? null;

        $productModel = new ProductModel();
        $products = $productModel->getProducts($category_id, $sort, $search);

        include __DIR__ . '/../views/product_list.php';
    }
}
