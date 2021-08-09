<?php
include "header.php";
include "functions.php";
include "database.php";
include "constants.php";

$connection = new Database();
$msg = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $connection -> select("product","*","id=$id");
    $product = $connection -> getResult(); 
    if(count($product) > 0){
        $product = $product[0];
    }else{
        header("location:product.php");
    }
    $category_id = $product['category_id'];
    $product_name = $product['product_name'];
    $mrp = $product['mrp'];
    $selling_price = $product['selling_price'];
    $qty = $product['qty'];
    $bestseller = $product['bestseller'];
    $short_desc = $product['short_desc'];
    $description = $product['description'];
    $meta_title = $product['meta_title'];
    $meta_desc = $product['meta_desc'];
    $meta_keyword = $product['meta_keyword'];    
}

if(isset($_POST['submit'])){
    $id = $_GET['id'];
    $category_id = $_POST['category_id'];
    $product_name = $_POST['product_name'];
    $mrp = $_POST['mrp'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $bestseller = $_POST['bestseller'];
    $short_desc = $_POST['short_desc'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_desc = $_POST['meta_desc'];
    $meta_keyword = $_POST['meta_keyword'];  
    
    if($_FILES['image']['name'] != ''){
        $image = rand(111111111,9999999999).'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
        $colums = [
            "category_id" => $category_id, "product_name" => $product_name,
            "mrp" => $mrp, "image"=>  $image,
            "selling_price" => $selling_price, "qty" => $qty, "bestseller" => $bestseller, "short_desc" => $short_desc, "description" => $description,
            "status" => 1, "meta_title" => $meta_title, "meta_desc" => $meta_desc, "meta_keyword" => $meta_keyword
        ];
    }else{
        $colums = [
            "category_id" => $category_id, "product_name" => $product_name,
            "mrp" => $mrp,
            "selling_price" => $selling_price, "qty" => $qty, "bestseller" => $bestseller, "short_desc" => $short_desc, "description" => $description,
            "status" => 1, "meta_title" => $meta_title, "meta_desc" => $meta_desc, "meta_keyword" => $meta_keyword
        ];
    }

    $connection -> update('product', $colums, "id=$id");
    $result = $connection->getResult()[0];
    if($result == 1){        
        header("location:product.php");
        die();
    }else{
        $msg = $result;
    }
}

$connection->select('categories', "id, category");
$categories = $connection->getResult();
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Product</strong><small> Form</small></div>
                    <div class="card-body card-block">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Category</label>
                                <select required name="category_id" id="category_id" class="form-control mb-3">
                                    <option selected disabled value="0">Select Category</option>
                                    <?php
                                    foreach ($categories as $category) {
                                        if($category_id == $category['id']){
                                            echo '<option selected value="' . $category['id'] . '">' . $category['category'] . '</option>';
                                        }else{
                                            echo '<option value="' . $category['id'] . '">' . $category['category'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="product_name" class=" form-control-label">Product Name</label>
                                <input required value="<?php echo $product_name ?>" type="text" name="product_name" placeholder="Enter your name name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="mrp" class=" form-control-label">MRP</label>
                                <input required value="<?php echo $mrp ?>" type="text" name="mrp" placeholder="Enter MRP" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="selling_price" class=" form-control-label">Selling Price</label>
                                <input required type="text" value="<?php echo $selling_price ?>" name="selling_price" placeholder="Enter selling price" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="qty" class=" form-control-label">Quantity</label>
                                <input required type="text" value="<?php echo $qty ?>" name="qty" placeholder="Enter Quantity" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="bestseller" class=" form-control-label">Bestseller</label>
                                <select name="bestseller" id="bestseller" class="form-control">
                                    <option <?php echo $bestseller == 1 ? "selected" : "" ?> value="1">Yes</option>
                                    <option <?php echo $bestseller == 0 ? "selected" : "" ?> value="0">No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="short_desc" class=" form-control-label">Short Description</label>
                                <textarea required type="text" name="short_desc" placeholder="Enter Short description" class="form-control"><?php echo $short_desc ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="description" class=" form-control-label">Description</label>
                                <textarea required name="description" placeholder="Enter Description" class="form-control"><?php echo $description ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="meta_title" class=" form-control-label">Meta Title</label>
                                <textarea required name="meta_title" placeholder="Enter Meta title" class="form-control"><?php echo $meta_title ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="meta_desc" class=" form-control-label">Meta Description</label>
                                <textarea required name="meta_desc" placeholder="Enter Meta description" class="form-control"><?php echo $meta_desc ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="meta_keyword" class=" form-control-label">Meta Keyword</label>
                                <textarea required name="meta_keyword" placeholder="Enter Meta keyword" class="form-control"><?php echo $meta_keyword ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="image" class=" form-control-label">Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>
                        </form>
                        <?php echo '<p class="mt-3 text-danger">' . $msg . '</p>' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<?php include "footer.php" ?>