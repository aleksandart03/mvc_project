<?php

require_once '../config/db.php';
require_once '../app/models/Product.php';

class ProductModel
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getProducts($category_id = '', $sort = '', $search = '', $limit = 0, $offset = 0)
    {
        $query = "SELECT * FROM products WHERE 1";
        $params = [];
        $types = '';

        if ($category_id) {
            $query .= " AND category_id = ?";
            $params[] = $category_id;
            $types .= 'i';
        }

        if ($search) {
            $query .= " AND (name LIKE ? OR description LIKE ?)";
            $params[] = '%' . $search . '%';
            $params[] = '%' . $search . '%';
            $types .= 'ss';
        }

        switch ($sort) {
            case 'name_asc':
                $query .= " ORDER BY name ASC";
                break;
            case 'name_desc':
                $query .= " ORDER BY name DESC";
                break;
            case 'price_asc':
                $query .= " ORDER BY price ASC";
                break;
            case 'price_desc':
                $query .= " ORDER BY price DESC";
                break;
        }

        $query .= " LIMIT ? OFFSET ?";
        $params[] = $limit;
        $params[] = $offset;
        $types .= 'ii';

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();

        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $products = [];

        foreach ($results as $row) {
            $products[] = new Product($row['id'], $row['name'], $row['description'], $row['price'], $row['category_id'] ?? null);
        }

        return $products;
    }

    public function countProducts($category_id = '', $search = '')
    {
        $query = "SELECT COUNT(*) as total FROM products WHERE 1";
        $params = [];
        $types = '';

        if ($category_id) {
            $query .= " AND category_id = ?";
            $params[] = $category_id;
            $types .= 'i';
        }

        if ($search) {
            $query .= " AND (name LIKE ? OR description LIKE ?)";
            $params[] = '%' . $search . '%';
            $params[] = '%' . $search . '%';
            $types .= 'ss';
        }

        $stmt = $this->conn->prepare($query);
        if ($params) $stmt->bind_param($types, ...$params);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }


    public function addProduct($name, $price, $description)
    {
        $sql = "INSERT INTO products (name, price, description) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $name, $price, $description);
        $stmt->execute();
    }

    public function deleteProduct($id)
    {
        $sql = "DELETE FROM products WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function getProductById($id)
    {
        $sql = "SELECT * FROM products WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();

        if ($row) {
            return new Product(
                $row['id'],
                $row['name'],
                $row['description'],
                $row['price'],
                $row['category_id'] ?? null
            );
        }

        return null;
    }

    public function updateProduct($id, $name, $price, $description)
    {
        $sql = "UPDATE products SET name=?, price=?, description=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $name, $price, $description, $id);
        $stmt->execute();
    }

    public function getAllProducts()
    {
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);
        $products = [];

        while ($row = $result->fetch_assoc()) {
            $products[] = new Product(
                $row['id'],
                $row['name'],
                $row['description'],
                $row['price'],
                $row['category_id'] ?? null
            );
        }

        return $products;
    }
}
