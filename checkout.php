<?php
    include('config.php');
    error_reporting(0);
    session_start();
    if(isset($_SESSION['USER_ID'])) {
        $user_id = $_SESSION['USER_ID']; //tạo session người dùng
    }

    if(isset($_POST['order_btn'])){//nhập thông tin đơn hàng từ form submit name='order_btn'

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $number = $_POST['number'];
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $method = mysqli_real_escape_string($conn, $_POST['method']);
        $address = mysqli_real_escape_string($conn,$_POST['street']);
        $note = mysqli_real_escape_string($conn, $_POST['note']);
        $placed_on = date('d-m-Y');
        $status = 'Chờ xác nhận';
  
        $cart_total = 0;
  
        $cart_query = mysqli_query($conn, "SELECT * FROM `carts` WHERE user_id = $user_id") or die('query failed');
        if(mysqli_num_rows($cart_query) > 0){
           while($cart_item = mysqli_fetch_assoc($cart_query)){
              $cart_products[] = $cart_item['name']. '-' .$cart_item['quantity'];
              $sub_total = ($cart_item['price'] * $cart_item['quantity']);
              $cart_total += $sub_total;
           }
           $total_products = implode(', ',$cart_products);
  
           $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND note= '$note' AND total_price = '$cart_total'") or die('query failed');
           if(mysqli_num_rows($order_query) > 0){
                echo '<script>';
                echo 'alert("Đơn hàng đã tồn tại!");';
                echo '</script>';
           }else{
              mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, note, total_price, placed_on, status) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$note', '$cart_total', '$placed_on', '$status')") or die('query failed');
                echo '<script>';
                echo 'alert("Đặt hàng thành công!");';
                echo '</script>';
              $cart_quantity= mysqli_query($conn, "SELECT * FROM `carts` WHERE user_id = '$user_id'") or die('query failed');
              while($fetch_quantity= mysqli_fetch_assoc($cart_quantity)){
                 $name_product= $fetch_quantity['name'];
                 $product_quantity= mysqli_query($conn, "SELECT * FROM `products` WHERE product_name='$name_product'");
                 $fetch_product_quantity= mysqli_fetch_assoc($product_quantity);
                 $nums= $fetch_product_quantity['qty'] - $fetch_quantity['quantity'];
                 mysqli_query($conn, "UPDATE `products` SET qty='$nums' WHERE product_name='$name_product'");
              }
              mysqli_query($conn, "DELETE FROM `carts` WHERE user_id = '$user_id'") or die('query failed');
           }
        }else{
            echo '<script>';
            echo 'alert("Giỏ hàng của bạn trống, không thể đặt hàng!");';
            echo '</script>';
        }
     }
?>

<?php require_once ('inc/header.php') ?>
<?php require_once ('inc/nav.php') ?>
    <style>
        .billing-area {
            padding: 24px;
        }
        .billing-form {
            margin-bottom: 19px;
        }
        .billing-li {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }
        .order-form {
            padding: 15px;
        }
    </style>
    <!-- checkout page start -->
    <section class="section-tb-padding">
        <div class="container">
            <div class="row">
                <div class="col">
                    <form method="post" class="checkout-area">
                        <div class="billing-area">
                            <div>
                                <h2>Billing details</h2>
                                <div class="billing-form">
                                    <ul class="billing-ul input-2">
                                        <li class="billing-li">
                                            <label>Full name</label>
                                            <input type="text" name="name" placeholder="Full name">
                                        </li>
                                    </ul>
                                    <ul class="billing-ul">
                                        <li class="billing-li">
                                            <label>Address</label>
                                            <input type="text" name="street" placeholder="Address">
                                        </li>
                                    </ul>
                                    <ul class="billing-ul input-2">
                                        <li class="billing-li">
                                            <label>Email</label>
                                            <input type="text" name="email" placeholder="Email address">
                                        </li>
                                        <li class="billing-li">
                                            <label>Phone</label>
                                            <input type="number" name="number" placeholder="Phone">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="billing-details">
                                <div>
                                    <h2>Shipping details</h2>
                                    <ul class="shipping-form">
                                        <li class="comment-area">
                                            <label>Order notes(Optional)</label>
                                            <textarea name="note" rows="4" cols="80"></textarea>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                        <?php  
                            $grand_total = 0;
                            $select_cart = mysqli_query($conn, "SELECT * FROM `carts` WHERE user_id = '$user_id'") or die('query failed');
                            if(mysqli_num_rows($select_cart) > 0){
                                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                                $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
                                $grand_total += $total_price;
                        ?>
                        <?php
                                }
                        ?>
                        <div class="order-area">
                            <h2>Your order</h2>
                            <ul class="order-history">
                            
                                <li class="order-details">
                                    <span>Subtotal:</span>
                                    <span>$<?php echo $grand_total ?></span>
                                </li>
                                <li class="order-details">
                                    <span>Shipping Charge:</span>
                                    <span>Free shipping</span>
                                </li>
                                <li class="order-details">
                                    <span>Total:</span>
                                    <span>$<?php echo $grand_total ?></span>
                                </li>
                            </ul>
                            <div>
                                <ul class="order-form">
                                    <li>
                                    <select name="method">
                                        <option value="Tiền mặt khi nhận hàng">Tiền mặt khi nhận hàng</option>
                                        <option value="Thẻ ngân hàng">Thẻ ngân hàng</option>
                                        <option value="Paypal">Paypal</option>
                                    </select>
                                    </li>
                                    <li class="pay-icon">
                                        <a href="javascript:void(0)"><i class="fa fa-credit-card"></i></a>
                                        <a href="javascript:void(0)"><i class="fa fa-cc-visa"></i></a>
                                        <a href="javascript:void(0)"><i class="fa fa-cc-paypal"></i></a>
                                        <a href="javascript:void(0)"><i class="fa fa-cc-mastercard"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="checkout-btn">
                                <input class="btn-style1" type="submit" name="order_btn" value="Place order">
                            </div>
                        </div>
                        <?php
                            }else{
                                echo '<p class="empty">Giỏ hàng của bạn trống!</p>';
                            }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- checkout page end -->

<?php require_once ('inc/footer.php') ?>