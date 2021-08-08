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
        $connection -> update("categories",["status" => $status],"id=$id");
    }

    if($type === "delete"){
        $id = get_safe_senatize_value($_GET['id']);
        $connection->delete("categories","id=$id");
    }
}

$connection -> select("categories","*",null,null,"category ASC");
$categories = $connection -> getResult();

?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title display-4">Categories </h4>
                           <a class="btn btn-sm btn-primary mt-3" href="add_category.php">Add Category</a>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">S.No.</th>
                                       <th>ID</th>
                                       <th>Category</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                     $serial_num = 1;
                                     foreach($categories as $category){                                         
                                         echo '<tr>
                                            <td class="serial">'. $serial_num++ .'</td>                                       
                                            <td> '.$category['id'].' </td>
                                            <td> '.$category['category'].' </td>
                                            <td> ';
                                            if($category['status'] == 1){
                                                echo "<a href='?type=status&operation=deactive&id=".$category['id']."'><span class=\"badge badge-success\">Active</span> &nbsp</a>";
                                            }else{
                                                echo "<a href='?type=status&operation=active&id=".$category['id']."'><span class=\"badge badge-danger\">Deactive</span> &nbsp</a>";
                                            }
                                            echo "
                                            <a href='manage_category.php?category=".$category['category']."&id=".$category['id']."'><span class=\"badge badge-primary\">Edit</span>&nbsp</a>
                                            <a href='?type=delete&id=".$category['id']."'><span class=\"badge badge-secondary\">Delete</span></a></td></tr>";
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