<?php

// require MySQL Connection
require ('database/DBController.php');

// require Product Class
require ('database/Product.php');

// require Cart Class
require ('database/Cart.php');

//require sign in and sign up class
require ('database/SignUp.php');
require ('database/SignIn.php');

//require Order Class
require ('database/Orders.php');

// DBController object
$db = new DBController();

// Product object
$product = new Product($db);
$product_shuffle = $product->getData();

// Cart object
$Cart = new Cart($db);

// Signup Object
$SignUp = new SignUp($db);

//Sign in object
$SignIn = new SignIn($db);

//Order Object
$Order = new Orders($db);
