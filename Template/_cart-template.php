<!-- Shopping cart section  -->
<?php

    if (session_status() === PHP_SESSION_ACTIVE) {

    } else {
        session_start();
    }
    // Find cart Id belongs to current customer
    $CartID = 0;
    $resultArray = array();
    $resultArray=$product->getData('cart');
    foreach ($resultArray as $item) {
        if($item['CustomerID'] === $_SESSION['CustomerID']){
            $CartID = $item['CartID'];
        }
    }

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['delete-cart-submit'])){
        $deletedrecord = $Cart->deleteCart($_POST['item_id'],$CartID);
    }

    // save for later
    if (isset($_POST['wishlist-submit'])){
        $Cart->saveForLater($_POST['ProductID']);
    }
}
?>

<section id="cart" class="py-3 mb-5">
    <div class="container-fluid w-75">
        <h5 class="font-baloo font-size-20">Shopping Cart</h5>

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
                                <!--<button class="qty-up border bg-light" data-id="<?php /*echo $item['ProductID'] ?? '0'; */?>"><i class="fas fa-angle-up"></i></button>-->
                                <input type="text" data-id="<?php echo $cart['Qty'] ?? '0'; ?>" class="qty_input border px-2 w-100 bg-light" disabled value="1" placeholder="1">
                                <!--<button data-id="<?php /*echo $item['ProductID'] ?? '0'; */?>" class="qty-down border bg-light"><i class="fas fa-angle-down"></i></button>-->
                            </div>

                            <form method="post">
                                <input type="hidden" value="<?php echo $item['ProductID'] ?? 0; ?>" name="item_id">
                                <button type="submit" name="delete-cart-submit" class="btn font-baloo text-danger px-3 border-right border-left">Delete</button>
                            </form>

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
                        <h5 class="font-baloo font-size-20">Subtotal<span class="text-danger">$<span class="text-danger" id="deal-price"><?php echo $totalPrice ?></span> </span> </h5>
                        <button type="submit" class="btn btn-warning mt-3">Proceed to Buy</button>
                    </div>
                </div>
            </div>
            <!-- !subtotal section-->
        </div>
        <!--  !shopping cart items   -->
    </div>
</section>
<!-- !Shopping cart section  -->
