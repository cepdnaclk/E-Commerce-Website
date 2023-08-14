<?php  
ob_start();
// include header.php file
include ('header.php');
?>

<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['proceed_to_buy'])) {
    $totalPrice = $_POST['total_price'];
    $cart_id = $_POST['cart_id'];
    


    // Retrieve user details (you need to fetch these from your database)
    $CustomerID = $_SESSION['CustomerID'] ;
    
    $connection = mysqli_connect('localhost', 'root', "", "online_store");


    // Retrieve customer details using the customer ID
    $customerQuery = "SELECT * FROM customer WHERE CustomerID = '$CustomerID'";
    $customerResult = mysqli_query($connection, $customerQuery);

    if ($customerResult && mysqli_num_rows($customerResult) > 0) {
        // Fetch customer details from the result set
        $customerData = mysqli_fetch_assoc($customerResult);

        // Extract customer details
        $customerFName = $customerData['FirstName'];
        $customerLName = $customerData['LastName'];
        $email = $customerData['Email'];
        $telNo = $customerData['PhoneNumber'];
        $AddressL1 = $customerData['AddressL1'];
        $AddressL2 = $customerData['AddressL2'];
        $AddressL3 = $customerData['AddressL3'];

        
}}
?>

<!-- Display order details and shipping address -->

<!-- ajhfvkjhasvkffvakhfakhfkahfkhajuvffakhvfkahfahflahflahvflhavflhalfhalfhlahfvlahvsflhavlfhalhfvlfhlhfvalhjv -->
<!-- Shopping cart section  -->
<?php

    // Find cart Id belongs to current customer
    $CartID = 0;
    $resultArray = array();
    $resultArray=$product->getData('cart');
    foreach ($resultArray as $item) {
        if(isset($_SESSION['CustomerID']) && $item['CustomerID'] === $_SESSION['CustomerID']){
            $CartID = $item['CartID'];
        }
    }

?>

<section id="cart" class="py-3 mb-5">
    <div class="container-fluid w-75">
        <h5 class="font-baloo font-size-20">Order Confirmation</h5>

        <!--  shopping cart items   -->
        <div class="row">
            <div class="col-sm-9">
                <?php
                $totalPrice = 0;
                $cartItems = $Cart->getCart($CartID);
                if (!empty($cartItems)) {
                    foreach ($cartItems as $cart) {
                        $item = $product->getProduct($cart['ProductID']);
                        $item = $item[0];
                        // ... rest of the code for displaying cart items ...


                ?>
                <!-- cart item -->
                <div class="row border-top py-3 mt-3">
                    <div class="col-sm-2">
                        <img src="<?php echo $item['ProductImage'] ?? "./assets/products/1.png" ?>" style="height: 120px;" alt="cart1" class="img-fluid">
                    </div>
                    <div class="col-sm-8">
                        <h5 class="font-baloo font-size-20"><?php echo $item['ProductName'] ?? "Unknown"; ?></h5>
                        <small>by <?php echo $product->getCategory($item['ProductCatagory'])?? "Brand"; ?></small>
                        <!-- product rating -->
                        <!--<div class="d-flex">
                            <div class="rating text-warning font-size-12">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="far fa-star"></i></span>
                            </div>
                            <a href="#" class="px-2 font-rale font-size-14">20,534 ratings</a>
                        </div>-->
                        <!--  !product rating-->

                        <!-- product qty -->
                        <div class="qty d-flex pt-2">
                            <div class="d-flex font-rale w-25">
                                <button class="qty-up border bg-light" data-id="" disabled>Qty</i></button>
                                <input type="text" data-id="qty" class="qty_input border px-2 w-100 bg-light" disabled  placeholder="<?php echo $cart['Qty'] ?? '0'; ?>">
                                <!--<button data-id="<?php /*echo $item['ProductID'] ?? '0'; */?>" class="qty-down border bg-light"><i class="fas fa-angle-down"></i></button>-->
                            </div>

                    

                            <!--<form method="post">
                                <input type="hidden" value="<?php /*echo $item['ProductID'] ?? 0; */?>" name="item_id">
                                <button type="submit" name="wishlist-submit" class="btn font-baloo text-danger">Save for Later</button>
                            </form>
-->

                        </div>
                        <!-- !product qty -->

                    </div>

                    <div class="col-sm-2 text-right">
                        <div class="font-size-20 text-danger font-baloo">
                            $<span class="product_price" data-id="<?php echo $item['ProductID'] ?? '0'; ?>"><?php echo $item['ProductPrice'] ?? 0; ?></span>
                        </div>
                    </div>
                </div>
                <!-- !cart item -->
                <?php
                        $totalPrice = $cart['Price'] + $totalPrice;
                    }
                } else {
                    echo '<p>Your cart is empty.</p>';
                }
                ?>
            </div>
            <!-- subtotal section-->
            <div class="col-sm-3">
                <div class="sub-total border text-center mt-2">
                    <h6 class="font-size-12 font-rale text-success py-3"><i class="fas fa-check"></i> Your order is eligible for FREE Delivery.</h6>
                    <div class="border-top py-4">
                    <strong><h5 class="font-baloo font-size-20">Subtotal : <span class="text-danger">$<span class="text-danger" id="deal-price"><?php echo $totalPrice ?></span> </h5></strong>
                        
                        <div class ="col sm-2 text-left">
                        <p><strong><h2 class="font-baloo font-size-16">Shipping Details:</h2></strong>
                                
                                <?php echo $customerFName; ?> <?php echo $customerLName; ?>,<br>
                    
                                    <?php echo $AddressL1; ?>,<br>
                                    <?php echo $AddressL2; ?>,<br>
                                    <?php echo $AddressL3; ?>.<br>
                                
                                
                                Email: <?php echo $email; ?> <br>
                                Tel: <?php echo $telNo; ?></p>
                            </div>

                        <!-- Confirm Order Button -->
                        <form method="post" action="Confirmed_order.php">
                         <input type="hidden" name="total_price" value="<?php echo $totalPrice; ?>">
                         <input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>">
                         <button type="submit" class="btn btn-success" name="proceed_to_buy">Confirm Order</button>
                        </form>








                    </div>
                </div>
            </div>
            <!-- !subtotal section-->
        </div>
        <!--  !shopping cart items   -->
    </div>
</section>
<!-- !Shopping cart section  -->


<!-- ajhfvkjhasvkffvakhfakhfkahfkhajuvffakhvfkahfahflahflahvflhavflhalfhalfhlahfvlahvsflhavlfhalhfvlfhlhfvalhjv -->


<?php    


    /*  include top sale section */
        include ('Template/_new-phones.php');
    /*  include top sale section */

?>

<?php
// include footer.php file
include ('footer.php');
?>