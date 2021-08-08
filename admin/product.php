<?php
include "header.php";
include "database.php";
include "functions.php";

if(!isset($_SESSION['ADMIN_USER_LOGGEDIN']) || $_SESSION['ADMIN_USER_LOGGEDIN'] == ""){
    header("location:login.php");
    die();
}
$connection = new Database();

if(isset($_GET['type']) && $_GET['type'] != ""){
    $type = get_safe_senatize_value($_GET['type']);
    if($type === "status"){
        $id = get_safe_senatize_value($_GET['id']);
        $status;
        $operation = get_safe_senatize_value($_GET['operation']);
        if($operation === "active"){
            $status = '1';
        }else{
            $status = '0';
        }
        $connection -> update("product",["status" => $status],"id=$id");
    }

    if($type === "delete"){
        $id = get_safe_senatize_value($_GET['id']);
        $connection->delete("product","id=$id");
    }
}

$connection -> get("SELECT p.*,c.category from product p INNER JOIN categories c ON p.category_id = c.id");
$products = $connection -> getResult();
?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title display-4">Products </h4>
                           <a class="btn btn-sm btn-primary mt-3" href="add_product.php">Add Product</a>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">S.No</th>
                                       <th>ID</th>
                                       <th></th>
                                       <th>Category</th>
                                       <th>Name</th>
                                       <th>MRP</th>
                                       <th>Selling price</th>
                                       <th>Qty</th>                                       
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                     $serial_num = 1;
                                     foreach($products as $product){                                         
                                         echo '<tr>
                                            <td class="serial">'. $serial_num++ .'</td>                                       
                                            <td> '.$product['id'].' </td>
                                            <td> <img src="../media/product/'.$product['image'].'"> </td>
                                            <td> '.$product['category'].' </td>
                                            <td> '.$product['product_name'].' </td>
                                            <td> '.$product['mrp'].' </td>
                                            <td> '.$product['selling_price'].' </td>
                                            <td> '.$product['qty'].' </td>
                                            <td> ';
                                            if($product['status'] == 1){
                                                echo "<a href='?type=status&operation=deactive&id=".$product['id']."'><span class=\"badge badge-success\">Active</span> &nbsp</a>";
                                            }else{
                                                echo "<a href='?type=status&operation=active&id=".$product['id']."'><span class=\"badge badge-danger\">Deactive</span> &nbsp</a>";
                                            }
                                            echo "
                                            <a href='manage_product.php?id=".$product['id']."'><span class=\"badge badge-primary\">Edit</span>&nbsp</a>
                                            <a href='?type=delete&id=".$product['id']."'><span class=\"badge badge-secondary\">Delete</span></a></td></tr>";
                                     }
                                    ?>                                    
                                 </tbody>
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