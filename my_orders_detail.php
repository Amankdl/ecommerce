<?php 
include "header.php"; 
if(!isset($_SESSION['USER_LOGGEDIN'])){
    ?>
    <script>
        window.location.href = "index.php";
    </script>
    <?php
}

if(isset($_GET['id'])){
    $order_id = $_GET['id'];
    $user_id = $_SESSION['USER_ID'];
}
$connection -> get("SELECT p.image,p.product_name,o.* FROM orders oo INNER JOIN `order_detail` o INNER JOIN product p ON o.product_id = p.id and oo.id = o.order_id where o.order_id = $order_id and oo.user_id = $user_id");
$products = $connection -> getResult();
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
                                  <span class="breadcrumb-item active">Order Details</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- wishlist-area start -->
        <div class="wishlist-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">Order Id</th>
                                                <th class="product-name"><span class="nobr">Product Image</span></th>
                                                <th class="product-price"><span class="nobr">Product Name</span></th>
                                                <th class="product-add-to-cart"><span class="nobr">Quantity</span></th>
                                                <th class="product-stock-stauts"><span class="nobr">Price</span></th>
                                                <th class="product-add-to-cart"><span class="nobr">Total Price</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total_amount = 0;
                                            foreach ($products as $product) {
                                                $total_amount += ($product['price']  * $product['qty']);
                                                echo '<tr>
                                                    <td class="product-name"><span class="nobr">'.$product['order_id'].'</span></td>
                                                    <td class="product-thumbnail"><a href="#"><img src="'.IMAGE_PATH . $product['image'].'" alt="" /></a></td>
                                                    <td class="product-name"><a href="#">'.$product['product_name'].'</a></td>
                                                    <td class="product-name"><a href="#">'.$product['qty'].'</a></td>
                                                    <td class="product-name"><a href="#">&#8377;'.$product['price'].'</a></td>
                                                    <td class="product-name"><a href="#">&#8377;'.$product['price']  * $product['qty'].'</a></td>
                                                </tr>';
                                            }
                                            echo '<tr>
                                            <td colspan="4"></td>
                                            <td>Total</td>
                                            <td>&#8377;'.$total_amount.'</td>
                                            </tr>';
                                            ?>
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- wishlist-area end -->
<?php include "footer.php"; ?>