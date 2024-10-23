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
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .profilePic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 20px;
        }



        .profileContainer {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 200px;
            margin-left: 20px;
            width: 360px;
            border: solid 5px #0009;
            border-radius: 10px;
        }

        .profilePicContainer {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .profileContainer h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 20px;

        }

        .profileDetailsContainer {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 20px;
            border-top: solid 2px #0006;
        }

        .profileDetailsContainer p {
            display: flex;
            padding: 10px;
            margin-bottom: 3px;
            background-color: #00000011;
            border-radius: 10px;
        }

        .editInputs {
            display: flex;
            background: none;
            border: none;
            padding-left: 5px;
        }

        .editInputs:hover {
            background-color: #00000011;
            border-radius: 10px;
        }

        .editInputs:focus {
            background-color: #00000011;
            border-radius: 10px;
        }

        .editInputs:active {
            background-color: #00000011;
            border-radius: 10px;
        }

        .editInputs:visited {
            background-color: #00000011;
            border-radius: 10px;
        }

        .editInputs:target {
            background-color: #00000011;
            border-radius: 10px;
        }

        .editInputs:checked {
            background-color: #00000011;
            border-radius: 10px;
        }

        .editBtnContainer {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;

        }
    </style>
</head>

<body>
    <?php include 'tempnav.php'; ?>

    <div class="profileContainer">
        <h2>Profile Details</h2>
        <div lass="profilePicContainer">
            <img src="./uploads/samplepic.jpg" alt="" class="profilePic">
        </div>
        <div class="profileDetailsContainer">
            <form action="userUpdate.php" method="post">
                <p>First name: <input class="editInputs" type="text" name="first_name" id="" value="<?php echo $_SESSION['first_name'] ?>"></p>
                <p>Last name: <input class="editInputs" type="text" name="last_name" id="" value="<?php echo $_SESSION['last_name'] ?>"></p>
                <p>Email: <?php echo $_SESSION['email']; ?></p>
                <p>Phone: <input class="editInputs" type="text" name="phone" id="" value="<?php echo $_SESSION['phone']; ?>"></p>
                <p>Address no: <input class="editInputs" type="text" name="address_no" id="" value="<?php echo $_SESSION['address_no']; ?>"></p>
                <p>Street: <input class="editInputs" type="text" name="street" id="" value="<?php echo $_SESSION['street']; ?>"></p>
                <p>City: <input class="editInputs" type="text" name="city" id="" value="<?php echo $_SESSION['city']; ?>"></p>
                <div class="editBtnContainer"><button type="submit" id="editSubmit" name="update_profile" value="update_profile">Save Edits</button></div>
            </form>
        </div>
    </div>

    <div>

        <h2>Your Orders</h2>
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
                    <th>Payment Method</th>
                </tr>
            </thead>
            <tbody>
                <?php
                displayBills($conn);
                ?>
            </tbody>
        </table>


    </div>

</body>
<script>
</script>

</html>