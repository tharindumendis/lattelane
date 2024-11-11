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
    $result = $conn->query($fetchQuery);

    if ($result->num_rows > 0) {
        // OUTPUT DATA OF EACH ROW 
        while ($row = $result->fetch_assoc()) {
            echo "
                <div class='productcard'>
                    <div class='productcardimg'>
                        <img src='{$row['image_path']}' alt='' class='productimg'>
                    </div>
                    <div class='productcardinfo'>
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
                        <button class='addToCartBtn btn{$row['id']}' id='add-to-cart' name='add-to-cart' data-product-id='{$row['id']}' onclick='click()'></button>
                    </div>
                </div>
                    
                </div>";
            echo "<script>
                        const btn{$row['id']} = document.querySelectorAll('.btn{$row['id']}');
                        btn{$row['id']}.forEach(button => {
                            button.addEventListener('click', () => {
                                btn{$row['id']}.forEach(btn => {
                                    btn.textContent = '✅';                                });
                            });
                        });
                    </script>";
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
                            <td class='pImgBox'><img src='{$row['image_path']}' class='pImg'></td>
                            <td colspan='3' >{$row['product_name']}<br>
                            Rs.<input type='number' value='{$row['price']}' name='price$count' id='price{$row['id']}' readonly ></td>
                        </tr>

                        <tr class='itemBox'>
                            
                            
                            <input type='hidden' name='itemId$count' id='itemId{$row['id']}' value='{$row['id']}'>

                            
                            

                            

                            <form action='userUpdate.php' method='post'>
                            <td><input type='hidden' name='removeItemId' id='itemId{$row['id']}' value='{$row['id']}'>
                            <button type='submit' name='removeFromCart' id='removeFromCart'><i class='fa-solid fa-trash-can'></i></button>
                            </form></td>
                            
                            <td colspan='3' ><div class='totalContainer'><input class='qtyInput' type='number' name='quantity$count' id='cartQuantity{$row['id']}' value='1' min='1' max='20'>
                            <div class='subtotalContainer'>
                            <label for='quantity' class='qtyLabel'>Total</label>
                            <div>
                            Rs.<input type='number' name='itemTotal' class='itemTotal' id='total{$row['id']}' readonly >
                            </div>
                            </div>
                            </div></td>



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
    if ($_SESSION['id'] == "") {
        echo "<script>
        alert('Please login to checkout');
        window.location.href = 'UserLogin.php';
        </script>";
    } else {
        for ($i = 0; $i < count($_SESSION["cart"]); $i++) {


            $invoiceId = $_SESSION['bill_count'];
            $userId = $_SESSION['id'];
            $productId = $_POST['itemId' . $i];
            $quantity = $_POST['quantity' . $i];
            $price = $_POST['price' . $i];
            $total = $quantity * $price;
            $PaymentMethod = $_POST['paymentMethod'];

            $insertQuery = "INSERT INTO `invoices`( `user_id`, `user_Invoice_id`,`product_id`, `price`, `quantity`, `total`,`payment_method`) 
            VALUES ('$userId','$invoiceId','$productId','$price','$quantity','$total','$PaymentMethod')";

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
            echo "<div id='messageContainer' action='index.php''>
            <p id='message'>Login successful!</p><a href='index.php'><button id='shopNowBtn'>Shop now</button></a>
            </div>";

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

            echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 500);</script>";
        } else {
            echo "<p id='message'>Invalid password.</p>";
        }
    } else {
        echo "<p id='message'>Login failed. Please check your email and password.</p>";
    }
}

function displayBills($conn)
{
    $user_id = $_SESSION['id'];
    $getBills = "SELECT i.*, p.product_name FROM invoices i 
                         JOIN products p ON i.product_id = p.id 
                         WHERE i.user_id = '$user_id' 
                         ORDER BY i.invoice_id DESC;";
    $getBillsResult = mysqli_query($conn, $getBills);
    $temp = $_SESSION['bill_count'] - 1;
    $temptotal = 0;
    $tempmethod = "";
    $tempdate = "";
    if (mysqli_num_rows($getBillsResult) > 0) {
        while ($row = mysqli_fetch_assoc($getBillsResult)) {

            if ($row['user_Invoice_id'] != $temp) {


                echo "<tr>";
                echo "<th colspan='2' >" . $tempdate . "</th>";
                echo "<th>" . $temptotal . ".00" . "</th>";
                echo "<th class='payment' >" . $tempmethod . "</th>";
                echo "</tr>";
                $temp--;
                $temptotal = 0;
                echo "<tr>";
                echo "<td>" . "__" . "</td>";
                echo "</tr>";
            }

            echo "<tr>";

            echo "<td colspan='2' >" . "Invoice ID : " . $row['invoice_id'] . "</td>";
            echo "<td colspan='2'>" . $row['product_name'] . "</td>";
            echo "<th> </th>";

            $temptotal +=  $row['total'];
            echo "<tr>";
            echo "<td>" . $row['price'] . ".00" . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>" . $row['total'] . ".00" . "</td>";
            echo "<td class='status pending'>" . $row['status'] . "</td>";
            echo "</tr>";
            $tempmethod = $row['payment_method'];
            $tempdate  = $row['date'];
        }
    } else {
        echo "<tr><td colspan='9'>No bills found</th></tr>";
    }
    echo "<tr>";
    echo "<th colspan='2' >" . $tempdate . "</th>";
    echo "<th>" . $temptotal . ".00" . "</th>";
    echo "<th class='payment' >" . $tempmethod . "</th>";
    echo "</tr>";
    $temp--;
    $temptotal = 0;
    echo "<tr>";
    echo "<td>" . "__" . "</td>";
    echo "</tr>";

    $temp--;
    $temptotal = 0;
    echo "<tr>";
    echo "<td>" . "" . "</td>";
    echo "</tr>";
}

function getAllinvoces($conn)
{

    $getAllBills = "SELECT i.*, p.product_name FROM invoices i 
                         JOIN products p ON i.product_id = p.id 
                         ORDER BY i.invoice_id DESC;";
    $result = $conn->query($getAllBills);
    if ($result->num_rows > 0) {

        $tempBillNum = 0;
        $tempDate = "";
        $tempTotal = 0;
        $tempUser_id = "";
        $tempPaymentMethod = "";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td colspan='2'>" . "____O. ID : " . $row["invoice_id"] . "</td>";
            echo "<td colspan='1'>" . $row["product_name"] . "</td>";
            echo "<td colspan='1'><select name='status' onchange='updateStatus(this.value, " . $row["invoice_id"] . ")'>
            <option value='pending' " . ($row["status"] == 'pending' ? 'selected' : '') . ">Pending<i class='fa-solid fa-truck-arrow-right'></i></option>
            <option value='Out for delivery' " . ($row["status"] == 'Out for delivery' ? 'selected' : '') . ">Out for delivery</option>
            <option value='delivered' " . ($row["status"] == 'delivered' ? 'selected' : '') . ">delivered</option>
            </select></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>" . 'Rs.' . $row["price"] . "</td>";
            echo "<td class='qtyColumn'>" . $row["quantity"] . "</td>";
            echo "<td>" . 'Rs.' . $row["total"] . "</td>";

            echo "<td>" . "" . "</td>";
            echo "<td>" . "" . "</td>";
            echo "</tr>";
            $tempTotal += $row["total"];
            $tempPaymentMethod = $row["payment_method"];

            if ($row["invoice_id"] != $tempBillNum && $row["date"] != $tempDate) {

                $tempDate = $row["date"];
                $tempUser_id = $row["user_id"];

                echo "<tr class='total'>";
                echo "<th colspan='2'>" . $tempDate . "</th>";
                echo "<th class='totalBox'>" . 'Total Rs. ' . $tempTotal . ".00" . "</th>";
                echo "<th colspan'1'>" . 'Custamer_Id:' . $tempUser_id . " " . $tempPaymentMethod . "</th>";
                echo "<tr>";
                echo "<th colspan='4'>" . "____________________________" . "</th>";
                echo "</th>";

                $tempTotal = 0;
            } else {
            }


            $tempBillNum = $row["invoice_id"];
            $tempDate = $row["date"];
            $tempUser_id = $row["user_id"];
            $tempPaymentMethod = $row["payment_method"];
        }
        echo "<tr class='total'>";
        echo "<th colspan='2'>" . $tempDate . "</th>";
        echo "<th class='totalBox'>" . 'Total Rs. ' . $tempTotal . ".00" . "</th>";
        echo "<th colspan'1'>" . 'Custamer_Id:' . $tempUser_id . " " . $tempPaymentMethod . "</th>";
        echo "<tr>";
        echo "<th colspan='4'>" . "____________________________" . "</th>";
        echo "</th>";


        $tempTotal = 0;
    }
}

function getMonthlySalesAndCost($conn)
{
    $query = "SELECT DATE_FORMAT(i.date, '%Y-%m') AS month,
     SUM(i.total) AS total_sales, SUM(p.cost * i.quantity) AS total_cost,
      SUM(i.total - (p.cost * i.quantity)) AS profit 
      FROM invoices i JOIN products p ON i.product_id = p.id 
      GROUP BY DATE_FORMAT(i.date, '%Y-%m') ORDER BY month ASC LIMIT 12;";

    $result = mysqli_query($conn, $query);
    $months = [];
    $sales = [];
    $costs = [];
    $profits = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $months[] = $row['month'];
        $sales[] = $row['total_sales'];
        $costs[] = $row['total_cost'];
        $profits[] = $row['profit'];
    }

    return [
        'months' => $months,
        'sales' => $sales,
        'costs' => $costs,
        'profits' => $profits
    ];
}
function getMonthlySalesAndCostByTable($conn)
{
    $totalSales = 0;
    $totalCost = 0;
    $totalProfit = 0;
    $salesData = getMonthlySalesAndCost($conn);
    for ($i = 0; $i < count($salesData['months']); $i++) {
        $totalSales += $salesData['sales'][$i];
        $totalCost += $salesData['costs'][$i];
        $totalProfit += $salesData['profits'][$i];

        echo "<tr>";
        echo "<td class='monthColumn'>" . $salesData['months'][$i] . "" . "</td>";
        echo "<td>" . $salesData['sales'][$i]  . ".00" . "</td>";
        echo "<td>" . $salesData['costs'][$i] . "</td>";
        echo "<td>" . $salesData['profits'][$i] . "</td>";
        echo "</tr>";
    }
    echo "<tr class='totalTr'>";
    echo "<td class='monthColumn'>" . "Total Rs." . "</td>";
    echo "<td>" . $totalSales . ".00" . "</td>";
    echo "<td>" . $totalCost . ".00". "</td>";
    echo "<td>" . $totalProfit . ".00". "</td>";
    echo "</tr>";
}


function fetchBlogs($conn)
{

    $fetchQuery = "SELECT * FROM blogs ORDER BY blog_id DESC;";

    $result = $conn->query($fetchQuery);

    if ($result->num_rows > 0) {
        // OUTPUT DATA OF EACH ROW 
        while ($row = $result->fetch_assoc()) {


            echo " <div id='blog'>
        <div id='nameContainer'>
            <h3>{$row['user_first_name']} {$row['user_last_name']}</h3>
        </div>
        <div id='contentContainer'>
            <p>{$row['content']}</p>
        </div>
        <div id='imageContainer'><img src='{$row['image_url']}'  id='blogImage'></div>
        <div id='likeContainer' class='likeContainer'>
            <p>Like : </p><p id='likeCount{$row['blog_id']}'>{$row['likes']}</p> 
            <div><button id='likeBtn{$row['blog_id']}'  class='likeBtn'  name='likebtn'><i class='fa-regular fa-heart' id='likeicon{$row['blog_id']}'></i></button></div>
        </div>
        </div>
        
        <script>
    const likeBtn{$row['blog_id']} = document.getElementById('likeBtn{$row['blog_id']}');
    const likeCount{$row['blog_id']} = document.getElementById('likeCount{$row['blog_id']}');
    const likeicon{$row['blog_id']} = document.getElementById('likeicon{$row['blog_id']}');
    let liked{$row['blog_id']} = false;
    likeBtn{$row['blog_id']}.addEventListener('click', () => {

        if (liked{$row['blog_id']}) {
            likeBtn{$row['blog_id']}.innerHTML = `<i class='fa-regular fa-heart'></i>`
            liked{$row['blog_id']} = false;
            likeCount{$row['blog_id']}.innerHTML = parseInt(likeCount{$row['blog_id']}.innerHTML) - 1;


            $.ajax({
                url: 'add_to_cart.php',
                method: 'POST',
                data: {
                    blogid: {$row['blog_id']},
                    action: 'nolike'
                },
                success: function(response) {
                    console.log('Like processed:', response);
                }
            });


        } else {
            likeBtn{$row['blog_id']}.innerHTML = `<i class='fa-solid fa-heart'></i>`
            liked{$row['blog_id']} = true;
            likeCount{$row['blog_id']}.innerHTML = parseInt(likeCount{$row['blog_id']}.innerHTML) + 1;


            $.ajax({
                url: 'add_to_cart.php',
                method: 'POST',
                data: {
                    blog_id: {$row['blog_id']},
                    action: 'like'
                },
                success: function(response) {
                    console.log('Like processed:', response);
                }
            });

        }
    })
</script>";
        }
    }
}
function adminPanel()
{
    echo "
    
    <div class='btnSet'><button class='menuBtn' id='menuBtn'><i class='fa-solid fa-xmark' id='menuIcon'></i></button></div>";
    echo "<link rel='stylesheet' href='src/css/admin.css'>
    
    

    
    <div class='menu'>
    <div class='adminPanelContainer'>
    <div class='adminPanel'>
        <div class='btnSet'>
            <button class='panelBtn' onclick='window.location.href=`dashBoard.php`;'><i class='fa-solid fa-chart-line'></i></button>
            <label class='panelLabel'>DashBoard</label>
        </div>
        
        <div class='btnSet'>
            <button class='panelBtn' onclick='window.location.href=`invoices.php`;'><i class='fa-regular fa-file-lines'></i></button>
            <label class='panelLabel'>Invoices</label>
        </div>
        <div class='btnSet'>
            <button class='panelBtn' onclick='window.location.href=`productUpdate.php`;'><i class='fa-solid fa-box'></i></button>
            <label class='panelLabel'>Products</label>
        </div>
        <div class='btnSet'>
            <button class='panelBtn' onclick='window.location.href=`addProductForm.php`;'><i class='fa-solid fa-square-plus'></i></button>
            <label class='panelLabel'>Add Product</label>
        </div>
        <div class='btnSet'>
            <button class='panelBtn' onclick='window.location.href=`usersData.php`;'><i class='fa-solid fa-users'></i></button>
            <label class='panelLabel'>Users</label>
        </div>
        <div class='btnSet'>
            <button class='panelBtn' onclick='window.location.href=`addProductForm.php`;'><i class='fa-solid fa-table'></i></button>
            <label class='panelLabel'>Add Category</label>
        </div>

    </div>
    </div>

</div>
    
    ";
}
