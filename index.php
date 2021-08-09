<?php 
include 'header.php';
$connection = new Database();
$connection->select("product", "id, product_name, mrp, selling_price, image", "status=1", null, "id desc", null, 8);
$new_arrivals = $connection->getResult();
$connection->select("product", "id, product_name, mrp, selling_price, image", "bestseller=1 AND status=1", null, "id desc", null, 8);
$bestsellers = $connection->getResult();
// var_dump($new_arrivals);
if (count($new_arrivals) == 0) {
    echo "No categories";
} else if (gettype($new_arrivals[0]) === "string") {
    echo "Error - " . $new_arrivals[0];
}
?>

<div class="body__overlay"></div>        
        <!-- Start Slider Area -->
        <div class="slider__container slider--one bg__cat--3">
            <div class="slide__container slider__activation__wrap owl-carousel">
                <!-- Start Single Slide -->
                <div class="single__slide animation__style01 slider__fixed--height">
                    <div class="container">
                        <div class="row align-items__center">
                            <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                                <div class="slide">
                                    <div class="slider__inner">
                                        <h2>collection 2018</h2>
                                        <h1>NICE CHAIR</h1>
                                        <div class="cr__btn">
                                            <a href="cart.html">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5">
                                <div class="slide__thumb">
                                    <img src="images/slider/fornt-img/1.png" alt="slider images">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Slide -->
                <!-- Start Single Slide -->
                <div class="single__slide animation__style01 slider__fixed--height">
                    <div class="container">
                        <div class="row align-items__center">
                            <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                                <div class="slide">
                                    <div class="slider__inner">
                                        <h2>collection 2018</h2>
                                        <h1>NICE CHAIR</h1>
                                        <div class="cr__btn">
                                            <a href="cart.html">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5">
                                <div class="slide__thumb">
                                    <img src="images/slider/fornt-img/2.png" alt="slider images">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Slide -->
            </div>
        </div>
        <!-- Start Slider Area -->
        <!-- Start Category Area -->
        <section class="htc__category__area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">New Arrivals</h2>
                            <p>But I must explain to you how all this mistaken idea</p>
                        </div>
                    </div>
                </div>
                <div class="htc__product__container">
                    <div class="row">
                        <div class="product__list clearfix mt--30">
                            <!-- Start Single Category -->
                            <?php 
                            foreach($new_arrivals as $new_arrival){ 
                            echo '<div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                <div class="category">
                                    <div class="ht__cat__thumb">
                                        <a href="product.php?id='.$new_arrival['id'].'">
                                            <img src="'.IMAGE_PATH.$new_arrival['image'].'" alt="product images">
                                        </a>
                                    </div>
                                    <div class="fr__hover__info">
                                        <ul class="product__action">
                                            <li><a href="javascript:void(0)" onclick="manage_wishlist('. $new_arrival['id'] .',\'add\')"><i class="icon-heart icons"></i></a></li>
                                            <li><a href="javascript:void(0)" onclick="manage_cart('. $new_arrival['id'] .',\'add\')"><i class="icon-handbag icons"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="fr__product__inner">
                                        <h4><a href="product.php?id='.$new_arrival['id'].'">'.$new_arrival['product_name'].'</a></h4>
                                        <ul class="fr__pro__prize">
                                            <li class="old__prize">'.$new_arrival['mrp'].'&#8377;</li>
                                            <li>'.$new_arrival['selling_price'].'&#8377;</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>';
                            }
                            ?>
                            <!-- End Single Category -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Category Area -->
        <!-- Start Product Area -->
        <section class="ftr__product__area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">Best Seller</h2>
                            <p>But I must explain to you how all this mistaken idea</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="product__wrap clearfix">
                        <!-- Start Single Category -->
                        <?php 
                            foreach($bestsellers as $bestseller){ 
                            echo '<div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                <div class="category">
                                    <div class="ht__cat__thumb">
                                        <a href="product.php?id='.$bestseller['id'].'">
                                            <img src="'.IMAGE_PATH.$bestseller['image'].'" alt="product images">
                                        </a>
                                    </div>
                                    <div class="fr__hover__info">
                                        <ul class="product__action">
                                            <li><a href="javascript:void(0)" onclick="manage_wishlist('. $bestseller['id'] .',\'add\')"><i class="icon-heart icons"></i></a></li>
                                            <li><a href="javascript:void(0)" onclick="manage_cart('. $bestseller['id'] .',\'add\')"><i class="icon-handbag icons"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="fr__product__inner">
                                        <h4><a href="product.php?id='.$bestseller['id'].'">'.$bestseller['product_name'].'</a></h4>
                                        <ul class="fr__pro__prize">
                                            <li class="old__prize">'.$bestseller['mrp'].'&#8377;</li>
                                            <li>'.$bestseller['selling_price'].'&#8377;</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>';
                            }
                        ?>
                        <!-- End Single Category -->
                    </div>
                </div>
            </div>
        </section>
        <!-- End Product Area -->

<?php include 'footer.php' ?>