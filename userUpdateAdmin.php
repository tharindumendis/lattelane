<?php
require_once 'dataBase.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'];
    $userId = $_POST['userId'];
    
    $sql = "UPDATE users SET admin = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $status, $userId);
    
    if ($stmt->execute()) {
        echo "Admin status updated successfully";
    } else {
        echo "Error updating admin status";
    }
    
    $stmt->close();
}
