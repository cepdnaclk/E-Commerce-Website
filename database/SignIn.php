<?php


class SignIn
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) {
            echo 'Database connection not available.';
            return null;
        }
        $this->db = $db;
    }

    public function Login($email,$password,$table='customer'){


        if (isset($email)&&isset($password)){
            $quotedEmail = "'".$email."'";
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE Email={$quotedEmail}");


            if ($result->num_rows > 0) {
                 $row = $result->fetch_assoc();
                 $hashedPassword = $row['password'];
                 $CustomerID =$row['CustomerID'];

                if (password_verify($password, $hashedPassword)) {
                    session_start();
                    $_SESSION['CustomerID'] = $CustomerID;
                    $this->checkUserType($CustomerID);
/*
                     if (isset($_SESSION['customer_id'])) {
                    $customerId = $_SESSION['customer_id'];
                     // Now you can use $customerId in your code
                    } else {
                     // Customer ID not set, handle accordingly (e.g., redirect to login page)
                     }*/


                    echo "Login Success!";
                    header("Location: index.php");
                    exit();

                } else {
                    echo "Password Not Correct Please Try Again!";
                    return false;
                }
            } else {
                echo "No user found with the provided email.";
                return false;
            }
        }

    }

    public function checkUserType($customerID,$table='admin'){
        if(isset($customerID)){
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE CustomerID={$customerID}");
            $AdminID = '0';

            if ($result->num_rows>0){
                $AdminID=$customerID;
                $_SESSION['AdminID'] = $AdminID ;
                echo "Admin ID:{$AdminID}";
                return true;
            }else{
                $_SESSION['AdminID'] = $AdminID ;
                echo "Admin ID:{$AdminID}";
                return false;
            }
        }
    }

}

