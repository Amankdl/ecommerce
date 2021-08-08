<?php
include "header.php";
include "database.php";
include "functions.php";
include "constants.php";

if (!isset($_SESSION['ADMIN_USER_LOGGEDIN']) || $_SESSION['ADMIN_USER_LOGGEDIN'] == "") {
    header("location:login.php");
}

if(isset($_GET['id'])){
    $order_id = $_GET['id'];
}
else{
   ?>
    <script>
        location.href = "index.php";
    </script>
   <?php
}
$connection = new Database();
$connection->get("SELECT p.image, p.product_name, o.*, oo.order_status, oo.house_num, oo.street_address, oo.city, oo.pincode, oo.mobile, oo.email FROM orders oo INNER JOIN `order_detail` o INNER JOIN product p ON o.product_id = p.id and oo.id = o.order_id where o.order_id = $order_id");
$products = $connection->getResult();
$connection -> select("order_status","*");
$status_list = $connection->getResult();
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title display-4">Order Details</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
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
                                                    <td class="product-name"><span class="nobr">' . $product['order_id'] . '</span></td>
                                                    <td class="product-thumbnail"><a href="#"><img src="../media/product/'.$product['image'].'" alt="" /></a></td>
                                                    <td class="product-name"><a href="#">' . $product['product_name'] . '</a></td>
                                                    <td class="product-name"><a href="#">' . $product['qty'] . '</a></td>
                                                    <td class="product-name"><a href="#">&#8377;' . $product['price'] . '</a></td>
                                                    <td class="product-name"><a href="#">&#8377;' . $product['price']  * $product['qty'] . '</a></td>
                                                </tr>';
                                    }
                                    echo '<tr>
                                            <td colspan="4"></td>
                                            <td>Total</td>
                                            <td>&#8377;' . $total_amount . '</td>
                                            </tr>';
                                    ?>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                        <div class='card-body'>
                            <p><strong>ADDRESS : </strong><?php echo $products[0]['house_num'].","?></p>
                            <p><?php echo $products[0]['street_address'].", ".$products[0]['city']?></p>
                            <p><?php echo $products[0]['pincode'].", ".$products[0]['mobile']?></p>
                            <p><?php echo $products[0]['email']?></p>
                        </div>
                        <div>
                            <span class="ml-4"><strong>Order Status</strong></span>
                            <select name="order_status" id="order_status" class="status-select ml-4 mb-4" onchange="update_order_status(<?php echo $order_id ?>)">
                            <?php
                                foreach($status_list as $status){
                                    if($products[0]['order_status'] == $status['id']){
                                        echo '<option selected value="'.$status['id'].'">'.$status['name'].'</option>';
                                    }else{
                                        echo '<option value="'.$status['id'].'">'.$status['name'].'</option>';
                                    }
                                }
                            ?>                            
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<?php include "footer.php" ?>