<!-- Shopping cart section  -->
<?php

    if (session_status() === PHP_SESSION_ACTIVE) {

    } else {
        session_start();
    }
    
    ?>



<?php



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['proceed_to_buy'])) {
    // Get the total price from the form data
    $totalPrice = $_POST['total_price'];
    $cart_id = $_POST['cart_id'];
    
    // Retrieve the customer ID from the session
    $customerID = $_SESSION['CustomerID'];

    // Connect to the database
    $connection = mysqli_connect('localhost', 'root', "", "online_store");

    // Insert order details into the "orders" table
    $insertOrderQuery = "INSERT INTO orders (CustomerID, OrderDate,OrderTotal, OrderStatus) VALUES ('$customerID', NOW(),'$totalPrice', 'Pending')";

    mysqli_query($connection, $insertOrderQuery);

    // Get the generated order ID
    $orderID = mysqli_insert_id($connection);


    //insert tracking details into  the "tracking"  table
    $insertTrackingQuery = "INSERT INTO tracking (OrderID) VALUES ('$orderID')";
    
    mysqli_query($connection, $insertTrackingQuery);

    // Loop through cart items and insert into the "order_items" table
    //$cartItems = $Cart->getCart($CartID); // Replace with your cart retrieval logic

    $cartQuery = "SELECT * FROM cart_items WHERE CartID = '$cart_id'";
    $cartResult = mysqli_query($connection, $cartQuery);

     foreach ($cartResult as $cartItem) {
        $productID = $cartItem['ProductID'];
        $qty = $cartItem['Qty'];
        $price = $cartItem['Price'];

        // Insert into "order_items" table
        $insertOrderItemQuery = "INSERT INTO order_item (OrderID, ProductID, OrderQty, Price) VALUES ('$orderID', '$productID', '$qty', '$price')";
        mysqli_query($connection, $insertOrderItemQuery);

        //modify products table
        $productQuery = "SELECT ProductQty FROM product WHERE ProductID = '$productID'";
        $productResult = mysqli_query($connection, $productQuery);

            $productData = mysqli_fetch_assoc($productResult);
            $currentQty = $productData['ProductQty'];

            // Calculate the updated quantity
            $updatedQty = $currentQty - $qty;

            // Update the product quantity in the products table
            $updateProductQuery = "UPDATE product SET ProductQty = '$updatedQty' WHERE ProductID = '$productID'";
            mysqli_query($connection, $updateProductQuery);
    

    }

    

    // Delete the cart and associated cart items
    $deleteCartItemsQuery = "DELETE FROM cart_items WHERE CartID = '$cart_id'";
    $deleteCartQuery = "DELETE FROM cart WHERE CartID = '$cart_id'";
    mysqli_query($connection, $deleteCartItemsQuery);
    mysqli_query($connection, $deleteCartQuery);
    



}
?>

<div class="copyright text-center text-black py-2">
    <br><br><br><br>
    <h1  class="font-baloo font-size-50">Congratulations!</h1>
    <h1 class = "font-baloo font-size-50">Order placed successfully</h1> <br>
    
    <strong><h5 class="font-rubik font-size-20"> Your Order ID: <?php echo "$orderID"; ?> </h5><br></strong>

    <h5 class="font-rubik font-size-24 font-color-blue" > Any Concerns? </h5>

    <h5 class="font-rubik font-size-20 color-primary">  Contact us 24*7 via our hotline : 071-1234567  </h5>
    <br><br><br><br><br>

    </div>


