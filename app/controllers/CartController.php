<?php

require_once __DIR__ . '/../models/CartModel.php';
require_once __DIR__ . '/../models/ProductModel.php';

class CartController
{
    private $cartModel;
    private $productModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            $cart = $this->cartModel->getCartByUserId($_SESSION['user_id']);
            $products = $cart ? $this->cartModel->getProductsInCart($cart['id']) : [];
        } else {
            $cart = null;
            $products = [];

            if (isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $productId => $quantity) {
                    $product = $this->productModel->getProductById($productId);
                    if ($product) {
                        $products[] = [
                            'id' => $product->id,
                            'name' => $product->name,
                            'price' => $product->price,
                            'quantity' => $quantity
                        ];
                    }
                }
            }
        }

        include __DIR__ . '/../views/cart_view.php';
    }

    public function increaseQuantity()
    {
        $productId = $_POST['product_id'] ?? null;
        if (!$productId) return;

        if (isset($_SESSION['user_id'])) {
            $cart = $this->cartModel->getCartByUserId($_SESSION['user_id']);
            $this->cartModel->increaseQuantity($cart['id'], $productId);
        } else {
            $_SESSION['cart'][$productId] = ($_SESSION['cart'][$productId] ?? 0) + 1;
        }
        header("Location: cart.php");
        exit();
    }

    public function decreaseQuantity()
    {
        $productId = $_POST['product_id'] ?? null;
        if (!$productId) return;

        if (isset($_SESSION['user_id'])) {
            $cart = $this->cartModel->getCartByUserId($_SESSION['user_id']);
            $this->cartModel->decreaseQuantity($cart['id'], $productId);
        } else {
            if (isset($_SESSION['cart'][$productId]) && $_SESSION['cart'][$productId] > 1) {
                $_SESSION['cart'][$productId]--;
            } else {
                unset($_SESSION['cart'][$productId]);
            }
        }
        header("Location: cart.php");
        exit();
    }

    public function removeProduct()
    {
        $productId = $_GET['id'] ?? null;
        if (!$productId) return;

        if (isset($_SESSION['user_id'])) {
            $cart = $this->cartModel->getCartByUserId($_SESSION['user_id']);
            $this->cartModel->removeProductFromCart($cart['id'], $productId);
        } else {
            unset($_SESSION['cart'][$productId]);
        }
        header("Location: cart.php");
        exit();
    }

    public function clearCart()
    {
        if (isset($_SESSION['user_id'])) {
            $cart = $this->cartModel->getCartByUserId($_SESSION['user_id']);
            $this->cartModel->clearCart($cart['id']);
        } else {
            unset($_SESSION['cart']);
        }
        header("Location: cart.php");
        exit();
    }
}
