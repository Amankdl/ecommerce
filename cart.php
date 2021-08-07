<?php 
include 'header.php';
$products = array();
if(isset( $_SESSION['cart'])){
    $cart_products = $_SESSION['cart'];
    $product_keys = array_keys($cart_products);
    if(count($product_keys) > 0){
        $keys  =  implode(",",$product_keys);
        $connection -> get("SELECT * FROM product WHERE id IN ($keys)");
        $products = $connection -> getResult();
    }
}
// die();
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
                                  <span class="breadcrumb-item active">shopping cart</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form action="#">               
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">products</th>
                                            <th class="product-name">name of products</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($products as $product){
                                        $quantity = $cart_products[$product['id']]['qty'];
                                        $image_src = IMAGE_PATH.$product['image'];
                                        echo '<tr>
                                            <td class="product-thumbnail"><a href="#"><img src="'.$image_src.'" alt="product img" /></a></td>
                                            <td class="product-name"><a href="#">'.$product['product_name'].'</a>
                                                <ul  class="pro__prize">
                                                    <li class="old__prize"> &#8377;'.$product['mrp'].'</li>
                                                    <li> &#8377;'.$product['selling_price'].'</li>
                                                </ul>
                                            </td>
                                            <td class="product-price"><span class="amount"> &#8377;'.$product['selling_price'].'</span></td>
                                            <td class="product-quantity"><input type="number" class="mb-5" id="'.$product["id"].'qty" value="'.$quantity.'" />
                                            <br>
                                            <a class="cursor-pointer" href="javascript:void(0)" onclick="manage_cart('.$product["id"].",'update'".')">Update</a>
                                            </td>
                                            <td class="product-subtotal"> &#8377;'.$quantity * $product['selling_price'].'</td>
                                            <td class="product-remove"><a href="javascript:void(0)" onclick="manage_cart('.$product["id"].",'delete'".')"><i class="icon-trash icons"></i></a></td>
                                        </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="buttons-cart--inner">
                                        <div class="buttons-cart">
                                            <a href="index.php">Continue Shopping</a>
                                        </div>
                                        <div class="buttons-cart checkout--btn">
                                            <a href="checkout.php">checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->

<?php include 'footer.php' ?>