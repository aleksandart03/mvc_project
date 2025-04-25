<?php

require_once __DIR__ . '/../models/CheckoutModel.php';
require_once __DIR__ . '/../models/CartModel.php';
require_once __DIR__ . '/../models/ProductModel.php';

class CheckoutController
{
    private $checkoutModel;
    private $cartModel;
    private $productModel;

    public function __construct()
    {
        $this->checkoutModel = new CheckoutModel();
        $this->cartModel = new CartModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            $cart = $this->cartModel->getCartByUserId($_SESSION['user_id']);
            $products = $cart ? $this->cartModel->getProductsInCart($cart['id']) : [];
        } else {
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

        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += $product['price'] * $product['quantity'];
        }

        include __DIR__ . '/../views/checkout_view.php';
    }

    public function processCheckout()
    {
        $products = [];
        $totalPrice = 0;

        if (isset($_SESSION['user_id'])) {

            $cart = $this->cartModel->getCartByUserId($_SESSION['user_id']);
            if ($cart) {
                $products = $this->cartModel->getProductsInCart($cart['id']);

                foreach ($products as $product) {
                    $totalPrice += $product['price'] * $product['quantity'];
                }


                $orderId = $this->checkoutModel->createOrder($_SESSION['user_id'], $totalPrice);

                foreach ($products as $product) {
                    $this->checkoutModel->addProductToOrder($orderId, $product['id'], $product['quantity'], $product['price']);
                }

                $this->cartModel->clearCart($cart['id']);

                header("Location: order_confirmation.php?order_id=" . $orderId);
                exit();
            }
        } else {
            if (isset($_POST['guest_name'], $_POST['guest_email']) && isset($_SESSION['cart'])) {
                $guestName = $_POST['guest_name'];
                $guestEmail = $_POST['guest_email'];

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

                foreach ($products as $product) {
                    $totalPrice += $product['price'] * $product['quantity'];
                }

                $orderId = $this->checkoutModel->createOrderForGuest($guestName, $guestEmail, $totalPrice);

                foreach ($products as $product) {
                    $this->checkoutModel->addProductToOrder($orderId, $product['id'], $product['quantity'], $product['price']);
                }

                unset($_SESSION['cart']);

                header("Location: order_confirmation.php?order_id=" . $orderId);
                exit();
            }
        }
    }
}
