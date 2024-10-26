<?php
require_once 'dataBase.php';
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./src/css/cart.css">
</head>

<body>
    <div class="mainContainer">

        <?php include('tempnav.php'); ?>
        <?php include 'mobileNav.html'; ?>

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
                <div class="checkoutBtnContainer">
                    <div class="paymentBtn">
                        <div class="radioBtnContainer">
                            <label for="paymentMethod">COD</label>
                            <input type="radio" name="paymentMethod" id="" value="cod" checked="checked" onclick="cardFormhide()">
                        </div>
                        <div class="radioBtnContainer">
                            <label for="paymentMethod">visa/ master</label>
                            <input type="radio" name="paymentMethod" id="" value="visa/ master" onclick="cardFormShow()">
                        </div>
                    </div>
                    <input type='submit' name='submitInvoice' id='' value="submitInvoice">

                </div>

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


    </div>

</body>
<script src="./src/js/cart.js"></script>

</html>