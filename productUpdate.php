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
    <link rel="stylesheet" href="src/css/productUpdate.css">

</head>

<body>
    <div class="mainContainer">
        <?php include 'tempnav.php';
        adminPanel(); ?>



        <div>
            <form action="" method="POST" enctype="multipart/form-data" class="searchForm">
                <input type="text" name="search" placeholder="search">

                <?php
                $category_sql = "SELECT * FROM category";
                $category_result = mysqli_query($conn, $category_sql);
                echo "<select name='categoryFilter'>";
                echo "<option value='all'>All Categories</option>";
                while ($category = mysqli_fetch_assoc($category_result)) {
                    echo "<option value='" . $category['category_name'] . "' " . $selected . ">" . $category['category_name'] . "</option>";
                }
                echo "</select>";

                ?>
                <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <div>
        </div>
        <div class="productContainer">
            <table class="productTable">
                <thead>
                    <tr id="productTableHeader">
                        <th style="width: 20px;">ID</th>
                        <th style="width: 111.6px;">Image Path</th>
                        <th style="width: 165.6px;">Product Name</th>
                        <th style="width: 164px;">Description</th>
                        <th style="width: 93.6px;">Category</th>
                        <th style="width: 83.2px;">Price</th>
                        <th style="width: 83.2px;">Cost</th>
                        <th style="width: 44px;">Active</th>
                        <th style="width: 66.61px;">Discount</th>
                        <th style="width: 0px;">.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['search']) && $_POST['categoryFilter'] == 'all') {
                        $search = $_POST['search'];
                        $sql = "SELECT * FROM products WHERE product_name LIKE '%$search%';";
                    } elseif (isset($_POST['search']) && $_POST['categoryFilter'] != 'all') {
                        $search = $_POST['search'];
                        $categoryFilter = $_POST['categoryFilter'];
                        $sql = "SELECT * FROM products WHERE product_name LIKE '%$search%' AND category = '$categoryFilter';";
                    } elseif (!isset($_POST['search']) && isset($_POST['categoryFilter']) && $_POST['categoryFilter'] != 'all') {
                        $categoryFilter = $_POST['categoryFilter'];
                        $sql = "SELECT * FROM products WHERE category = '$categoryFilter';";
                    } else {
                        $sql = "SELECT * FROM products;";
                    }

                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td id='idLine'>" . $row['id'] . "</td>";
                        echo "<td id='imagePathLine'>
                                                <img src='" . $row['image_path'] . "' class='productImage'>
                                                <input type='file' name='image_file" . $row['id'] . "' accept='image/*' class='file-input'>
                                                <input type='hidden' name='image_path' value='" . $row['image_path'] . "'>
                                            </td>";

                        echo "<td><input type='text' name='product_name' value='" . $row['product_name'] . "'></td>";
                        echo "<td><textarea name='description'>" . $row['description'] . "</textarea></td>";

                        $category_sql = "SELECT * FROM category";
                        $category_result = mysqli_query($conn, $category_sql);
                        echo "<td><select name='category'>";
                        while ($category = mysqli_fetch_assoc($category_result)) {
                            $selected = ($row['category'] == $category['category_name']) ? 'selected' : '';
                            echo "<option value='" . $category['category_name'] . "' " . $selected . ">" . $category['category_name'] . "</option>";
                        }
                        echo "</select></td>";

                        echo "<td><input class='priceCostLine' type='number' step='0.01' name='price' value='" . $row['price'] . "'></td>";
                        echo "<td><input class='priceCostLine' type='number' step='0.01' name='cost' value='" . $row['cost'] . "'></td>";
                        echo "<td><select name='active'>
                                                                <option value='1' " . ($row['active'] == 1 ? 'selected' : '') . ">Yes</option>
                                                                <option value='0' " . ($row['active'] == 0 ? 'selected' : '') . ">No</option>
                                                              </select></td>";
                        echo "<td class='lastColumn'><input class='discountLine' type='number' step='0.01' name='discount' value='" . $row['discount'] . "'></td>";
                        echo "<td>
                                                                <button onclick='saveChanges(" . $row['id'] . ")' class='saveBtn'>Save</button>
                                                              </td>";
                        echo "</tr>";
                    }
                    ?> </tbody>
            </table>


            <script>
                function addNewProduct() {
                    window.location.href = 'addProductForm.php';
                }

                function saveChanges(id) {
                    const row = event.target.closest('tr');
                    const formData = new FormData();

                    formData.append('id', id);
                    formData.append('product_name', row.querySelector('[name="product_name"]').value);
                    formData.append('description', row.querySelector('[name="description"]').value);
                    formData.append('category', row.querySelector('[name="category"]').value);
                    formData.append('price', row.querySelector('[name="price"]').value);
                    formData.append('cost', row.querySelector('[name="cost"]').value);
                    formData.append('image_path', row.querySelector('[name="image_path"]').value);
                    formData.append('image_file' + id, row.querySelector('[name="image_file' + id + '"]').files[0]);
                    formData.append('active', row.querySelector('[name="active"]').value);
                    formData.append('discount', row.querySelector('[name="discount"]').value);

                    fetch('productPostReq.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Product updated successfully');
                                console.log(formData.forEach(entry => console.log(entry)));
                            } else {
                                alert('Error updating product');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error updating product');
                        });
                }
            </script>

        </div>

        <div class="btnSetBottom">
            <button onclick="addNewProduct()">Add New Product</button>
        </div>
    </div>
    <?php include 'mobileNav.php'; ?>
</body>
<script src="./src/js/adminBtn.js"></script>

</html>