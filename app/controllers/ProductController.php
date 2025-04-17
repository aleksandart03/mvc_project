<?php

require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../../config/db.php';


class ProductController
{
    public function index()
    {
        $conn = getConnect();

        $categories = Product::getCategories($conn);

        $sort = $_GET['sort'] ?? null;
        $search = $_GET['search'] ?? null;
        $category_id = $_GET['category_id'] ?? null;

        if ($search && !empty(trim($_GET['search']))) {
            $search = trim($_GET['search']);
            $products = Product::search($conn, $search);
        } elseif ($sort) {
            $products = Product::getSorted($conn, $sort);
        } elseif ($category_id) {
            $products = Product::getByCategory($conn, $category_id);
        } else {
            $products = Product::getAll($conn);
        }

        include __DIR__ . '/../views/product_list.php';
    }

    public function create()
    {
        include __DIR__ . '/../views/add.php';
    }

    public function store()
    {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        $conn = getConnect();
        Product::create($conn, $name, $description, $price);

        header('Location: /mvc_project/public/index.php');
        exit;
    }

    public function delete()
    {
        if (!isset($_GET['id'])) {
            die("Nedostaje ID proizvoda za brisanje.");
        }

        $id = intval($_GET['id']);
        $conn = getConnect();

        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();


        header("Location: /mvc_project/public/index.php");
        exit();
    }

    public function edit($id)
    {
        $product = Product::find($id);
        include __DIR__ . '/../views/edit_product.php';
    }

    public function update($data)
    {
        Product::update($data);
        header('Location: /mvc_project/public/index.php');
        exit;
    }
}
