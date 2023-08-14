<?php
$searchedItms = array();
if (session_status() === PHP_SESSION_ACTIVE) {

} else {
    session_start();
}
if (isset($_SESSION['matchingProducts'])) {
    // Retrieve matchingProducts from session
    $matchingProducts = $_SESSION['matchingProducts'];

    // Clear the session variable (optional)
    unset($_SESSION['matchingProducts']);

    //Ser all results to $searchedItms
    foreach ($matchingProducts as $itm){
        $result = $product->getProduct($itm['id']);
        $searchedItms[] = $result[0];
    }
}else{
    // Redirect to No found
    header("Location: Template/notFound/_searchItem_notFound.php");
    exit();
}


?>
<section id="top-sale">
    <div class="container py-5">
        <h4 class="font-rubik font-size-20">Your Result</h4>
        <hr>

        <div class="owl-carousel owl-theme">
            <?php foreach ($searchedItms as $item) { ?>
                <div class="item py-2">
                    <div class="product font-rale">
                        <a href="<?php printf('%s?ProductID=%s', 'product.php',  $item['ProductID']); ?>"><img src="<?php echo $item['ProductImage'] ?? "./assets/products/1.png"; ?>" alt="product1" class="img-fluid" style="max-width: 200px; height: 200px;"></a>
                        <div class="text-center">
                            <h6><?php echo  $item['ProductName'] ?? "Unknown";  ?></h6>

                            <div class="price py-2">
                                <span>$<?php echo $item['ProductPrice'] ?? '0' ; ?></span>
                            </div>
                            <form method="post">
                                <input type="hidden" name="item_id" value="<?php echo $item['ProductID'] ?? '1'; ?>">
                                <input type="hidden" name="user_id" value="<?php echo 1; ?>">
                                <button type="button" onclick="window.location.href='<?php printf('product.php?ProductID=%s', $item['ProductID']); ?>'" class="btn btn-warning font-size-12">View</button>

                            </form>
                        </div>
                    </div>
                </div>
            <?php } // closing foreach function ?>
        </div>

    </div>
</section>
