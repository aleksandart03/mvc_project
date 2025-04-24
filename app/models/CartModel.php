<?php

require_once __DIR__ . '/../../config/db.php';

class CartModel
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function createCart($userId)
    {
        $query = "INSERT INTO cart (user_id, created_at) VALUES (?, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        return $this->db->insert_id;
    }

    public function getCartByUserId($userId)
    {
        $query = "SELECT id FROM cart WHERE user_id = ? ORDER BY created_at DESC LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function addProductToCart($cartId, $productId, $quantity)
    {

        $query = "SELECT id FROM cart_product WHERE cart_id = ? AND product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $cartId, $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            $query = "UPDATE cart_product SET quantity = quantity + ? WHERE cart_id = ? AND product_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("iii", $quantity, $cartId, $productId);
            $stmt->execute();
        } else {
            $query = "INSERT INTO cart_product (cart_id, product_id, quantity) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("iii", $cartId, $productId, $quantity);
            $stmt->execute();
        }
    }

    public function getProductsInCart($cartId)
    {
        $query = "SELECT p.id, p.name, p.price, cp.quantity FROM products p
                  JOIN cart_product cp ON p.id = cp.product_id
                  WHERE cp.cart_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $cartId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function removeProductFromCart($cartId, $productId)
    {
        $query = "DELETE FROM cart_product WHERE cart_id = ? AND product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $cartId, $productId);
        $stmt->execute();
    }

    public function clearCart($cartId)
    {
        $query = "DELETE FROM cart_product WHERE cart_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $cartId);
        $stmt->execute();
    }

    public function increaseQuantity($cartId, $productId)
    {
        $query = "UPDATE cart_product SET quantity = quantity + 1 WHERE cart_id = ? AND product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $cartId, $productId);
        $stmt->execute();
    }

    public function decreaseQuantity($cartId, $productId)
    {
        $query = "SELECT quantity FROM cart_product WHERE cart_id = ? AND product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $cartId, $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && $row['quantity'] > 1) {
            $query = "UPDATE cart_product SET quantity = quantity - 1 WHERE cart_id = ? AND product_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ii", $cartId, $productId);
            $stmt->execute();
        } else {

            $this->removeProductFromCart($cartId, $productId);
        }
    }
}
