<?php 
include "header.php"; 
if(!isset($_SESSION['USER_LOGGEDIN'])){
    ?>
    <script>
        window.location.href = "index.php";
    </script>
    <?php
}else{
    $user_id = $_SESSION['USER_ID'];    
    $connection -> get("select o.*, s.name as orderStatus from orders o INNER JOIN order_status s where o.user_id = $user_id and o.order_status = s.id ORDER BY added_on desc");
    $products = $connection -> getResult();
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
                                  <span class="breadcrumb-item active">Wishlist</span>
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
                                                <th class="product-name"><span class="nobr">Order Date</span></th>
                                                <th class="product-price"><span class="nobr"> User Address </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Payement Type </span></th>
                                                <th class="product-add-to-cart"><span class="nobr">Payment Status</span></th>
                                                <th class="product-add-to-cart"><span class="nobr">Order Status</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($products as $product) {
                                                $address = $product['house_num'].', '.$product['street_address'].', '.$product['city'].', '.$product['pincode'];
                                                echo '<tr>
                                                    <td class="product-add-to-cart"><a href="my_orders_detail.php?id='.$product['id'].'">'.$product['id'].'</a></td>
                                                    <td class="product-name"><a href="#">'.$product['added_on'].'</a></td>
                                                    <td class="product-name"><a href="#">'.$address.'</a></td>
                                                    <td class="product-name"><a href="#">'.$product['payment_type'].'</a></td>
                                                    <td class="product-name"><a href="#">'.$product['payment_status'].'</a></td>
                                                    <td class="product-price"><span class="amount">'.$product['orderStatus'].'</span></td>
                                                </tr>';
                                            }
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