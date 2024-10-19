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
    <div>
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
                <tr>
                    <td><img src="product1.jpg" alt="Product 1" width="50"></td>
                    <td>Product 1</td>
                    <td>$10.00</td>
                    <td>2</td>
                    <td>$20.00</td>
                </tr>
                <tr>
                    <td><img src='product1.jpg' width='50'></td>
                    <td>{$row['product_name']}</td>
                    <td>Rs.<input type='number' value='250' name='' id='price1'></td>
                    <td><input type='number' name='' id='cartQuantity1' value='1' min='1' max='20'></td>
                    <td>Rs.<input type='number' name='' id='total1'></td>
                    <script>
                        function calculateTotal() {
                            var quantity = parseInt(document.getElementById('cartQuantity1').value);
                            var price = document.getElementById('price1').value; // Replace with the actual price of the product
                            var total = quantity * price;
                            document.getElementById('total1').value = total.toFixed(2);
                        };
                        document.getElementById('cartQuantity1').addEventListener('input', calculateTotal);

                        calculateTotal()
                    </script>
                </tr>
                <tr>
                    <td><img src='product1.jpg' width='50'></td>
                    <td>{$row['product_name']}</td>
                    <td>Rs.<input type='number' value='130' name='' id='price'></td>
                    <td><input type='number' name='quantity' id='cartQuantity' value='1' min='1' max='20'></td>
                    <td>Rs.<input type='number' name='total' id='total'></td>
                    <script>
                        function calculateTota1() {
                            var quantity = parseInt(document.getElementById('cartQuantity').value);
                            var price = document.getElementById('price').value; // Replace with the actual price of the product
                            var total = quantity * price;
                            document.getElementById('total').value = total.toFixed(2);
                        };
                        document.getElementById('cartQuantity').addEventListener('input', calculateTotal);

                        calculateTotal()
                    </script>
                </tr>


                <?php
                getCartItems()
                ?>

            </tbody>
        </table>


    </div>

</body>

</html>

<?php
require_once 'dataBase.php';
require_once 'functions.php';


function  getCartItems()
{
    require_once 'dataBase.php';
    foreach ($_SESSION['cart'] as $item) {

        echo $item;
        $query = "SELECT * FROM `products` WHERE id = $item;";

        // FETCHING DATA FROM DATABASE 
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // OUTPUT DATA OF EACH ROW 
            while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                    <td><img src='product1.jpg' width='50'></td>
                    <td>{$row['product_name']}</td>
                    <td>Rs.<input type='number' value='{$row['price']}' name='' id='price{$row['id']}'></td>
                    <td><input type='number' name='' id='cartQuantity{$row['id']}' value='1' min='1' max='20'></td>
                    <td>Rs.<input type='number' name='' id='total{$row['id']}'></td>
                    <script>
                        function calculateTotal() {
                            var quantity = parseInt(document.getElementById('cartQuantity{$row['id']}').value);
                            var price = document.getElementById('price{$row['id']}').value; // Replace with the actual price of the product
                            var total = quantity * price;
                            document.getElementById('total{$row['id']}').value = total.toFixed(2);
                        };
                        document.getElementById('cartQuantity{$row['id']}').addEventListener('input', calculateTotal);

                        calculateTotal()
                    </script>
                </tr>
                    
                    ";
            }
        }
    };
}
