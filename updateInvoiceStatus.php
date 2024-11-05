<?php
require_once 'dataBase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'];
    $invoiceId = $_POST['invoice_id'];

    $sql = "UPDATE invoices SET status = '$status' WHERE invoice_id = $invoiceId";

    if ($conn->query($sql)) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status";
    }
}
