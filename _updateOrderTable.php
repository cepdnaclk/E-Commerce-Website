<?php

$connection = mysqli_connect('localhost', 'root', "", "online_store");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderId = $_POST['orderId'];
    $column = $_POST['column'];
    $newValue = $_POST['newValue'];

    if ($column == 'OrderStatus'){
        $updateQuery = "UPDATE orders SET $column = '$newValue' WHERE OrderID = '$orderId'";


    }
    else{
        $updateQuery = "UPDATE tracking SET $column = '$newValue' WHERE OrderID = '$orderId'";
    }



    // Update the database with the new value
    
    $result = mysqli_query($connection, $updateQuery);

    if ($result) {
        echo "Success"; // Return success message to AJAX
    } else {
        echo "Error"; // Return error message to AJAX
    }
}
?>
