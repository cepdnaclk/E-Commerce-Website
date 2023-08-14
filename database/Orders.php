<?php


class Orders
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }
    public function getOrderByCusID($CustomerID = null, $table= 'orders'){
        if (isset($CustomerID)){

            $result = $this->db->con->query("SELECT * FROM {$table} WHERE CustomerID={$CustomerID} ORDER BY OrderID DESC");
          
            $resultArray = array();

            // fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }
            return $resultArray;
        }
    }

    public function getOrderItms($OrderID = null, $table= 'order_item'){
        if (isset($OrderID)){
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE OrderID={$OrderID}");
            $resultArray = array();

            // fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }
            return $resultArray;
        }
    }

    // delete cart item using cart item id

    public function deleteOrder($OrderID = null,$CustomerID, $table = 'orders'){
        if($OrderID!= null){
            $result = $this->db->con->query("DELETE FROM {$table} WHERE CustomerID={$CustomerID} AND OrderID={$OrderID}");

            if($result){
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

    public function getTraking($OrderID = null, $table= 'tracking'){
        if (isset($OrderID)){
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE OrderID={$OrderID}");

            $row = $result->fetch_assoc();
            return $row;
        }
    }



}
