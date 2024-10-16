<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="src/req.css">
</head>

<body>
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