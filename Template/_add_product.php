<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $selectedCategory = $_POST['ProductCategory'] ?? '6';
    if (isset($_POST['addProduct'])){
        $product ->addProduct($_POST['ProductName'],$selectedCategory,$_POST['ProductPrice'],$_POST['ProductQty'],$_POST['ProductImage'],$_POST['ProductDetails']);
    }

}

?>
<!-- Add Product Form -->
<div class="container mt-5">
    <h2>Add New Product</h2>
    <form method="POST">
        <div class="form-group">
            <label for="productName">Product Name</label>
            <input type="text" class="form-control" id="productName" name="ProductName" required>
        </div>
        <div class="form-group">
            <label for="productCategory">Product Category</label>
            <select class="form-control" id="productCategory" name="ProductCategory" required>
                <?php
                // Replace this with your actual function call to fetch categories
                $categories = $product->getData('category'); // Assuming the table name is 'categories'

                foreach ($categories as $category) {
                    echo '<option value="' . $category['CategoryID'] . '">' . $category['CategoryName'] . '</option>';

                }
                //echo '<input type="number" name="categoryID" value="' . $category['CategoryID'] . '"hidden >';

                ?>
            </select>

        </div>
        <div class="form-group">
            <label for="productPrice">Product Price</label>
            <input type="number" class="form-control" id="productPrice" name="ProductPrice" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="productQty">Product Quantity</label>
            <input type="number" class="form-control" id="productQty" name="ProductQty" required>
        </div>
        <div class="form-group">
            <label for="productImage">Product Image</label>
            <input type="text" class="form-control-file" id="productImage" name="ProductImage" required>
        </div>
        <div class="form-group">
            <label for="productDetails">Product Details</label>
            <textarea class="form-control" id="productDetails" name="ProductDetails" rows="3" required></textarea>
        </div>
        <button type="submit" name="addProduct" class="btn btn-primary">Add Product</button>
    </form>
</div>
