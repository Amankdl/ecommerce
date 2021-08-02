<?php
include "header.php";
include "functions.php";
include "database.php";

$connection = new Database();
$msg="";
if(isset($_POST['category']) && $_POST['category'] != ""){
    $category = get_safe_senatize_value($_POST['category']); 
    $connection->insert("categories",["category"=>$category, "status"=>1]);
    $result = $connection->getResult()[0];
    if(gettype($result) === "integer"){        
        header("location:categories.php");
        die();
    }else{
        $msg = $result;
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Category</strong><small> Form</small></div>
                    <div class="card-body card-block">
                        <form method="POST">
                        <div class="form-group">
                            <label for="category" class=" form-control-label">Category</label>
                            <input required type="text" name="category" placeholder="Enter your category name" class="form-control">
                        </div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <span id="payment-button-amount">Submit</span>
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