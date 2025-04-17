<?php


class Product
{
    public $id;
    public $name;
    public $description;
    public $price;

    public function __construct($id, $name, $description, $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public static function getAll($conn)
    {
        $result = $conn->query("SELECT * FROM products");
        $products = [];

        while ($row = $result->fetch_assoc()) {
            $products[] = new Product(
                $row['id'],
                $row['name'],
                $row['description'],
                $row['price']
            );
        }

        return $products;
    }

    public static function create($conn, $name, $description, $price)
    {
        $stmt = $conn->prepare("INSERT INTO products (name, description, price) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $name, $description, $price);
        $stmt->execute();
        $stmt->close();
    }

    public static function find($id)
    {
        $conn = getConnect();
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $product = new Product($row['id'], $row['name'], $row['description'], $row['price']);
        return $product;
    }

    public static function update($data)
    {
        $conn = getConnect();
        $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ? WHERE id = ?");
        $stmt->bind_param("ssdi", $data['name'], $data['description'], $data['price'], $data['id']);
        $stmt->execute();
    }

    public static function search($conn, $search)
    {
        $escaped = mysqli_real_escape_string($conn, $search);
        $sql = "SELECT * FROM products WHERE name LIKE '%$escaped%' ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);

        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = (object)$row;
        }

        return $products;
    }

    public static function getSorted($conn, $sort)
    {
        $orderBy = "id DESC";

        switch ($sort) {
            case 'name_asc':
                $orderBy = "name ASC";
                break;
            case 'name_desc':
                $orderBy = "name DESC";
                break;
            case 'price_asc':
                $orderBy = "price ASC";
                break;
            case 'price_desc':
                $orderBy = "price DESC";
                break;
        }

        $sql = "SELECT * FROM products ORDER BY $orderBy";
        $result = mysqli_query($conn, $sql);

        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = (object)$row;
        }

        return $products;
    }

    public static function getCategories($conn)
    {
        $sql = "SELECT * FROM categories";
        $result = $conn->query($sql);

        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }

        return $categories;
    }

    public static function getByCategory($conn, $category_id)
    {
        $sql = "SELECT * FROM products WHERE category_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $product = new Product(
                $row['id'],
                $row['name'],
                $row['description'],
                $row['price']
            );
            $products[] = $product;
        }

        return $products;
    }
}
