<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="src/req.css">
</head>

<body>
    <div class="topnav">
        <a href="addProductForm.php">add products</a>
        <a href="addProductForm.php">add products</a>
    </div>
    <div class="productCardContainer" id="productCardContainer">
        <div class="productcard">
            <div class="productcardimg">
                <img src="uploads/samplepic.jpg" alt="" class="productimg">
            </div>
            <div class="producttitle">
                <h2>Product title</h2>
            </div>
            <div class="productdescription">
                <p>productdescripsklzx</p>
            </div>
            <div class="productprice">
                <h2>Rs.199.00</h2>
            </div>
            <div class="productbtncontainer">
                <button class="productbtn" id="addtocart">Add to cart</button>
            </div>
        </div>

        <?php
        require_once 'dataBase.php';

        // Start the session

        // Set session variables
        $_SESSION["email"] = "green";
        $_SESSION["password"] = "cat";
        $cart = array(1, 2, 3);
        echo $cart[0];

        echo "Session variables are set.";
        echo "<br>";
        echo "Session variables are: " . $_SESSION["email"] . " and " . $_SESSION["password"] . ".";

        // SQL QUERY 
        $query = "SELECT * FROM `products`;";

        // FETCHING DATA FROM DATABASE 
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // OUTPUT DATA OF EACH ROW 
            while ($row = $result->fetch_assoc()) {
                echo "
                <div class='productcard'>
                    <div class='productcardimg'>
                        <img src='{$row['image_path']}' alt='' class='productimg'>
                    </div>
                    <div class='producttitle'>
                        <h2>{$row['product_name']}</h2>
                    </div>
                    <div class='productdescription'>
                        <p>{$row['description']}</p>
                    </div>
                    <div class='productprice'>
                        <h2>Rs.{$row['price']}</h2>
                    </div>
                    <div class='productbtncontainer'>
                        <button class='productbtn' id='addtocart'>Add to cart</button>
                    </div>
                </div>";
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</body>

</html>