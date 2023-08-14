<!-- Special Price -->
<?php
$brand = array_map(function ($pro){ return $pro['ProductCatagory']; }, $product_shuffle);
$unique = array_unique($brand);
sort($unique);
shuffle($product_shuffle);
/*
// request method post
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if (isset($_POST['special_price_submit'])){
        // call method addToCart
        session_start();
        $Cart->addToCart($_SESSION['CustomerID'], $_POST['ProductID']);
    }
}*/
$item_category = $_GET['category'] ?? 1;

$in_cart = $Cart->getCartId($product->getData('cart'));

?>

<section id="special-price">
    <div class="container">
        <div id="filters" class="button-group text-right font-baloo font-size-16">
           
            <?php
            
            array_map(function ($brand) use ($product){
                
                
                
                //printf('<button hidden class="btn is-checked" data-filter=".%s" ></button>', $item_category);
            }, $unique);
            ?>
            
        </div>

        <div class="grid">
            <?php array_map(function ($item) use($product, $in_cart){ 
                $item_category = $_GET['category'] ?? 1;
                if ($item['ProductCatagory'] == $item_category) {?>
                <div class="grid-item border <?php echo $item['ProductCatagory']?? "Brand"; ?>">
                    <div class="item py-2" style="width: 200px;">
                        <div class="product font-rale">
                            <a href="<?php printf('%s?ProductID=%s', 'product.php',  $item['ProductID']); ?>"><img src="<?php echo $item['ProductImage'] ?? "./assets/products/13.png"; ?>" alt="product1" class="img-fluid" style="max-width: 200px; height: 200px;"></a>
                            <div class="text-center">
                                <h6><?php echo $item['ProductName'] ?? "Unknown"; ?></h6>
                                <!--<div class="rating text-warning font-size-12">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>
                                </div>-->
                                <div class="price py-2">
                                    <span>Rs<?php echo $item['ProductPrice'] ?? 0 ?></span>
                                </div>
                                <form method="post">
                                    <input type="hidden" name="item_id" value="<?php echo $item['ProductID'] ?? '1'; ?>">
                                    <input type="hidden" name="user_id" value="<?php echo 1; ?>">
                                    <button type="button" onclick="window.location.href='<?php printf('product.php?ProductID=%s', $item['ProductID']); ?>'" class="btn btn-warning font-size-12">View</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
                }
        }, $product_shuffle) ?>
        </div>
    </div>
</section>
<!-- !Special Price -->
