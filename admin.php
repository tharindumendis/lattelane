<?php require_once 'dataBase.php';
require_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="src/css/admin.css">
</head>

<body>
    <div class="mainContainer">
        <?php include 'tempnav.php';
        include 'mobileNav.html';
        ?>

        <div class="adminPanelContainer">
            <div class="adminPanel">
                <div class="btnSet">
                    <button class="panelBtn" onclick="window.location.href='dashBoard.php';"><i class="fa-solid fa-chart-line"></i></button>
                    <label class="panelLabel">DashBoard</label>
                </div>
                <div class="btnSet">
                    <button class="panelBtn" onclick="window.location.href='dashBoard.php';"><i class="fa-regular fa-file-lines"></i></button>
                    <label class="panelLabel">Invoices</label>
                </div>
                <div class="btnSet">
                    <button class="panelBtn" onclick="window.location.href='productUpdate.php';"><i class="fa-solid fa-box"></i></button>
                    <label class="panelLabel">Products</label>
                </div>
                <div class="btnSet">
                    <button class="panelBtn" onclick="window.location.href='addProductForm.php';"><i class="fa-solid fa-square-plus"></i></button>
                    <label class="panelLabel">Add Product</label>
                </div>
                <div class="btnSet">
                    <button class="panelBtn" onclick="window.location.href='usersData.php';"><i class="fa-solid fa-users"></i></button>
                    <label class="panelLabel">Users</label>
                </div>
                <div class="btnSet">
                    <button class="panelBtn" onclick="window.location.href='addProductForm.php';"><i class="fa-solid fa-table"></i></button>
                    <label class="panelLabel">Add Category</label>
                </div>







            </div>

        </div>

    </div>

</body>

</html>