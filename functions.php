<?php
require_once 'dataBase.php';

function addToCart($productId)
{
    $_SESSION["cart"];

    if (isset($_SESSION["cart"])) {
        array_push($_SESSION["cart"], $productId);
        $_SESSION["cart"] = array_unique($_SESSION["cart"]);
    }
    print_r($_SESSION["cart"]);
}
function findIndex($array, $element)
{
    foreach ($array as $index => $value) {
        if ($value === $element) {
            return $index;
        }
    }
    return -1;
}
function removeFromCart($productId)
{
    if (isset($_SESSION["cart"])) {
        $index = findIndex($_SESSION["cart"], $productId);
        //echo $index;
        if ($index !== -1) {
            unset($_SESSION["cart"][$index]);
            $_SESSION["cartQuantity"] -= 1;
        }
    }
    //print_r($_SESSION["cart"]);
}
// function add Qty and product together
function updateCart($productId, $quantity)
{
    if (isset($_SESSION["cart"])) {
        $index = findIndex($_SESSION["cart"], $productId);
        if ($index !== -1) {
            $_SESSION["cart"][$index] = $quantity;
        }
    }
    //print_r($_SESSION["cart"]);
}

function clearCart()
{
    if (isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
        $_SESSION["cartTotal"] = 0;
        $_SESSION["cartQuantity"] = 0;
    }
    //print_r($_SESSION["cart"]);
}

// To display the products
function DisplayProducts($fetchQuery, $conn)
{
    require_once 'dataBase.php';
    $result = $conn->query($fetchQuery);

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
                        <button class='addToCartBtn' id='add-to-cart' name='add-to-cart' data-product-id='{$row['id']}'></button>
                    </div>
                </div>";
        }
    }
}


function  getCartItems($conn)
{
    if (isset($_SESSION['cart'])) {
        $count = 0;
        foreach ($_SESSION['cart'] as $item) {

            $query = "SELECT * FROM `products` WHERE id = $item;";

            // FETCHING DATA FROM DATABASE 
            $result = $conn->query($query);

            if ($result->num_rows > 0) {

                // OUTPUT DATA OF EACH ROW 
                while ($row = $result->fetch_assoc()) {

                    echo "
                        <tr>
                            <td><img src='{$row['image_path']}' width='50'></td>
                            <td>{$row['product_name']}</td>
                            
                             <input type='hidden' name='itemId$count' id='itemId{$row['id']}' value='{$row['id']}'>

                            <td>Rs.<input type='number' value='{$row['price']}' name='price$count' id='price{$row['id']}' readonly ></td>
                            <td><input type='number' name='quantity$count' id='cartQuantity{$row['id']}' value='1' min='1' max='20'></td>
                            
                            
                            
                            <td>Rs.<input type='number' name='itemTotal' id='total{$row['id']}' readonly >
                            <form action='userUpdate.php' method='post'>
                            <input type='hidden' name='removeItemId' id='itemId{$row['id']}' value='{$row['id']}'>
                            <button type='submit' name='removeFromCart' id='removeFromCart'>Remove</button>
                            </form>
                            </td>
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
                    $count++;
                    $_SESSION["cartTotal"] += $row['price'];
                    $_SESSION["cartQuantity"] = $count;
                }
            }
        };
    }
}



function checkout($conn)
{
    for ($i = 0; $i < count($_SESSION["cart"]); $i++) {


        $invoiceId = $_SESSION['bill_count'];
        $userId = $_SESSION['id'];
        $productId = $_POST['itemId' . $i];
        $quantity = $_POST['quantity' . $i];
        $price = $_POST['price' . $i];
        $total = $quantity * $price;

        $insertQuery = "INSERT INTO `invoices`( `user_id`, `user_Invoice_id`,`product_id`, `price`, `quantity`, `total`) 
            VALUES ('$userId','$invoiceId','$productId','$price','$quantity','$total')";

        if ($conn->query($insertQuery)) {

            //echo "completed";
        } else {
            //echo "failed";
        }
    }
    $SetNewBillCount = $_SESSION['bill_count'] + 1;
    $_SESSION['bill_count'] = $SetNewBillCount;
    $setUserBillCountQuery =
        "UPDATE `users` 
                SET `bill_count` = '$SetNewBillCount' 
                WHERE `users`.`id` = $userId;";

    if ($conn->query($setUserBillCountQuery)) {
        clearCart();
        //echo "completed";
    } else {
        //echo "failed";
    }
}

function logIn($email, $password, $conn)
{
    //check if the user exists in the database
    $sql_check = "SELECT * FROM Users WHERE email = '$email'";
    $result = $conn->query($sql_check);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        //check if the password is correct
        if (password_verify($password, $row["password"])) {
            echo "Login successful!";

            //set session variables
            $_SESSION["id"] = $row["id"];
            $_SESSION["first_name"] = $row["first_name"];
            $_SESSION["last_name"] = $row["last_name"];
            $_SESSION["address_no"] = $row["address_no"];
            $_SESSION["street"] = $row["street"];
            $_SESSION["city"] = $row["city"];
            $_SESSION["phone"] = $row["phone"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["password"] = $row["password"];
            $_SESSION["admin"] = $row["admin"];
            $_SESSION["bill_count"] = $row["bill_count"];
            print_r($_SESSION);


            header("Location: index.php");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Login failed. Please check your email and password.";
    }
}
