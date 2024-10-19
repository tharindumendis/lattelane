<?php
require_once 'dataBase.php';

function addToCart($productId)
{
    if (isset($_SESSION["cart"])) {
        array_push($_SESSION["cart"], $productId);
        $_SESSION["cart"] = array_unique($_SESSION["cart"]);
    }
    //print_r($_SESSION["cart"]);
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
                        <button id='add-to-cart' name='add-to-cart' data-product-id='{$row['id']}'>Add to Cart</button>
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
                             <input type='submit' name='Submitnvoice$count' id=''>
                            
                            
                            <td>Rs.<input type='number' name='itemTotal' id='total{$row['id']}' readonly >
                            <form action='' method='post'>
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
