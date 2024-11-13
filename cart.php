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

        <?php include 'tempnav.php'; ?>
        <?php include 'mobileNav.php'; ?>

        <form action="userUpdate.php" method="POST">
            <button name=crearCart class="clearCart"></i><i class="fa-solid fa-xmark"></i>Clear Cart</button>
        </form>


        <form action="userUpdate.php" method="POST" class="cardForm">
            <table>
                <tbody>

                    <?php

                    getCartItems($conn)
                    ?>
                    <tr>
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
                        <label for="paymentMethod">Cash On Delivery 💵</label>
                        <input type="radio" name="paymentMethod" id="" value="cod" checked="checked" onclick="showPaymentForm()">
                    </div>
                    <div class="radioBtnContainer">
                        <label for="paymentMethod">Visa/ Master 💳</label>
                        <input type="radio" name="paymentMethod" id="" value="visa/ master" onclick="showPaymentForm()">
                    </div>
                </div>
                <div id="cardBtncod">
                    <div class="checkoutBtn" id="checkoutBtn">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <p> C h e c k _O u t</p>
                        <input class="iSubmit" type='submit' name='submitInvoice' id='' value="submitInvoice">
                    </div>
                </div>

            </div>



            <div class="card-form" id="cardForm" style="display: none;">
                <div class="form-group">
                    <label for="cardNumber" >Card Number:</label>
                    <input type="text" name="cardNumber" id="cardNumber" maxlength="16" minlength="16" pattern="[0-9]{16}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="xxxx xxxx xxxx xxxx">
                </div>
                <div class="form-group">
                    <label for="cardName">Cardholder Name:</label>
                    <input type="text" name="cardName" id="cardName" minlength="5" placeholder="John Doe">
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="expiryDate">Expiry Date:</label>
                        <input type="text" name="expiryDate" id="expiryDate" placeholder="MM/YY" maxlength="5" pattern="(0[1-9]|1[0-2])\/([0-9]{2})">
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV:</label>
                        <input type="text" name="cvv" id="cvv" maxlength="3" minlength="3" pattern="[0-9]{3}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="123">
                    </div>
                    <div id="cardBtn">
                        <div class="checkoutBtn" id="checkoutBtn">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <p> C h e c k _O u t</p>
                            <input class="iSubmit" type='submit' name='submitInvoice' id=''>
                        </div>

                    </div>
                </div>
        </form>



    </div>


    </div>
    <?php include 'footer.php'; ?>

</body>
<script src="./src/js/cart.js"></script>


</html>