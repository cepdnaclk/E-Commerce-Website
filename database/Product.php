<?php

// Use to fetch product data
class Product
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    // fetch product data using getData Method
    public function getData($table = 'product'){
        $result = $this->db->con->query("SELECT * FROM {$table}");

        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }
    // fetch product data using getData Method
    public function getProductId($CartID,$table = 'product'){
        $result = $this->db->con->query("SELECT * FROM {$table} WHERE CartID = {$CartID}");

        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){

            $resultArray[] = $item;

        }

        return $resultArray;
    }

    // get product using item id
    public function getProduct($item_id = null, $table= 'product'){
        if (isset($item_id)){
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE ProductID={$item_id}");
            $resultArray = array();

            // fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }
            return $resultArray;
        }
    }

    // to get product details
    public  function addProduct($name, $category,$price,$qty,$img,$details){
        if (isset($name) && isset($price)&& isset($category) && isset($qty)){
            $params = array(
                "ProductName" => $name,
                "ProductCatagory" => $category,
                "ProductPrice" => $price,
                "ProductQty" => $qty,
                "ProductImage" => $img,
                "ProductDetails" => $details
            );


            $result = $this->insertIntoProduct($params);
            if ($result){
                echo '<script>alert("Product Added successfully!");</script>';
                // Reload Page
                header("Location: " . $_SERVER['PHP_SELF']);
            }else{
                echo '<script>alert("Error Product Adding.");</script>';
            }
        }
    }
    // insert into product table
    public  function insertIntoProduct($params = null, $table = 'product'){
        if ($this->db->con != null){
            if ($params != null){
                // "Insert into cart(user_id) values (0)"
                // get table columns
                $columns = implode(',', array_keys($params));

                 $formattedValues = array_map(function($value) {
                    return is_string($value) ? "'" . $this->db->con->real_escape_string($value) . "'" : $value;
                }, array_values($params));

                $values = implode(',', $formattedValues);
                // create sql query
                $query_string = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);

                // execute query
                $result = $this->db->con->query($query_string);
                return $result;
            }
        }
    }

    // get category
    public function getCategory($CategoryID,$table = 'category'){
        $result = $this->db->con->query("SELECT * FROM {$table} WHERE CategoryID={$CategoryID}");
        $result = $result->fetch_assoc();
        return $result['CategoryName'];
    }




    public function updateProduct($productID, $productName, $productCategory, $productPrice, $productQty, $productImage, $productDetails) {
        // Create a connection to the database
    
        $conn = mysqli_connect('localhost', 'root', "", "online_store");
        // Check if the connection was successful
        if ($conn === false) {
            die("Error connecting to database: " . mysqli_connect_error());
        }
    
        // Prepare the UPDATE statement
        $sql = "UPDATE product SET
            ProductName = ?,
            ProductCatagory = ?,
            ProductPrice = ?,
            ProductQty = ?,
            ProductImage = ?,
            ProductDetails = ?
            WHERE ProductID = ?";
    
        // Create a prepared statement
        $stmt = mysqli_prepare($conn, $sql);
    
        // Bind the parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "siidssi", $productName, $productCategory, $productPrice, $productQty, $productImage, $productDetails, $productID);
    
        // Execute the prepared statement
        $result = mysqli_stmt_execute($stmt);
    
        // Check if the statement was executed successfully
        if ($result) {
            // Display the success message
            echo '<div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #dff0d8; border-color: #d0e9c6; padding: 10px; text-align: center; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); font-size: 20px;" id="successMessage">Product updated successfully!</div>';
    
            
            // Wait for 3 seconds (1500 milliseconds) before redirecting
            echo '<script>
                setTimeout(function() {
                    window.location.href = "./modifyItemsSelect.php";
                }, 1500);
            </script>';
            
            exit();
        } else {
            echo '<div class="alert alert-danger">Error updating product</div>';
        }
        
        
    
        // Close the prepared statement
        mysqli_stmt_close($stmt);
    
        // Close the database connection
        mysqli_close($conn);
    }

}
