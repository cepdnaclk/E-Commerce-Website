<?php


class SignUp
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
    // insert into cart table
    public  function insertIntoCustomer($params = null, $table = 'customer'){
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
                $query_string = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, implode(',', $formattedValues));

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
    }

    // to get user_id and item_id and insert into cart table
    public  function addCustomer($fname,$lname, $email, $mobile, $address1, $address2, $address3, $password){
        if (isset($fname) && isset($email) && isset($password)){
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $params = array(
                "FirstName" => $fname,
                "LastName" => $lname,
                "Email" => $email,
                "PhoneNumber" =>$mobile,
                "AddressL1" =>$address1,
                "AddressL2" =>$address2,
                "AddressL3" =>$address3,
                "password" =>$hashedPassword


            );

            if(!($this->checkDuplicates($email))){
                // insert data into cart
                $result = $this->insertIntoCustomer($params);
                if ($result){
                    echo "Registration successful!";
                    // Reload Page
                    echo "<script>alert('You Are Registered!'); </script>";
                    header("Location: " . $_SERVER['PHP_SELF']);
                }else{
                    echo "Error registering customer.";
                }
            }else{
                echo "<script>alert('Registration Failed! You Have another Account!'); </script>";
                echo "Registration Failed! You Have another Account!";
            }

        }
    }

    public function checkDuplicates($email,$table='customer'){

        if (isset($email)){
            $quotedEmail = "'".$email."'";
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE Email={$quotedEmail}");
            if ($result->num_rows > 0) {
                return true;
            }else{
                return false;
            }
        }
    }
}
