<?php require_once ("inc/header.php")?>
<?php require_once ("inc/nav.php")?>
<?php require_once ("inc/sidebar.php")?>
<?php 
    if (isset($_GET['id']) && $_GET['id'] != "") {
        $id = safe_value($con, $_GET['id']);
        $sql = "Select * From products where Id = '$id'";
        $result = mysqli_query($con, $sql);

        while($row = mysqli_fetch_assoc($result)) { 
            $id = $row['Id'];
            $category_id = $row['category_id'];
            $product_name = $row['product_name'];
            $MRP = $row['MRP'];
            $price = $row['price'];
            $qty = $row['qty'];
            $img = $row['img'];
            $description = $row['description'];
            $status = $row['status'];
        }
    }
    $cat = view_category();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="list_product.php">Home</a></li>
              <li class="breadcrumb-item active">Edit Product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h1 class="card-title">Product</h1>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <?php 
                    update_product();
                    display_message(); 
                ?>
               <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="inputName" name="id" value="<?php echo $id?>">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="category_id">
                                <option value="0">Select Category</option>
                                <?php
                                    while($row = mysqli_fetch_assoc($cat)) {
                                        if ($category_id == $row['Id']) { 
                                ?>
                                  
                                            <option selected value="<?php echo $row['Id']?>"><?php echo $row['cat_name']?></option>
                                <?php 
                                        }
                                        else {
                                ?>
                                             <option value="<?php echo $row['Id']?>"><?php echo $row['cat_name']?></option>
                                <?php
                                        }    
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Product name</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="inputName" name="product_name" required value="<?php echo $product_name?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">MRP</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputName" name="MRP" required value="<?php echo $MRP?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputName" name="price" required value="<?php echo $price?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-10">
                            <input  type="number" class="form-control" id="inputName" name="qty" required value="<?php echo $qty?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <img width="120" height="120" src="../admin/img/<?php echo $img; ?>">
                            <input type="file" class="form-control" id="inputName" name="img">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" cols="30" rows="4" id="inputName" name="description" required><?php echo $description?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button class="btn btn-primary" name="pro_btn_update">Submit</button>
                        </div>
                    </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?php require_once ("inc/footer.php")?>