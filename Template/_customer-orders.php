<?php
if (session_status() === PHP_SESSION_ACTIVE) {

} else {
    session_start();
}
$resultArray = array();

    if(isset($_SESSION['CustomerID'])){
        $resultArray=$Order->getOrderByCusID($_SESSION['CustomerID']);

}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['delete-cart-submit'])){

        $deletedrecord = $Order->deleteOrder($_POST['order_id'],$_SESSION['CustomerID']);

    }
}

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .order-item {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .order-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-details h5 {
            margin: 0;
        }

        .order-date {
            color: #666;
        }

        .delete-btn {
            background-color: #ff4d4d;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .total-price {
            font-size: 20px;
            color: #ff4d4d;

            align-content: end;

        }
        .order-tracking {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #e0e0e0;
            color: #666;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="col-sm-9">
        <?php
        if (!empty($resultArray)) {
            foreach ($resultArray as $order) {
                $items = $Order->getOrderItms($order['OrderID']);
                ?>

                <div class="order-item">
                    <div class="order-details">
                        <h5>Order ID:<?php echo $order['OrderID'] ?? 'Unknown'; ?></h5>
                        <span class="order-date">Date: <?php echo $order['OrderDate'] ?? 'Unknown'; ?></span>

                    </div>

                    <?php
                    if (!empty($items)) {
                        foreach ($items as $item) {
                            $productID = $item['ProductID'];
                            $prodItms = $product->getProduct($productID);
                            echo '<p>'.$prodItms[0]['ProductName'].' (Qty: '.$item['OrderQty'].')</p>';
                        }
                    }
                    ?>

                    <div class="order-details">

                        <span class="total-price">Total: $ <?php echo $order['OrderTotal'] ?? 0; ?></span>
                        <form method="post">
                            <input name="order_id" value="<?php echo $order['OrderID'] ?? 0; ?>" hidden>
                            <button type="submit" name="delete-cart-submit" class="delete-btn">Delete</button>
                        </form>
                    </div>



                    <div class="order-tracking">
                        <?php
                        $trakingInf = $Order ->getTraking($order['OrderID']);
                        if (!empty($trakingInf)){
                            $id = $trakingInf['trackingID'];
                            $company = $trakingInf['deliveryCompany'];
                            echo '<p>Tracking Number: '.$id.'</p>';
                            echo '<p>Delivery Company: '.$company.'</p>';
                        }

                        ?>
                        <p>Order Status: <?php echo $order['OrderStatus'] ?? 'Unknown'; ?></p>
                    </div>
                </div>

                <?php
            }
        } else {
            echo '<p>Empty Order List</p>';
        }
        ?>
    </div>
</div>
</body>
</html>
