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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <?php include 'tempnav.php'; ?>
    <div class="mainContainer">
        <div id="invoiceContainer" class="invoiceContainerHide">
            <h2>Salea by invoce</h2>

            <table>

                <thead>
                    <tr>
                        <th>Invoice ID</th>
                        <th>Date</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>user_id</th>
                        <th>Payment Method</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php

                    if ($_SESSION["id"] != "") {
                        getAllinvoces($conn);
                    }

                    ?>
                </tbody>
            </table>



        </div>
        <?php include 'mobileNav.html'; ?>

    </div>
</body>
<script>
    console.log("hello");

    function updateStatus(status, invoiceId) {
        console.log(status, invoiceId);
        // Send an AJAX request to update the status in the database
        $.ajax({
            url: 'updateInvoiceStatus.php',
            method: 'POST',
            data: {
                status: status,
                invoice_id: invoiceId
            },
            success: function(response) {
                console.log('Status updated successfully');
            },
            error: function(xhr, status, error) {
                console.error('Error updating status:', error);
            }
        });
    }
</script>

</html>