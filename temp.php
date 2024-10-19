<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Button Event Listener</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <button id="add-to-cart" data-product-id="12354">Add to Cart</button>

</body>
<script src="postScript.js"></script>

</html>
<?php

require_once 'add_to_cart.php';
print_r($_SESSION['cart']);