<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modifyProduct'])) {
    // Get the total price from the form data
    
    $selectedProductID = $_POST['selectedProduct'] ?? null;


 }

 // Delete product
 elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteProduct'])) {
    $selectedProductID = $_POST['selectedProduct'];
    
    $connection = mysqli_connect('localhost', 'root', "", "online_store");


    if ($selectedProductID) {
    // Get the product's information from the database
    $sql = "DELETE FROM product WHERE ProductID = $selectedProductID;";
    $result = mysqli_query($connection, $sql);
    
    
    // Check if the statement was executed successfully
    if ($result) {
        // Display the success message
        echo '<div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #dff0d8; border-color: #d0e9c6; padding: 10px; text-align: center; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); font-size: 20px;" id="successMessage">Product Deleted successfully!</div>';


        // Redirect back to the modify/delete form after deletion
        // Wait for 3 seconds (1500 milliseconds) before redirecting
        echo '<script>
            setTimeout(function() {
                window.location.href = "./modifyItemsSelect.php";
            }, 1500);
        </script>';
        
        exit();
    } else {
        echo '<div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #dff0d8; border-color: #d0e9c6; padding: 10px; text-align: center; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); font-size: 20px;" id="errorsMessage">Error Deleting Product</div>';


        // Redirect back to the modify/delete form after deletion
        // Wait for 3 seconds (1500 milliseconds) before redirecting
        echo '<script>
            setTimeout(function() {
                window.location.href = "./modifyItemsSelect.php";
            }, 1500);
        </script>';
        
        exit();
    }
    
}}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $selectedCategory = $_POST['ProductCategory'] ?? '6';
    if (isset($_POST['updateProduct'])){
        $product ->updateProduct($_POST['ProductID'] ,$_POST['ProductName'],$selectedCategory,$_POST['ProductPrice'],$_POST['ProductQty'],$_POST['ProductImage'],$_POST['ProductDetails']);
    }

}

$connection = mysqli_connect('localhost', 'root', "", "online_store");


if ($selectedProductID) {
    // Get the product's information from the database
    $sql = "SELECT * FROM product WHERE ProductID = {$selectedProductID}";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $productx = mysqli_fetch_assoc($result);

        $ProductName = $productx['ProductName'];
        $ProductCategory = $productx['ProductCatagory'];
        $ProductPrice = $productx['ProductPrice'];
        $ProductQty = $productx['ProductQty'];
        $ProductImage = $productx['ProductImage'];
        $ProductDetails = $productx['ProductDetails'];
    }
}



?>
<!-- Modify Product Form -->
<div class="container mt-5">
    <h2>Modify Product Details</h2><br>
    <form method="POST">
        <div class="form-group">
            <label for="productID">Product ID</label>
            <input type="number" class="form-control" id="productID" name="ProductID" readonly value="<?php echo $selectedProductID; ?>">
        </div>
        <div class="form-group">
            <label for="productName">Product Name</label>
            <input type="text" class="form-control" id="productName" name="ProductName" value="<?php echo $ProductName; ?>" required>
        </div>

       
        <div class="form-group">
            <label for="productCategory">Product Category</label>
            <select class="form-control" id="productCategory" name="ProductCategory" required>
                <?php
                // Replace this with your actual function call to fetch categories
                $categories = $product->getData('category'); 

                foreach ($categories as $category) {
                    echo '<option value="' . $category['CategoryID'] . '" ' . ($ProductCategory == $category['CategoryID'] ? 'selected' : '') . '>' . $category['CategoryName'] . '</option>';

                }
                //echo '<input type="number" name="categoryID" value="' . $category['CategoryID'] . '"hidden >';

                ?>
            </select>

        </div>
        
        <div class="form-group">
            <label for="productPrice">Product Price</label>
            <input type="number" class="form-control" id="productPrice" name="ProductPrice" step="0.01" value="<?php echo $ProductPrice; ?>" required>
        </div>
        <div class="form-group">
            <label for="productQty">Product Quantity</label>
            <input type="number" class="form-control" id="productQty" name="ProductQty" value="<?php echo $ProductQty; ?>" required>
        </div>
        <div class="form-group">
            <label for="productImage">Product Image</label>
            <input type="text" class="form-control-file" id="productImage" name="ProductImage" value="<?php echo $ProductImage; ?>" required>
        </div>
        <div class="form-group">
            <label for="productDetails">Product Details</label>
            <textarea class="form-control" id="productDetails" name="ProductDetails" rows="3" required><?php echo $ProductDetails; ?></textarea>
        </div>
      
        <button type="submit" name="updateProduct" class="btn btn-primary">Update Details</button>

           
    </form>
</div>


<?php

?>

