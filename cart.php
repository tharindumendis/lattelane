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
            <label for="paymentMethod">COD</label>
            <input type="radio" name="paymentMethod" id="" value="cod" checked="checked" onclick="cardFormhide()">
            <label for="paymentMethod">visa/ master</label>
            <input type="radio" name="paymentMethod" id="" value="visa/ master" onclick="cardFormShow()">
        </form>
        <div class="card-form" id="cardForm" style="display: none;">
            
                <div class="form-group">
                    <label for="cardNumber">Card Number:</label>
                    <input type="text" name="cardNumber" id="cardNumber" maxlength="16">
                </div>
                <div class="form-group">
                    <label for="cardName">Cardholder Name:</label>
                    <input type="text" name="cardName" id="cardName">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="expiryDate">Expiry Date:</label>
                        <input type="text" name="expiryDate" id="expiryDate" placeholder="MM/YY" maxlength="5">
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV:</label>
                        <input type="text" name="cvv" id="cvv" maxlength="3">
                    </div>
                </div>
                
            
        </div>
    </div>
    <div>


    </div>

</body>
<script src="./src/js/cart.js"></script>

</html>

<?php
require_once 'dataBase.php';
