<?php require_once ("inc/header.php")?>
<?php require_once ("inc/nav.php")?>
<?php require_once ("inc/sidebar.php")?>
<?php 
  $value = contact();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Contact</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="list_category.php">Home</a></li>
              <li class="breadcrumb-item active">Contact</li>
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
                <h1 class="card-title">List Contact</h1>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Contact ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Information</th>
                    <th width="20%">Operations</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    while($row = mysqli_fetch_assoc($value)) {
                  ?>
                  <tr>
                    <td><?php echo $row['Id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['subject']; ?></td>
                    <td><?php echo $row['message']; ?></td>
                    <td class="text-center">
                      <!-- <a class="btn btn-info btn-sm" href="edit_category.php?id=<?php echo $row['Id'] ?>">
                          <i class="fas fa-pencil-alt">
                          </i>
                          Edit
                      </a> -->
                      <a class="btn btn-danger btn-sm" href="delete_contact.php?id=<?php echo $row['Id'] ?>">
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