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
    ?>
    <form action="userUpdate.php" method="POST">
        <button name=crearCart>Clear Cart</button>
    </form>
    <div>
        <form action="userUpdate.php" method="POST">
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
<script src="./src/js/cart.js"></script>

</html>

<?php
require_once 'dataBase.php';
