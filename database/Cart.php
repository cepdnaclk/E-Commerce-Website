<?php

// php cart class
class Cart
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    // insert into cart table
    public  function insertIntoCart($params = null, $table = "cart_items"){
        if ($this->db->con != null){
            if ($params != null){
                // "Insert into cart(user_id) values (0)"
                // get table columns
                $columns = implode(',', array_keys($params));

                $values = implode(',' , array_values($params));

                // create sql query
                $query_string = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);

                // execute query
                $result = $this->db->con->query($query_string);
                return $result;
            }
        }
    }
    public function getCart($CartID = null, $table= 'cart_items'){
        if (isset($CartID)){
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE CartID={$CartID}");
            $resultArray = array();

            // fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }
            return $resultArray;
        }
    }
    // to get user_id and item_id and insert into cart table
    public  function addToCart($userid, $itemid,$qty,$price){
        if (isset($userid) && isset($itemid)){
            $CartID = $this->makeCart($userid);
            $params = array(
                "CartID" => $CartID,
                "ProductID" => $itemid,
                "Qty" => $qty,
                "Price" => $price
            );

            // insert data into cart
            $result = $this->insertIntoCart($params);
            if ($result){
                // Reload Page
                header("Location: " . $_SERVER['PHP_SELF']);
            }else{
                echo 'Something went wrong!';
            }
        }
    }

    //create cart and add data to cart Items
    public function makeCart($CustomerID,$table='cart')
    {
        if (isset($CustomerID)) {
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE CustomerID={$CustomerID}");
            if ($result->num_rows>0) {
                $row = $result->fetch_assoc();
                return $row['CartID'];

            } else {
                $seg = $this->db->con->query("INSERT INTO {$table} (CustomerID) VALUES ({$CustomerID})");

                if ($seg) {
                    $row = $seg->fetch_assoc();
                    return $row['CartID'];

                } else {
                    echo 'Something Went Wrong!';
                }
            }

        }
        return '1';
    }




    // delete cart item using cart item id
    public function deleteCart($item_id = null, $CartID, $table = 'cart_items'){
        if($item_id != null){
            $result = $this->db->con->query("DELETE FROM {$table} WHERE ProductID={$item_id} AND CartID={$CartID}");
            if($result){
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

    // calculate sub total
    public function getSum($arr){
        if(isset($arr)){
            $sum = 0;
            foreach ($arr as $item){
                $sum += floatval($item[0]);
            }
            return sprintf('%.2f' , $sum);
        }
    }

    // get item_it of shopping cart list
    public function getCartId($cartArray = null, $key = "CustomerID"){
        if ($cartArray != null){
            $cart_id = array_map(function ($value) use($key){
                return $value[$key];
            }, $cartArray);
            return $cart_id;
        }
    }

    // Save for later
    public function saveForLater($item_id = null, $saveTable = "wishlist", $fromTable = "cart"){
        if ($item_id != null){
            $query = "INSERT INTO {$saveTable} SELECT * FROM {$fromTable} WHERE item_id={$item_id};";
            $query .= "DELETE FROM {$fromTable} WHERE item_id={$item_id};";

            // execute multiple query
            $result = $this->db->con->multi_query($query);

            if($result){
                header("Location :" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }


}
