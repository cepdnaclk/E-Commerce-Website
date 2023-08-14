<?php


class UpdateUser
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) {
            echo "<script>console.error('Database connection not available.');</script>";
            return null;
        }
        $this->db = $db;
    }

   /* public  function insertIntoCustomer($params = null, $table = 'customer'){
        if ($this->db->con != null){
            if ($params != null){
                // "Insert into cart(user_id) values (0)"
                // get table columns
                $columns = implode(',', array_keys($params));

                $values = implode(',' , array_values($params));

                // create sql query
                // Prepare values for insertion, adding single quotes for strings
                $formattedValues = array_map(function($value) {
                    return is_string($value) ? "'" . $this->db->con->real_escape_string($value) . "'" : $value;
                }, array_values($params));

                // Create sql query
                $query_string = sprintf("UPDATE %s SET %s WHERE CustomerID = %d", $table, $columns, implode(',', $formattedValues));

                // execute query
                $result = $this->db->con->query($query_string);
                if($result){
                    echo "<script>console.log('Data inserted into $table table.');</script>";
                }else{
                    echo "<script>console.error('Error inserting data into $table table: " . $this->db->con->error . "');</script>";
                }
                return $result;
            }
        }
    }*/
    public function updateCustomerTable($params = null, $table = 'customer') {
        if ($this->db->con != null) {
            if ($params != null) {
                // Create SET part of the query
                $setValues = array();
                foreach ($params as $column => $value) {
                    if (is_string($value)) {
                        $setValues[] = "$column = '" . $this->db->con->real_escape_string($value) . "'";
                    } else {
                        $setValues[] = "$column = $value";
                    }
                }

                // Construct the WHERE condition using the CustomerID
                $customerId = isset($params['CustomerID']) ? $params['CustomerID'] : 0; // Assuming 0 as default
                $whereCondition = "CustomerID = $customerId";

                // Construct the complete UPDATE query
                $updateQuery = sprintf("UPDATE %s SET %s WHERE %s", $table, implode(', ', $setValues), $whereCondition);

                // Execute the query
                $result = $this->db->con->query($updateQuery);

                return $result;
            }
        }
    }


    // to get user_id and item_id and insert into cart table
    public  function UpdateCustomer($userid,$fname,$lname, $mobile, $address1, $address2, $address3){
        if (isset($fname) && isset($userid) && isset($address1)){

            $params = array(
                "CustomerID"=>$userid,
                "FirstName" => $fname,
                "LastName" => $lname,
                "PhoneNumber" =>$mobile,
                "AddressL1" =>$address1,
                "AddressL2" =>$address2,
                "AddressL3" =>$address3



            );

            $result = $this->updateCustomerTable($params);
            if ($result){
                echo "Update successful!";
                    // Reload Page
                echo "<script>alert('Data updated successfully.'); window.location.href='index.php';</script>";
                }else{
                    echo "Error Updating customer.";
                }

        }
    }

    public function getCustomerDetails($CustomerID){
        if(isset($CustomerID)){
            $result = $this->db->con->query("SELECT * FROM customer WHERE CustomerID={$CustomerID}");

            if ($result->num_rows>0){
                $row = $result->fetch_assoc();
                $resultArr = array(
                  "FName" => $row['FirstName'],
                  "LName" => $row['LastName'],
                  "PNum" =>  $row['PhoneNumber'],
                   "Add1" => $row['AddressL1'],
                    "Add2" => $row['AddressL2'],
                    "Add3" => $row['AddressL3']
                );
                return $resultArr;
            }else{

                return null;
            }
        }
    }

}
