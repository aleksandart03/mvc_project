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
}
