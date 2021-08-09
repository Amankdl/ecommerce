<?php
include 'header.php';
if(isset($_GET['id'])){
$msg = "";
$connection = new Database();
$id = get_safe_senatize_value($_GET['id']);
if(!is_numeric($id)){
    ?>
    <script>
    window.location.href = "index.php";
    </script>
    <?php
}
$connection->get("select *, p.id from product p INNER JOIN categories c on p.category_id = c.id where c.status = 1 AND p.status = 1 AND c.id = $id");
$products = $connection->getResult();
//  var_dump($products[0]); die();
if (count($products) == 0) {
    $msg = '<div class="container my-5">
    <h2> Sorry! No Poduct Found.</h2>
    </div>';
} else if (gettype($products[0]) === "string") {
    echo "Error - " . $products[0];
}
}
?>

<div class="body__overlay"></div>
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.html">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Products</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Product Grid -->
<section class="htc__product__grid bg__white ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="htc__product__rightidebar">
                    <?php 
                    if($msg === ""){
                    echo '<div class="htc__grid__top">
                        <div class="htc__select__option">
                            <select class="ht__select">
                                <option>Default softing</option>
                                <option>Sort by popularity</option>
                                <option>Sort by average rating</option>
                                <option>Sort by newness</option>
                            </select>
                        </div>

                        <!-- Start List And Grid View -->
                        <ul class="view__mode" role="tablist">
                            <li role="presentation" class="grid-view active"><a href="#grid-view" role="tab" data-toggle="tab"><i class="zmdi zmdi-grid"></i></a></li>
                            <li role="presentation" class="list-view"><a href="#list-view" role="tab" data-toggle="tab"><i class="zmdi zmdi-view-list"></i></a></li>
                        </ul>
                        <!-- End List And Grid View -->
                    </div>';
                    }
                    ?>
                    <!-- Start Product View -->
                    <div class="row">
                        <div class="shop__grid__view__wrap">
                            <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                <!-- Start Single Product -->
                                <?php
                                foreach ($products as $product) {
                                    echo '<div class="col-md-3 col-lg-3 col-sm-4 col-xs-12">
                                <div class="category">
                                    <div class="ht__cat__thumb">
                                        <a href="product.php?id=' . $product['id'] . '">
                                            <img src="' . IMAGE_PATH . $product['image'] . '" alt="product images">
                                        </a>
                                    </div>
                                    <div class="fr__hover__info">
                                        <ul class="product__action">
                                            <li><a href="wishlist.html"><i class="icon-heart icons"></i></a></li>
                                            <li><a href="cart.html"><i class="icon-handbag icons"></i></a></li>
                                            <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="fr__product__inner">
                                        <h4><a href="product.php?id=' . $product['id'] . '">' . $product['product_name'] . '</a></h4>
                                        <ul class="fr__pro__prize">
                                            <li class="old__prize">' . $product['mrp'] . '&#8377;</li>
                                            <li>' . $product['selling_price'] . '&#8377;</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>';                            
                                }
                                echo $msg;
                                ?>                                
                                <!-- End Single Product -->
                            </div>
                            <div role="tabpanel" id="list-view" class="single-grid-view tab-pane fade clearfix">
                                <div class="col-xs-12">
                                    <div class="ht__list__wrap">
                                        <!-- Start List Product -->
                                        <?php
                                            foreach ($products as $product) {
                                        echo '<div class="ht__list__product">
                                            <div class="ht__list__thumb">
                                                <a href="product-details.html"><img src="' . IMAGE_PATH . $product['image'] . '"></a>
                                            </div>
                                            <div class="htc__list__details">
                                                <h2><a href="product-details.html">' . $product['product_name'] . '</a></h2>
                                                <ul class="pro__prize">
                                                    <li class="old__prize">' . $product['mrp'] . '&#8377;</li>
                                                    <li>' . $product['selling_price'] . '&#8377;</li>
                                                </ul>
                                                <ul class="rating">
                                                    <li><i class="icon-star icons"></i></li>
                                                    <li><i class="icon-star icons"></i></li>
                                                    <li><i class="icon-star icons"></i></li>
                                                    <li class="old"><i class="icon-star icons"></i></li>
                                                    <li class="old"><i class="icon-star icons"></i></li>
                                                </ul>
                                                <p>' . $product['description'] . '</p>
                                                <div class="fr__list__btn">
                                                    <a class="fr__btn" href="cart.html">Add To Cart</a>
                                                </div>
                                            </div>
                                        </div>';
                                        }
                                        ?>
                                        <!-- End List Product -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Product View -->
                </div>

            </div>
        </div>
    </div>
</section>
<!-- End Product Grid -->
<?php include 'footer.php' ?>