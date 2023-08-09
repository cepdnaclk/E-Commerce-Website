<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electro Mart</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Owl-carousel CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

    <!-- Custom CSS file -->
    <link rel="stylesheet" href="style.css">
    <script src="header.js"></script>
    <style>
        .nav-item.active a {
            font-weight: bold;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Style for the dropdown content */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        /* Style for dropdown links */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Highlight dropdown links on hover */
        .dropdown-content a:hover {
            background-color: rgba(34, 131, 198, 0);
        }

        /* Show dropdown content when hovering over the dropdown container */
        .dropdown:hover .dropdown-content {
            display: block;
        }

    </style>
    <?php
    // require functions.php file
    require ('functions.php');

    ?>


</head>
<body>

<!-- start #header -->
<header id="header">

    <!-- Primary Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark color-second-bg">
        <a class="navbar-brand" href="#">Electro Mart</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto font-rubik">
                <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">Category</a>
                </li>
                <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'all-Product.php') ? 'active' : ''; ?>">
                    <a class="nav-link " href="all-Product.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Category <i class="fas fa-chevron-down"></i></a>
                </li>
                <?php

                    session_start();
                    if (isset($_SESSION['AdminID'])&& $_SESSION['AdminID'] != '0' && isset($_SESSION['AdminID'])) {
                        $isActiveAddItems= (basename($_SERVER['PHP_SELF']) == 'addItems.php') ? 'active' : '';
                        echo '<li class="nav-item'.$isActiveAddItems.' ">
                            <a class="nav-link" href="addItems.php">Add Items</a>
                        </li>';
                    }

                ?>
            <li>
                <div class="input-group" style="margin-left: 20px">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search Products">
                    <input id="productID" hidden>
                    <ul id="autocompleteResults" class="dropdown-menu" ></ul>
                    <div class="input-group-append">
                        <button class="btn btn-secondary" id="searchButton" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </li>

            </ul>
            <form action="#" class="font-size-14 font-rale">
                <a href="cart.php" class="py-2 rounded-pill color-primary-bg">
                    <span class="font-size-16 px-2 text-white"><i class="fas fa-shopping-cart"></i></span>
                </a>
                <div class="dropdown">

                <?php
                if(isset($_SESSION['CustomerID'])){
                    $name = $SignIn->getCustomerName($_SESSION['CustomerID']);
                    echo '<a href="sign-in.php" class="px-3 text-dark dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hi! '.$name.'</a>';
                }else{
                    echo '<a href="sign-in.php" class="px-3 text-dark">Login</a>';
                }
                ?>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="account.php">My Account</a>
                        <a class="dropdown-item" href="orders.php">My Orders</a>
                    </div>
                </div>
                <a href="log-out.php" class="px-3 border-left text-dark">Log Out</a>
            </form>
        </div>
    </nav>
    <!-- !Primary Navigation -->


</header>
<!-- !start #header -->

<!-- start #main-site -->
<main id="main-site">
