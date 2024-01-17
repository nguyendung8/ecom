<?php 
    include('config.php');
    error_reporting(0);
    session_start();
    if(isset($_SESSION['USER_ID'])) {
        $user_id = $_SESSION['USER_ID']; //tạo session người dùng
    }

    if(isset($_POST['update_cart'])){//cập nhật giỏ hàng từ form submit name='update_cart'
        $cart_id = $_POST['cart_id'];
        $cart_quantity = $_POST['cart_quantity'];
        mysqli_query($conn, "UPDATE `carts` SET quantity = '$cart_quantity' WHERE id = $cart_id") or die('query failed');
        header('location:cart.php');
    }
    if(isset($_GET['delete'])){//xóa sách khỏi giỏ hàng từ onclick href='delete'
        $delete_id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM `carts` WHERE id = '$delete_id'") or die('query failed');
        header('location: cart.php');
    }
?>

<?php require_once ('inc/header.php') ?>
<?php require_once ('inc/nav.php') ?>

    <!-- cart start -->
    <section class="cart-page section-tb-padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-xs-12 col-sm-12 col-md-12 col-lg-8">
                    <div class="cart-area">
                        <div class="cart-details">
                            <div class="cart-item">
                                <span class="cart-head">My cart:</span>
                            </div>
                            <?php
                                $grand_total = 0;
                                $select_cart = mysqli_query($conn, "SELECT * FROM `carts` WHERE user_id = $user_id") or die('query failed');//lấy ra giỏ hàng tương ứng với id người dùng
                                if(mysqli_num_rows($select_cart) > 0){
                                    while($fetch_cart = mysqli_fetch_assoc($select_cart)){ 
                                    $name_product = $fetch_cart['name'];
                                    $select_quantity = mysqli_query($conn, "SELECT * FROM `products` WHERE product_name='$name_product'");
                                    $fetch_quantity = mysqli_fetch_assoc($select_quantity); 
                                    $grand_total += $fetch_cart['price'] * $fetch_cart['quantity'];
                            ?>
                            <div class="cart-all-pro">
                                <div class="cart-pro">
                                    <div class="cart-pro-image">
                                        <img style="min-width: 200px;" src="admin/img/<?php echo $fetch_cart['image'] ?>" class="img-fluid" alt="image">
                                    </div>
                                    <div class="pro-details">
                                        <h4><?php echo $fetch_cart['name'] ?></h4>
                                        <span class="cart-pro-price">$ <?php echo $fetch_cart['price'];  ?> CAD</span>
                                    </div>
                                </div>
                                <div class="qty-item">
                                    <div class="center">
                                        <form method="post" class="plus-minus">
                                            <span>
                                                <input type="number" name="cart_quantity" min="1" max="<?=$fetch_quantity['qty']?>" value="<?php echo $fetch_cart['quantity']; ?>">
                                                <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                                                <input style="width: 100px" type="submit" name="update_cart" value="Cập nhật">
                                            </span>
                                        </form>
                                        <a class="pro-remove" href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Xóa sản phẩm này khỏi giỏ hàng?');">
                                        Remove
                                    </a>
                                    </div>
                                </div>
                                <div class="all-pro-price">
                                    <span>$ <?php echo $fetch_cart['price'];  ?> CAD</span>
                                </div>
                            </div>
                                <?php
                                    }
                                }else{
                                    echo '<p class="empty">Giỏ hàng của bạn trống!</p>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xs-12 col-sm-12 col-md-12 col-lg-4">
                    <div class="cart-total">
                        <div class="cart-price">
                            <span>Subtotal</span>
                            <span class="total">$<?php echo $grand_total  ?> CAD</span>
                        </div>
                        <div class="shop-total">
                            <span>Total</span>
                            <span class="total-amount">$<?php echo $grand_total  ?> CAD</span>
                        </div>
                        <a href="checkout.php" class="check-link">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cart end -->

<?php require_once ('inc/footer.php') ?>