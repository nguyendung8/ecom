    <?php 
        include('config.php');
        session_start();
        require_once('functions/functions.php');
        $cat = display_cat();
        $cart_number = total_cart();
        ob_start();
        if(isset($_SESSION['USER_ID'])) {
            $user_id = $_SESSION['USER_ID']; //tạo session người dùng
        }
    ?>
    <!-- header start -->
    <header class="header-area">
        <div class="header-main-area">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="header-main">
                            <!-- logo start -->
                            <div class="header-element logo">
                                <a href="index.php">l
                                    <img src="https://image.donghohaitrieu.com/wp-content/uploads/2023/08/logo.png"  style="height:40px" alt="logo-image" class="img-fluid">
                                </a>
                            </div>
                            <!-- logo end -->
                            <!-- search start -->
                            <div class="header-element search-wrap">
                                <input type="text" name="search" placeholder="Search product.">
                                <a href="#" class="search-btn"><i class="fa fa-search"></i></a>
                            </div>
                            <!-- search end -->
                            <!-- header-icon start -->
                            <div class="header-element right-block-box">
                                <ul class="shop-element">
                                    <li class="side-wrap nav-toggler">
                                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                            data-target="#navbarContent">
                                            <span class="line"></span>
                                        </button>
                                    </li>
                                    <li class="side-wrap user-wrap">
                                        <div class="acc-desk">
                                            <div class="user-icon">
                                                <a href="#" class="user-icon-desk">
                                                    <span><i class="icon-user"></i></span>
                                                </a>
                                            </div>
                                            <div class="user-info">
                                                <?php 
                                                    if(isset($_SESSION['USER_ID'])) 
                                                    {
                                                ?>
                                                    <span class="acc-title"><?php echo $_SESSION['NAME']?></span>
                                                    <div class="account-login">
                                                        <a href="logout.php">Log out</a>
                                                    </div>
                                                <?php 
                                                    }
                                                    else {
                                                ?>
                                                    <span class="acc-title">Account</span>
                                                    <div class="account-login">
                                                        <a href="register.php">Register</a>
                                                        <a href="login.php">Log in</a>
                                                    </div>
                                                <?php       
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="acc-mob">
                                            <a href="#" class="user-icon">
                                                <span><i class="icon-user"></i></span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="side-wrap wishlist-wrap">
                                        <a href="#" class="header-wishlist">
                                            <span class="wishlist-icon"><i class="icon-heart"></i></span>
                                            <span class="wishlist-counter">0</span>
                                        </a>
                                    </li>
                                    <?php
                                        if(isset($user_id)){// session không tồn tại => quay lại trang đăng nhập
                                    ?>
                                    <li class="side-wrap cart-wrap">
                                        <div class="shopping-widget">
                                            <div class="shopping-cart">
                                                <a href="orders.php" class="cart-count">
                                                    <span class="cart-icon-wrap">
                                                        <span style="font-size: 16px;" class="cart-icon">Đơn hàng</span>
                                                        <?php
                                                            $select_order = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = $user_id") or die('query failed');//lấy ra giỏ hàng tương ứng với id người dùng
                                                            $number_order = mysqli_num_rows($select_order)
                                                        ?>
                                                        <span style="top: -10px; left: 73px;" id="cart-total" class="bigcounter"><?php echo $number_order?></span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="side-wrap cart-wrap">
                                        <div class="shopping-widget">
                                            <div class="shopping-cart">
                                                <a href="cart.php" class="cart-count">
                                                    <span class="cart-icon-wrap">
                                                        <span class="cart-icon"><i class="icon-handbag"></i></span>
                                                        <?php
                                                            $select_cart = mysqli_query($conn, "SELECT * FROM `carts` WHERE user_id = $user_id") or die('query failed');//lấy ra giỏ hàng tương ứng với id người dùng
                                                            $number_item = mysqli_num_rows($select_cart)
                                                        ?>
                                                        <span id="cart-total" class="bigcounter"><?php echo $number_item?></span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <!-- header-icon end -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom-area">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="main-menu-area">
                                <div class="main-navigation navbar-expand-xl">
                                    <div class="box-header menu-close">
                                        <button class="close-box" type="button"><i class="ion-close-round"></i></button>
                                    </div>
                                    <!-- menu start -->
                                    <div class="navbar-collapse" id="navbarContent">
                                        <div class="megamenu-content">
                                            <div class="mainwrap">
                                                <ul class="main-menu">
                                                    <li class="menu-link parent">
                                                        <a href="index.php" class="link-title">
                                                            <span class="sp-link-title">Home</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-link parent">
                                                        <a href="grid-list.php" class="link-title">
                                                            <span class="sp-link-title">Category</span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <a href="#collapse-mega-menu" data-bs-toggle="collapse"
                                                            class="link-title link-title-lg">
                                                            <span class="sp-link-title">Category</span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-submenu mega-menu collapse"
                                                            id="collapse-mega-menu">
                                                            <li class="megamenu-li parent">
                                                                <ul class="dropdown-supmenu collapse"
                                                                    id="collapse-sub-mega-menu">
                                                                    <?php
                                                                        while($row = mysqli_fetch_assoc($cat)) {
                                                                            
                                                                    ?>
                                                                        <li class="supmenu-li"><a href="grid-list.php?id=<?php echo $row['Id'] ?>"><?php echo $row['cat_name'] ?></a></li>
                                                                    <?php
                                                                        }
                                                                    ?>
                  
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <!-- <li class="menu-link parent">
                                                        <a href="grid-list.php" class="link-title">
                                                            <span class="sp-link-title">Collection</span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <a href="#collapse-banner-menu" data-bs-toggle="collapse"
                                                            class="link-title link-title-lg">
                                                            <span class="sp-link-title">Collection</span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-submenu banner-menu collapse"
                                                            id="collapse-banner-menu">
                                                            <li class="menu-banner">
                                                                <a href="grid-list.php" class="menu-banner-img"><img
                                                                        src="assets/image/menu-banner01.jpg" alt="menu-image"
                                                                        class="img-fluid"></a>
                                                                <a href="grid-list.php"
                                                                    class="menu-banner-title"><span>Bestseller</span></a>
                                                            </li>
                                                            <li class="menu-banner">
                                                                <a href="grid-list.php" class="menu-banner-img"><img
                                                                        src="assets/image/menu-banner02.jpg" alt="menu-image"
                                                                        class="img-fluid"></a>
                                                                <a href="grid-list.php"
                                                                    class="menu-banner-title"><span>Special
                                                                        product</span></a>
                                                            </li>
                                                            <li class="menu-banner">
                                                                <a href="grid-list.php" class="menu-banner-img"><img
                                                                        src="assets/image/menu-banner03.jpg" alt="mneu image"
                                                                        class="img-fluid"></a>
                                                                <a href="grid-list.php"
                                                                    class="menu-banner-title"><span>Featured
                                                                        product</span></a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu-link parent">
                                                        <a href="javascript:void(0)" class="link-title">
                                                            <span class="sp-link-title">Pages</span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <a href="#collapse-page-menu" data-bs-toggle="collapse"
                                                            class="link-title link-title-lg">
                                                            <span class="sp-link-title">Pages</span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-submenu sub-menu collapse"
                                                            id="collapse-page-menu">
                                                            <li class="submenu-li">
                                                                <a href="about-us.html" class="submenu-link">About
                                                                    us</a>
                                                            </li>
                                                            <li class="submenu-li">
                                                                <a href="javascript:void(0)"
                                                                    class="g-l-link"><span>Account</span> <i
                                                                        class="fa fa-angle-right"></i></a>
                                                                <a href="#account-menu" data-bs-toggle="collapse"
                                                                    class="sub-link"><span>Account</span> <i
                                                                        class="fa fa-angle-down"></i></a>
                                                                <ul class="collapse blog-style-1" id="account-menu">
                                                                    <li>
                                                                        <a href="order-history.html"
                                                                            class="sub-style"><span>Order</span></a>
                                                                        <a href="order-history.html"
                                                                            class="blog-sub-style"><span>Order</span></a>
                                                                        <a href="profile.html"
                                                                            class="sub-style"><span>Profile</span></a>
                                                                        <a href="profile.html"
                                                                            class="blog-sub-style"><span>Profile</span></a>
                                                                        <a href="pro-#"
                                                                            class="sub-style"><span>Wishlist</span></a>
                                                                        <a href="pro-#"
                                                                            class="blog-sub-style"><span>Wishlist</span></a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li class="submenu-li">
                                                                <a href="billing-info.html" class="submenu-link">Billing
                                                                    info</a>
                                                            </li>
                                                            <li class="submenu-li">
                                                                <a href="faq%27s.html" class="submenu-link">Faq's</a>
                                                            </li>
                                                            <li class="submenu-li">
                                                                <a href="contact.html" class="submenu-link">Contact
                                                                    us</a>
                                                            </li>
                                                            <li class="submenu-li">
                                                                <a href="terms-conditions.html"
                                                                    class="submenu-link">Terms & conditions</a>
                                                            </li>
                                                        </ul>
                                                    </li> -->
                                                    <li class="menu-link parent">
                                                        <a href="contact.php" class="link-title">
                                                            <span class="sp-link-title">Contact</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- menu end -->
                                    <div class="img-hotline">
                                        <div class="image-line">
                                            <a href="javascript:void(0)"><img src="assets/image/icon_contact.png"
                                                    class="img-fluid" alt="image-icon"></a>
                                        </div>
                                        <div class="image-content">
                                            <span class="hot-l">Hotline:</span>
                                            <span>0969 609 003</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--mini Cart start-->
        <div class="mini-cart">
            <a href="javascript:void(0)" class="shopping-cart-close"><i class="ion-close-round"></i></a>
            <div class="cart-item-title">
                <p>
                    <span class="cart-count-desc">There are</span>
                    <span class="cart-count-item bigcounter">4</span>
                    <span class="cart-count-desc">Products</span>
                </p>
            </div>
            <ul class="cart-item-loop">
                <li class="cart-item">
                    <div class="cart-img">
                        <a href="product.html">
                            <img src="assets/image/cart-img.jpg" alt="cart-image" class="img-fluid">
                        </a>
                    </div>
                    <div class="cart-title">
                        <h6><a href="product.html">Đính kim cương</a></h6>
                        <div class="cart-pro-info">
                            <div class="cart-qty-price">
                                <span class="quantity">1 x </span>
                                <span class="price-box">$250.00 USD</span>
                            </div>
                            <div class="delete-item-cart">
                                <a href="empty-cart.html"><i class="icon-trash icons"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="cart-item">
                    <div class="cart-img">
                        <a href="product.html">
                            <img src="assets/image/cart-img02.jpg" alt="cart-image" class="img-fluid">
                        </a>
                    </div>
                    <div class="cart-title">
                        <h6><a href="product.html">Natural grassbean 4kg</a></h6>
                        <div class="cart-pro-info">
                            <div class="cart-qty-price">
                                <span class="quantity">1 x </span>
                                <span class="price-box">$300.00 USD</span>
                            </div>
                            <div class="delete-item-cart">
                                <a href="empty-cart.html"><i class="icon-trash icons"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="cart-item">
                    <div class="cart-img">
                        <a href="product.html">
                            <img src="assets/image/cart-img03.jpg" alt="cart-image" class="img-fluid">
                        </a>
                    </div>
                    <div class="cart-title">
                        <h6><a href="product.html">Organic coconut juice 5ltr</a></h6>
                        <div class="cart-pro-info">
                            <div class="cart-qty-price">
                                <span class="quantity">1 x </span>
                                <span class="price-box">$250.00 USD</span>
                            </div>
                            <div class="delete-item-cart">
                                <a href="empty-cart.html"><i class="icon-trash icons"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="cart-item">
                    <div class="cart-img">
                        <a href="product.html">
                            <img src="assets/image/cart-img04.jpg" alt="cart-image" class="img-fluid">
                        </a>
                    </div>
                    <div class="cart-title">
                        <h6><a href="product.html">Orange juice 5ltr</a></h6>
                        <div class="cart-pro-info">
                            <div class="cart-qty-price">
                                <span class="quantity">1 x </span>
                                <span class="price-box">$350.00 USD</span>
                            </div>
                            <div class="delete-item-cart">
                                <a href="empty-cart.html"><i class="icon-trash icons"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="subtotal-title-area">
                <li class="subtotal-info">
                    <div class="subtotal-titles">
                        <h6>Sub total:</h6>
                        <span class="subtotal-price">$750.00 USD</span>
                    </div>
                </li>
                <li class="mini-cart-btns">
                    <div class="cart-btns">
                        <a href="cart.php" class="btn btn-style2">View cart</a>
                        <a href="checkout.php" class="btn btn-style2">checkout</a>
                    </div>
                </li>
            </ul>
        </div>
        <!--mini Cart end-->
    </header>
    <!-- header end -->