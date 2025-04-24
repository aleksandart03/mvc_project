<?php


require_once '../app/models/ProductModel.php';
require_once '../app/models/CategoryModel.php';

class AdminController
{
    public function __construct()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: /mvc_project/public/login_register.php");
            exit();
        }
    }
    public function index()
    {

        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories();

        $sort = $_GET['sort'] ?? null;
        $search = $_GET['search'] ?? null;
        $category_id = $_GET['category_id'] ?? null;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 12;
        $offset = ($page - 1) * $limit;

        $productModel = new ProductModel();
        $products = $productModel->getProducts($category_id, $sort, $search, $limit, $offset);
        $totalProducts = $productModel->countProducts($category_id, $search);
        $totalPages = ceil($totalProducts / $limit);

        require_once  '../app/views/adminView.php';
    }

    public function create()
    {
        require_once '../app/views/add.php';
    }


    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];

            $productModel = new ProductModel();
            $productModel->addProduct($name, $price, $description);

            header("Location: admin.php");
            exit();
        }
    }

    public function delete($id)
    {
        $productModel = new ProductModel();
        $productModel->deleteProduct($id);
        header("Location: admin.php");
        exit();
    }

    public function edit($id)
    {
        $productModel = new ProductModel();
        $product = $productModel->getProductById($id);
        require_once '../app/views/edit_product.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];

            $productModel = new ProductModel();
            $productModel->updateProduct($id, $name, $price, $description);

            header("Location: admin.php");
            exit();
        }
    }
}
