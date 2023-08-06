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
                echo "Product Added!";
                // Reload Page
                header("Location: " . $_SERVER['PHP_SELF']);
            }else{
                echo "Error Product Adding.";
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

}
