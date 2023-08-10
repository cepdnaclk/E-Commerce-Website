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

    <script>
        $(document).ready(function() {
            $('.nav-link').click(function() {
                $('.nav-link').removeClass('bold-link'); // Remove the class from all links
                $(this).addClass('bold-link'); // Add the class to the clicked link
            });
        });
    </script>

    <style>
        .nav-item.active a {
            font-weight: bold;
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

                        $isActiveModifyItems= (basename($_SERVER['PHP_SELF']) == 'modifyItemsSelect.php') ? 'active' : '';
                        echo '<li class="nav-item'.$isActiveModifyItems.' ">
                            <a class="nav-link" href="modifyItemsSelect.php">Modify Items</a>
                        </li>';

                        $isActiveModifyItems= (basename($_SERVER['PHP_SELF']) == 'tracking.php') ? 'active' : '';
                        echo '<li class="nav-item'.$isActiveModifyItems.' ">
                            <a class="nav-link" href="tracking.php">Orders</a>
                        </li>';
                    }

                ?>

            </ul>
            <form action="#" class="font-size-14 font-rale">
                <a href="cart.php" class="py-2 rounded-pill color-primary-bg">
                    <span class="font-size-16 px-2 text-white"><i class="fas fa-shopping-cart"></i></span>
                </a>
                <a href="sign-in.php" class="px-3 text-dark">Login</a>

                <a href="log-out.php" class="px-3 border-left text-dark">Log Out</a>
            </form>
        </div>
    </nav>
    <!-- !Primary Navigation -->

</header>
<!-- !start #header -->

<!-- start #main-site -->
<main id="main-site">
