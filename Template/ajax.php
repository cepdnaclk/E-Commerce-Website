<?php

// require MySQL Connection
require ('../database/DBController.php');

// require Product Class
require ('../database/Product.php');

// DBController object
$db = new DBController();

// Product object
$product = new Product($db);

/*if (isset($_POST['itemid'])){
    $result = $product->getProduct($_POST['itemid']);
    echo json_encode($result);
}*/


/*$Products = array(
    "Apple iPhone 12",
    "Samsung Galaxy S21",
    "Google Pixel 5",
    "Sony PlayStation 5",
    "Dell XPS 13",
    "HP Spectre x360"
);*/
$result = $product->getData();

$Products = array();
foreach ($result as $itm){
    $Products[] = array(
        'id' => $itm['ProductID'],
        'name' => $itm['ProductName']
    );

}

if (isset($_GET['query'])){
    $searchTerm = $_GET['query'];

    $matchingProducts = array();
    foreach ($Products as $product) {
        if (stripos($product['name'], $searchTerm) !== false) {
            $matchingProducts[] = $product;
        }
    }

    echo json_encode($matchingProducts);
    //pass data through session
    if (session_status() === PHP_SESSION_ACTIVE) {

    } else {
        session_start();
    }
    $_SESSION['matchingProducts'] = $matchingProducts;

}
