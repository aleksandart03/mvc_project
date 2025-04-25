<?php

require_once __DIR__ . '/../../config/db.php';

class CheckoutModel
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function createOrder($userId, $totalPrice)
    {
        $query = "INSERT INTO orders (user_id, total_price) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("id", $userId, $totalPrice);
        $stmt->execute();

        return $this->db->insert_id;
    }

    public function createOrderForGuest($guestName, $guestEmail, $totalPrice)
    {

        $query = "INSERT INTO orders (guest_name, guest_email, total_price, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssd", $guestName, $guestEmail, $totalPrice);

        $stmt->execute();

        return $this->db->insert_id;
    }

    public function addProductToOrder($orderId, $productId, $quantity, $price)
    {
        $query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iiii", $orderId, $productId, $quantity, $price);
        $stmt->execute();
    }
}
