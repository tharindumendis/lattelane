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
    <link rel="stylesheet" href="./src/Css/invoices.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <div class="mainContainer">
        <?php
        include 'tempnav.php';
        adminPanel();
        ?>
        <h2>Salea by invoce</h2>
        <div id="invoiceContainer" class="invoiceContainerHide">
            

            <table>

                <thead>
                    <tr>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Status</th>
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
        <?php include 'mobileNav.php'; ?>

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
<script src="./src/js/adminBtn.js"></script>

</html>