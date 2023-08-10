<?php

$resultArr = array();
if (isset($_SESSION['CustomerID'])){

    $resultArr = $UpdateUser ->getCustomerDetails($_SESSION['CustomerID']);

}

// request method post
if($_SERVER['REQUEST_METHOD'] == "POST"){
    //Sign up
    if (isset($_POST['updateSubmit']) && isset($_SESSION['CustomerID'])){

        $UpdateUser->UpdateCustomer(
            $_SESSION['CustomerID'],
            $_POST['updateFName'],
            $_POST['updateLName'],
            $_POST['updatePNum'],
            $_POST['updateAdd1'],
            $_POST['updateAdd2'],
            $_POST['updateAdd3']

        );


    }else{
        echo 'Something Went Wrong!';
    }


}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details Update</title>
    <link rel="stylesheet" href="path/to/bootstrap.css">
    <!-- You might need to adjust the path to the Bootstrap CSS file -->
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>
<div class="container">
    <h1>User Details Update</h1>
    <form method="post">
        <div class="form-group mb-4">
            <label class="form-label" for="updateFName">First Name</label>
            <input type="text" name="updateFName" value="<?php echo $resultArr['FName'] ?? 'Unknown' ?>" id="registerFName" class="form-control" required />
        </div>
        <div class="form-group mb-4">
            <label class="form-label" for="updateLName">Last Name</label>
            <input type="text" name="updateLName" id="registerLName" value="<?php echo $resultArr['LName'] ?? 'Unknown' ?>" class="form-control" />
        </div>
        <!-- Phone Number input -->
        <div class="form-group mb-4">
            <label class="form-label" for="updatePNum">Mobile Number</label>
            <input type="text" name="updatePNum" id="registerPNum" value="<?php echo $resultArr['PNum'] ?? 'Unknown' ?>" class="form-control" required/>

        </div>
        <!-- Address Line1 -->
        <div class="form-group mb-4">
            <label class="form-label" for="updateAdd1">Address Line1</label>
            <input type="text" name="updateAdd1" id="registerAdd1" value="<?php echo $resultArr['Add1'] ?? 'Unknown' ?>" class="form-control" required/>

        </div>
        <!-- Address Line2 -->
        <div class="form-group mb-4">
            <label class="form-label" for="updateAdd2">Address Line2</label>
            <input type="text" name="updateAdd2" id="registerAdd2" value="<?php echo $resultArr['Add2'] ?? 'Unknown' ?>" class="form-control" />

        </div>
        <!-- Address Line2-->
        <div class="form-group mb-4">
            <label class="form-label" for="updateAdd3">Address Line3</label>
            <input type="text" name="updateAdd3" id="registerAdd3" value="<?php echo $resultArr['Add3'] ?? 'Unknown' ?>" class="form-control" />

        </div>


        <button type="submit" name="updateSubmit" class="btn btn-primary btn-block mb-3">Update Details</button>
    </form>
</div>
</body>
</html>
