<?php
include "header.php";
include "database.php";
include "functions.php";

if(!isset($_SESSION['ADMIN_USER_LOGGEDIN']) || $_SESSION['ADMIN_USER_LOGGEDIN'] == ""){
    header("location:login.php");
    die();
}
$connection = new Database();


$user_id = $_SESSION['USER_ID'];    
$connection -> get("select o.*, s.name as orderStatus from orders o INNER JOIN order_status s where o.order_status = s.id");
$products = $connection -> getResult();

?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title display-4">Orders </h4>                           
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                           <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">Order Id</th>
                                                <th class="product-name"><span class="nobr">Order Date</span></th>
                                                <th class="product-name"><span class="nobr">User ID</span></th>
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
                                                    <td class="product-add-to-cart"><a class="btn btn-sml btn-primary" href="orders_detail_master.php?id='.$product['id'].'">'.$product['id'].'</a></td>
                                                    <td class="product-name"><a href="#">'.$product['added_on'].'</a></td>
                                                    <td class="product-name"><a href="#">'.$product['user_id'].'</a></td>
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
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>
         <div class="clearfix"></div>
<?php include "footer.php" ?>