<?php
include "header.php";
include "database.php";
include "functions.php";

if(!isset($_SESSION['USER_LOGGEDIN']) || $_SESSION['USER_LOGGEDIN'] == ""){
    header("location:login.php");
}
$connection = new Database();

if(isset($_GET['type']) && $_GET['type'] != ""){
    $type = get_safe_senatize_value($_GET['type']); 
    if($type === "delete"){
        $id = get_safe_senatize_value($_GET['id']);
        $connection->delete("contact_us","id=$id");
    }
}

$connection -> select("contact_us","*",null,null,"id DESC");
$queries = $connection -> getResult();

?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title display-4">Queries </h4>                           
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">S.No.</th>
                                       <th>ID</th>
                                       <th>Name</th>
                                       <th>Email</th>
                                       <th>Mobile No.</th>
                                       <th>Query</th>
                                       <th>Added On</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                     $serial_num = 1;
                                     foreach($queries as $query){                                         
                                         echo '<tr>
                                            <td class="serial">'. $serial_num++ .'</td>                                       
                                            <td> '.$query['id'].' </td>
                                            <td> '.$query['name'].' </td>
                                            <td> '.$query['email'].' </td>
                                            <td> '.$query['mobile'].' </td>
                                            <td> '.$query['comment'].' </td>
                                            <td> '.$query['added_on'].' </td>
                                            <td><a href="?type=delete&id='.$query['id'].'"><span class="badge badge-danger">Delete</span></a></td></tr>';
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