<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        img {
            max-width: 50px;
            height: auto;
        }
    </style>
</head>

<body>
    <?php include('tempnav.php'); ?>
    <?php
    require_once 'dataBase.php';
    print_r($_SESSION);
    ?>
    <form action="" method="POST">
        <button name=crearCart>Clear Cart</button>
    </form>
    <div>
        <form action="" method="POST">
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    require_once 'functions.php';
                    getCartItems($conn)
                    ?>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Grand Total</th>
                        <th>
                            <div class="cartTotal" id="cartTotal">Rs.</div>
                        </th>
                    </tr>

                </tbody>
            </table>

            <input type='submit' name='submitInvoice' id='' value="submitInvoice">
        </form>
    </div>

</body>
<script src="cart.js"></script>

</html>

<?php
require_once 'dataBase.php';
require_once 'functions.php';

if (isset($_POST['crearCart'])) {
    clearCart();
}
if (isset($_POST['removeFromCart'])) {
    $productId = $_POST['removeItemId'];
    removeFromCart($productId);
}
if (isset($_POST['submitInvoice'])) {
    print_r($_POST);
    for ($i = 0; $i < count($_SESSION["cart"]); $i++) {


        $invoiceId = $_SESSION['bill_count'];
        $userId = $_SESSION['id'];
        $productId = $_POST['itemId' . $i];
        $quantity = $_POST['quantity' . $i];
        $price = $_POST['price' . $i];
        $total = $quantity * $price;
        echo $userId;

        $insertQuery = "INSERT INTO `invoices`( `user_id`, `user_Invoice_id`,`product_id`, `price`, `quantity`, `total`) 
        VALUES ('$userId','$invoiceId','$productId','$price','$quantity','$total')";

        if ($conn->query($insertQuery)) {
            echo "completed";
        } else {
            echo "failed";
        }
    }
    $SetNewBillCount = $_SESSION['bill_count'] + 1;
    $_SESSION['bill_count'] = $SetNewBillCount;
    $setUserBillCountQuery =
        "UPDATE `users` 
            SET `bill_count` = '$SetNewBillCount' 
            WHERE `users`.`id` = $userId;";

    if ($conn->query($setUserBillCountQuery)) {
        echo "completed";
    } else {
        echo "failed";
    }

    echo "zzz";
}
