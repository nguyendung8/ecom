<?php require_once ("inc/header.php")?>
<?php require_once ("inc/nav.php")?>
<?php require_once ("inc/sidebar.php")?>
<?php 
    if (isset($_GET['id']) && $_GET['id'] != "") {
        $id = safe_value($con, $_GET['id']);
        $sql = "Select * From categories where Id = '$id'";
        $result = mysqli_query($con, $sql);

        while($row = mysqli_fetch_assoc($result)) { 
            $id = $row['Id'];
            $cat_name = $row['cat_name'];
            $status = $row['status'];
        }
    }
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="list_category.php">Home</a></li>
              <li class="breadcrumb-item active">Edit Category</li>
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
                <h1 class="card-title">Category</h1>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <?php 
                    update_category();
                    display_message(); 
                ?>
              <form class="form-horizontal" method="post">
                     <input type="hidden" class="form-control" id="inputName" name="id" value="<?php echo $id?>">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Category name</label>
                        <div class="col-sm-10">
                          <input class="form-control" id="inputName" name="category" placeholder="Category name" value="<?php if(!empty($category)) { echo $category; } else {echo $cat_name;} ?>">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button class="btn btn-primary" name="cat_btn_update">Submit</button>
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