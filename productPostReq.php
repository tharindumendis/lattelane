<?php
require_once 'dataBase.php';

$response = array();
$upload_dir = 'uploads/';

// Get form data
$id = $_POST['id'];
$product_name = $_POST['product_name'];
$description = $_POST['description'];
$category = $_POST['category'];
$price = $_POST['price'];
$cost = $_POST['cost'];
$image_path = $_POST['image_path'];
$active = $_POST['active'];
$discount = $_POST['discount'];

// Handle image upload if new file is selected
if (isset($_FILES['image_file' . $id]) && $_FILES['image_file' . $id]['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['image_file' . $id]['tmp_name'];
    $file_name = time() . '_' . $_FILES['image_file' . $id]['name'];
    $file_destination = $upload_dir . $file_name;

    if (move_uploaded_file($file_tmp, $file_destination)) {
        $image_path = $file_destination;
    }
}

// Update database
$sql = "UPDATE products SET 
        product_name = ?, 
        description = ?, 
        category = ?, 
        price = ?, 
        cost = ?, 
        image_path = ?, 
        active = ?, 
        discount = ? 
        WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssddsiid",
    $product_name,
    $description,
    $category,
    $price,
    $cost,
    $image_path,
    $active,
    $discount,
    $id
);

if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = 'Product updated successfully';
} else {
    $response['success'] = false;
    $response['message'] = 'Database update failed';
}

echo json_encode($response);
$stmt->close();
$conn->close();
