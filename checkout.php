<?php
include 'header.php';
include 'functions.php';
$products = array();
$total_amount = 0;
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
?>
    <script>
        window.location.href = "index.php";
    </script>
<?php
} else {    
    $cart_products = $_SESSION['cart'];
    $product_keys = array_keys($cart_products);
    if (count($product_keys) > 0) {
        $keys  =  implode(",", $product_keys);
        $connection->get("SELECT * FROM product WHERE id IN ($keys)");
        $products = $connection->getResult();

        foreach ($products as $product) {
            $quantity = $cart_products[$product['id']]['qty'];
            $total_amount += ($product['selling_price'] * $quantity);
        }
    }
}

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['USER_ID'];
    $house_num = get_safe_senatize_value($_POST['house_num']);
    $street_address = get_safe_senatize_value($_POST['street-address']);
    $city = get_safe_senatize_value($_POST['city']);
    $pincode = get_safe_senatize_value($_POST['pincode']);
    $email = get_safe_senatize_value($_POST['email']);
    $mobile = get_safe_senatize_value($_POST['mobile']);
    $payment_type = get_safe_senatize_value($_POST['payment_type']);
    $payment_status = $payment_type === "cod" ? "success" : "pending";
    $order_status = 1;


    $connection->insert('orders', [
        'user_id' => $user_id, 'house_num' => $house_num, 'street_address' => $street_address,
        'city' => $city, 'pincode' => $pincode, 'email' => $email,
        'mobile' => $mobile, 'payment_type' => $payment_type, 'payment_status' => $payment_status, 
        'order_status' => $order_status, 'total_price' => $total_amount
    ]);

    $result = $connection->getResult();
    if(gettype($result[0]) === "integer"){
        $order_id = $result[0];
        foreach ($products as $product) {
            $connection -> insert('order_detail',['order_id' => $order_id, 'product_id' => $product['id'],
            'qty' => $cart_products[$product['id']]['qty'], 'price' => $product['selling_price']]);
        }
        $is_inserted = $connection -> getResult();
        if(gettype($is_inserted[0]) === "integer"){
            unset($_SESSION["cart"]);
            ?>
                <script>
                    location.href = 'thankyou.php';
                </script>
            <?php
        }else{
            echo "Error - ".$result[0];
        }
    }else{
        echo "Error - ".$result[0];   
    }
}
?>
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
                            <span class="breadcrumb-item active">checkout</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="checkout-wrap ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout__inner">
                    <div class="accordion-list">
                        <div class="accordion">
                            <?php
                            if (!isset($_SESSION['USER_LOGGEDIN'])) {
                                echo '<div class="accordion__title text-danger">
                                    Please Login To Checkout
                                </div>
                                <div class="accordion__body">
                                <div class="accordion__body__form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="checkout-method__login">
                                                <form action="#">
                                                    <h5 class="checkout-method__title">Login</h5>
                                                    <div class="single-input">
                                                        <input type="email" name="login_email" id="login_email" placeholder="Email">
                                                    </div>
                                                    <div class="single-input">
                                                        <input type="password" name="login_pass" id="login_pass" placeholder="Password">
                                                    </div>
                                                    <div class="dark-btn">
                                                        <a href="javascript:void(0)" onclick="login_user(' . "'checkout'" . ')">LogIn</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-method__login">
                                                <form action="#">
                                                    <h5 class="checkout-method__title">Register</h5>
                                                    <div class="single-input">
                                                    <input type="text" required name="name" id="name" placeholder="Name">
                                                    </div>
                                                    <div class="single-input">
                                                    <input type="text" required name="email" id="email" placeholder="Email">
                                                    </div>
                                                    <div class="single-input">
                                                    <input type="text" required name="mobile" id="mobile" placeholder="Mobile">
                                                    </div>
                                                    <div class="single-input">
                                                    <input type="password" required name="password" id="password" placeholder="Password">
                                                    </div>
                                                    <div class="dark-btn">
                                                        <a href="javascript:void(0)" onclick="register()">Register</a>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            } else {
                                echo '<div class="accordion__title">
                                Address Information
                            </div>
                            <div class="accordion__body">
                            <form method="post">
                                <div class="bilinfo">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <input required name="street-address" type="text" placeholder="Street Address">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <input required name="house_num" type="text" placeholder="Apartment/Block/House (optional)">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input required name="city" type="text" placeholder="City/State">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input required name="pincode" type="text" placeholder="Post code/ zip">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input required name="email" type="email" placeholder="Email address">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input required name="mobile" type="text" placeholder="Mobile number">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="accordion__title">
                                payment information
                            </div>
                            <div class="accordion__body">
                                <div class="paymentinfo">
                                    <div class="single-method">
                                    <input type="radio" required name="payment_type" id="payment-mode-cod" value="cod"><span class="ml-5px">Cash On Delivery</span></input><br>
                                    <input type="radio" required name="payment_type" checked id="payment-mode-payu" value="payu"><span class="ml-5px">PayU</span></input>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" name="submit" class="fr__btn mt-25">
                            </form>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="order-details">
                    <h5 class="order-details__title">Your Order</h5>
                    <div class="order-details__item">
                        <?php
                        foreach ($products as $product) {
                            $quantity = $cart_products[$product['id']]['qty'];
                            $image_src = IMAGE_PATH . $product['image'];
                            echo '<div class="single-item">
                                    <div class="single-item__thumb">
                                        <img src="' . $image_src . '" alt="ordered item">
                                    </div>
                                    <div class="single-item__content">
                                        <a href="#">' . $product['product_name'] . '</a>
                                        <span class="price">&#8377;' . $product['selling_price'] . ' * ' . $quantity . ' Qty</span>
                                    </div>
                                    <div class="single-item__remove">
                                        <a href="javascript:void(0)" onclick="manage_cart(' . $product["id"] . ",'delete'" . ')"><i class="zmdi zmdi-delete"></i></a>
                                    </div>
                                </div>';
                        }
                        ?>
                    </div>
                    <div class="ordre-details__total">
                        <h5>Order total</h5>
                        <span class="price"><?php echo '&#8377; ' . $total_amount ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area end -->
<?php include 'footer.php' ?>