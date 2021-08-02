<?php
include "header.php";
include "functions.php";
include "database.php";

$connection = new Database();
$msg = "";
if(isset($_POST['category']) && $_POST['category'] != ""){
    $id = $_GET['id'];
    $category = $_POST['category'];
    $connection->update("categories",["category"=>$category],"id=$id");
    $result = $connection->getResult()[0];
    if($result == 1){        
        header("location:categories.php");
        die();
    }else{
        $msg = $result;
    }
}

if(isset($_GET['id']) && $_GET['id'] != "" && $_GET['category'] && $_GET['category'] != ""){
    $category_name = $_GET['category'];
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Category Edit</strong><small> Form</small></div>
                    <div class="card-body card-block">
                        <form method="POST">
                        <div class="form-group">
                            <label for="category" class=" form-control-label">Category</label>
                            <!-- <input required type="text" name="category" placeholder="Enter your category name" class="form-control" value="<?php /* echo $category_name */?>"> -->
                            <input required type="text" name="category" placeholder="Enter your category name" class="form-control" value="<?php echo isset($_POST['category'])? $category : $category_name  ?>">
                        </div>
                        <button name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                            <span>Submit</span>
                        </button>
                        </form>
                        <?php echo '<p class="mt-3 text-danger">'. $msg .'</p>' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<?php include "footer.php" ?>