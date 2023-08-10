

<!-- Modify Product Form -->
<div class="container mt-5">
    <br><br>
    <h2>Modify Product</h2>
    <br>
    <form method="POST" action="modifyItems.php">
        <div class="form-group">
            <label for="selectedProduct">Select Product to Modify</label><br>
            <select class="form-control" id="selectedProduct" name="selectedProduct" required>
                <?php
                $products = $product->getData('product'); 
                // Same product fetching code as before
                foreach ($products as $product) {
                    echo '<option value="' . $product['ProductID'] . '">' . $product['ProductName'] . '</option>';
                }
                ?>
            </select>
        </div><br>
        
        <button type="submit" name="modifyProduct" class="btn btn-primary">Modify Product</button>
        <button type="submit" name="deleteProduct" class="btn btn-danger">Delete Product</button>
        
        <br><br>
    </form>
</div>