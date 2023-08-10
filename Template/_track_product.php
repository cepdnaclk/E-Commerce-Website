<?php


$connection = mysqli_connect('localhost', 'root', "", "online_store");

// Check if the connection is successful
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Retrieve orders data using JOIN operations on relevant tables
$query = "
    SELECT
        orders.OrderID,
        orders.OrderDate,
        orders.OrderStatus,
        tracking.trackingID,
        tracking.deliveryCompany,
        customer.CustomerID,
        customer.FirstName,
        customer.LastName,
        customer.AddressL1,
        customer.AddressL2,
        customer.AddressL3,
        customer.PhoneNumber,
        customer.Email
    FROM
        orders
    JOIN
        customer ON orders.CustomerID = customer.CustomerID
    LEFT JOIN
        tracking ON orders.OrderID = tracking.OrderID
    ORDER BY
    orders.OrderDate DESC
";

$result = mysqli_query($connection, $query);

// Fetch the result into an array
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Include your HTML and PHP code for displaying the orders table

// Close the database connection
mysqli_close($connection);


?>

<!DOCTYPE html>
<html>
<head>
    
    <title>Orders Table</title>
    
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.editable').click(function() {
            var cell = $(this);
            var initialValue = cell.text().trim();
            var input = $('<input type="text">').val(initialValue);
            cell.html(input);

            input.focus();
            input.blur(function() {
                var newValue = input.val();
                cell.text(newValue);
                
                var column = cell.data('column');
                var orderId = cell.closest('tr').find('td:first').text();

                console.log('Order ID:', orderId);
              console.log('Column:', column);
             console.log('New Value:', newValue);
                
                $.post('_updateOrderTable.php', { orderId: orderId, column: column, newValue: newValue }, function(response) {

                    if (response.trim() === 'Success') {
                        alert("Updated successfully.");
                    } else if (response.trim() === 'Error') {
                        alert("Error updating order status.");
                    } else {
                        alert("Unknown response: " + response);
                    }
                });
            });
        });
    });
</script>

</head>
<body>
<br>
    <h1 align="center">Orders Table</h1><br>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Customer Address</th>
            <th>Tel No</th>
            <th>Email</th>
            <th class="editable" data-column="OrderStatus">Order Status</th>
            <th class="editable" data-column="trackingID">Tracking ID</th>
            <th class="editable" data-column="deliveryCompany">Delivery Company</th>
        </tr>
        <?php foreach ($orders as $order) { ?>
            <tr>
            
                <td><?php echo $order['OrderID']; ?></td>
                <td><?php echo $order['OrderDate']; ?></td>
                <td><?php echo $order['CustomerID']; ?></td>
                <td><?php echo $order['FirstName']; echo ' '; echo $order['LastName']; ?></td>
                <td><?php echo $order['AddressL1']; echo ' '; echo $order['AddressL2']; echo ' '; echo $order['AddressL3'];       ?></td>
                <td><?php echo $order['PhoneNumber']; ?></td>
                <td><?php echo $order['Email']; ?></td>
                <td class="editable" data-column="OrderStatus"><?php echo $order['OrderStatus']; ?></td>
                <td class="editable" data-column="trackingID"><?php echo $order['trackingID']; ?></td>
                <td class="editable" data-column="deliveryCompany"><?php echo $order['deliveryCompany']; ?></td>
            </tr>
        <?php } ?>
    </table>


</body>
</html>
