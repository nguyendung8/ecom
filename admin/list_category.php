<?php require_once ("inc/header.php")?>
<?php require_once ("inc/nav.php")?>
<?php require_once ("inc/sidebar.php")?>
<?php 
  $value = view_category();
  active_status();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="list_category.php">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
                <h1 class="card-title">List category</h1>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Status</th>
                    <th width="20%">Operations</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    while($row = mysqli_fetch_assoc($value)) {
                  ?>
                  <tr>
                    <td><?php echo $row['Id']; ?></td>
                    <td><?php echo $row['cat_name']; ?></td>
                    <td>
                      <?php 
                        if ($row['status'] == '1') {
                          echo '<span class="text-success">Active</span>'; 
                        }
                        else {
                          echo '<span class="text-warning">Inactive</span>'; 
                        }
                      ?>
                    </td>
                    <td class="text-center">
                      <?php 
                        if ($row['status'] == '1') {
                          echo '<a class="btn btn-warning btn-sm" href="list_category.php?opr=inactive&id='.$row['Id'].'">
                                    <i class="far fa-times-circle"></i>
                                    </i>
                                    Inactive
                                </a>';
                        }
                        else {
                          echo '<a class="btn btn-success btn-sm" href="list_category.php?opr=active&id='.$row['Id'].'">
                                    <i class="far fa-check-circle"></i>
                                    </i>
                                    Active
                                </a>';
                        }
                      ?>
                      <a class="btn btn-info btn-sm" href="edit_category.php?id=<?php echo $row['Id'] ?>">
                          <i class="fas fa-pencil-alt">
                          </i>
                          Edit
                      </a>
                      <a class="btn btn-danger btn-sm" href="delete_category.php?id=<?php echo $row['Id'] ?>">
                          <i class="fas fa-trash">
                          </i>
                          Delete
                      </a>
                    </td>
                  </tr>
                  <?php 
                    }
                  ?>
                  
                  
                  </tbody>
                </table>
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