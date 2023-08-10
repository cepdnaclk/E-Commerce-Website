<?php
// Include necessary dependencies and establish database connection

//if (isset($_GET['orderID'])) {
    $orderID = $_GET['orderID'];

    echo 'afbkjfk';

    // Retrieve order details from the database using $orderID
    // Perform your database query here and fetch the necessary data

    // Prepare and echo the order details as JSON response
    $orderDetails = array(
        'OrderTotal' => "dsdgf",
        'ProductIDs' => $productIDs
        // Add other order details here
    );

    echo json_encode($orderDetails);

?>
