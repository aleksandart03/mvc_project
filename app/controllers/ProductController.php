<?php

require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../models/CartModel.php';
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
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 12;
        $offset = ($page - 1) * $limit;

        $productModel = new ProductModel();
        $products = $productModel->getProducts($category_id, $sort, $search, $limit, $offset);
        $totalProducts = $productModel->countProducts($category_id, $search);
        $totalPages = ceil($totalProducts / $limit);

        include __DIR__ . '/../views/product_list.php';
    }
    public function addToCart()
    {
        if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
            $productId = (int) $_POST['product_id'];
            $quantity = (int) $_POST['quantity'];

            if (isset($_SESSION['user_id'])) {

                $cartModel = new CartModel();
                $cart = $cartModel->getCartByUserId($_SESSION['user_id']);

                if (!$cart) {

                    $cartId = $cartModel->createCart($_SESSION['user_id']);
                } else {
                    $cartId = $cart['id'];
                }

                $cartModel->addProductToCart($cartId, $productId, $quantity);
            } else {
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }
                if (isset($_SESSION['cart'][$productId])) {
                    $_SESSION['cart'][$productId] += $quantity;
                } else {
                    $_SESSION['cart'][$productId] = $quantity;
                }
            }
        }

        header("Location: /mvc_project/public/index.php");
        exit();
    }
}
