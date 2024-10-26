<?php
require_once 'dataBase.php';
require_once 'functions.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])){
    $productId = $_POST['product_id'];

    // Add product to cart logic here
    addToCart($productId);
    print_r($_POST);


    echo "Product added to cart successfully!";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['blog_id'])){
    $blog_id = $_POST['blog_id'];
    $action = $_POST['action'];

    if ($action == 'like') {
        $sql = "UPDATE blogs SET likes = likes + 1 WHERE blog_id = $blog_id;";
        
    } else {
        $sql = "UPDATE blogs SET likes = likes - 1 WHERE blog_id = $blog_id;";
        
    }
    if($conn->query($sql)){
        echo "completed";
    }else{
        echo "failed";
    }



}
echo "listning";
