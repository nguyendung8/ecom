<?php
   include 'config.php';
   session_start();
   error_reporting(0);

   if(isset($_SESSION['USER_ID'])) {
      $user_id = $_SESSION['USER_ID']; //tạo session người dùng
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đơn hàng</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <style>
      .title {
         text-align: center;
      }
      .box-container {
         display: flex;
         gap: 15px;
         flex-wrap: wrap;
         margin: 20px;
      }
      .box {
         border: 1px solid #ddd;
         width: 375px;
         height: auto;
         box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
         padding: 10px;
         border-radius: 3px;
         font-size: 18px;
      }
   </style>
</head>
<body>
<?php require_once ('inc/header.php') ?>
<?php require_once ('inc/nav.php') ?>

<section class="placed-orders">

   <h1 class="title">Đơn đặt hàng của bạn</h1>

   <div class="box-container">
      <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p> Tên người nhận : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Số điện thoại : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Địa chỉ : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> Ghi chú : <span><?php echo $fetch_orders['note']; ?></span> </p>
         <p> Phương thức thanh toán : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> Tổng giá : <span>$<?php echo $fetch_orders['total_price']; ?></span> </p>
         <p> Ngày đặt hàng : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
      </div>
      <?php
       }
      }else{
         echo '<p class="empty">Chưa có đơn hàng được đặt!</p>';
      }
      ?>
   </div>

</section>

<?php require_once ('inc/footer.php') ?>

</body>
</html>