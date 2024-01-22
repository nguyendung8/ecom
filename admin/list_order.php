<?php require_once ("inc/header.php")?>
<?php require_once ("inc/nav.php")?>
<?php require_once ("inc/sidebar.php")?>
<?php 
  $value = view_orders();

  if(isset($_GET['status'])) {
    $order_id = $_GET['id'];
    if($_GET['status'] == 'daxacnhan') {
      $status = 'Đã xác nhận';
    } else {
      $status = 'Hoàn thành';
    }
    update_status_order($order_id, $status);
  }
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="list_category.php">Home</a></li>
              <li class="breadcrumb-item active">Order</li>
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
                <h1 class="card-title">List order</h1>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Method</th>
                    <th>Address</th>
                    <th>Note</th>
                    <th>Total Price</th>
                    <th>Operations</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    while($row = mysqli_fetch_assoc($value)) {
                  ?>
                  <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['number']; ?></td>
                    <td><?php echo $row['method']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['note']; ?></td>
                    <td>$<?php echo $row['total_price']; ?></td>
                    <td class="text-center">
                      <select onchange="redirectToPage(this.value)">
                      <?php if($row['status'] == 'Chờ xác nhận') { ?>
                        <option>
                            Chờ xác nhận
                        </option>
                        <option value="?id=<?php echo $row['id']; ?>&status=daxacnhan">
                            Đã xác nhận
                        </option>
                        <option value="?id=<?php echo $row['id']; ?>&status=hoanthanh">
                            Hoàn thành
                        </option>
                        <?php } else if($row['status'] == 'Đã xác nhận') { ?>
                        <option value="?id=<?php echo $row['id']; ?>&status=daxacnhan">
                            Đã xác nhận
                        </option>
                        <option value="?id=<?php echo $row['id']; ?>&status=hoanthanh">
                            Hoàn thành
                        </option>
                        <?php } else { ?>
                          <option value="?id=<?php echo $row['id']; ?>&status=hoanthanh">
                            Hoàn thành
                        </option>
                        <?php } ?>
                      </select>
                      <?php if($row['status'] == 'Chờ xác nhận' || $row['status'] == 'Hoàn thành') { ?>
                      <a class="btn btn-danger btn-sm" href="delete_order.php?id=<?php echo $row['id'] ?>">
                          <i class="fas fa-trash">
                          </i>
                          Delete
                      </a>
                      <?php }?>
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
<script>
   function redirectToPage(url) {
        if (url) {
            window.location.href = url;
        }
    }
</script>
<?php require_once ("inc/footer.php")?>