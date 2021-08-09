<?php
include 'database.php';
include 'constants.php';
session_start();
$connection = new Database();
$connection->select("categories", "id,category", "status=1", null, "category asc", null, 8);
$categories = $connection->getResult();

if (count($categories) == 0) {
    echo "No categories";
} else if (gettype($categories[0]) === "string") {
    echo "Error - " . $categories[0];
}

if (isset($_SESSION['USER_LOGGEDIN'])) {
    $user_id = $_SESSION['USER_ID'];
    $connection->get("SELECT COUNT(id) FROM wishlist WHERE user_id = $user_id");
    $wishlist_count = $connection->getResult();
    $wishlist_count = $wishlist_count[0]['COUNT(id)'];
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>My eCommerce</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <!-- <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"> -->
    <link rel="apple-touch-icon" href="apple-touch-icon.png">


    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Owl Carousel min css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">


    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <!-- Start Header Style -->
        <header id="htc__header" class="htc__header__area header--one">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
                                <div class="logo">
                                    <a href="index.php"><img src="images/logo/4.png" alt="logo images"></a>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-6 col-sm-5 col-xs-3">
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <li class="drop"><a href="index.php">Home</a></li>
                                        <?php
                                        foreach ($categories as $category) {
                                            echo '<li><a href="categories.php?id=' . $category['id'] . '">' . $category['category'] . '</a></li>';
                                        }
                                        ?>
                                        <li><a href="contact.php">contact</a></li>
                                    </ul>
                                </nav>
                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li><a href="index.html">Home</a></li>
                                            <?php
                                            foreach ($categories as $category) {
                                                echo '<li><a href="categories.php?id=' . $category['id'] . '">' . $category['category'] . '</a></li>';
                                            }
                                            ?>
                                            <li><a href="contact.php">contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-4 col-sm-4 col-xs-4">
                                <div class="header__right">
                                    <div class="header__search search search__open">
                                        <a href="#"><i class="icon-magnifier icons"></i></a>
                                    </div>
                                    <div class="header__account">
                                        <!-- <a href="#"><i class="icon-user icons"></i></a> -->
                                        <?php
                                        if (isset($_SESSION['USER_LOGGEDIN'])) {
                                            echo '<a href="my_orders.php">My Order</a>
                                                <a href="logout.php">Logout</a>';
                                        } else {
                                            echo '<a href="login.php">Register/Login</a>';
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if (isset($_SESSION['USER_LOGGEDIN'])) {
                                        echo '<div class="htc__shopping__cart mr-20">
                                        <a class="cart__menu" href="#"><i class="icon-heart icons"></i></a>
                                        <a href="wishlist.php"><span class="htc__wishlist">';
                                        echo $wishlist_count . '</span></a></div>';
                                    }
                                    ?>
                                    <div class="htc__shopping__cart">
                                        <a class="cart__menu" href="#"><i class="icon-handbag icons"></i></a>
                                        <a href="cart.php"><span class="htc__qua">
                                                <?php
                                                if (isset($_SESSION['cart'])) {
                                                    echo count($_SESSION['cart']);
                                                } else {
                                                    echo 0;
                                                }
                                                ?></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <!-- End Header Area -->

        <div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <!-- Start Search Popap -->
            <div class="search__area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search__inner">
                                <form action="search.php" method="get">
                                    <input name="keyword" placeholder="Search here... " type="text">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Search Popap -->
        </div>