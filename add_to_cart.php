<?php
require_once 'dataBase.php';
require_once 'functions.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['product_id'];

    // Add product to cart logic here
    addToCart($productId);
    print_r($_POST);


    echo "Product added to cart successfully!";
}
echo "listning", "<br>";
