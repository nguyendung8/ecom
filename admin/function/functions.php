<?php

    // Set session message
    function set_message($msg) {
        if (!empty($msg)) {
            $_SESSION["MESSAGE"] = $msg;
        }
        else {
            $msg = "";
        }
    }

    // Display message
    function display_message() {
        if (isset($_SESSION["MESSAGE"])) {
            echo $_SESSION["MESSAGE"];
            unset($_SESSION["MESSAGE"]);
        }
    }

    function display_error($error) {
        return "<div class='alert alert-danger text-center'>$error</div>";
    }

    function display_success($success) {
        return "<div class='alert alert-success text-center'>$success</div>";
    }

    // Get safe value 
    function safe_value ($con, $value) {
        return mysqli_real_escape_string($con, $value);
    }

    // login checking
    function login_system() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-login'])) {
            global $con;
            $username = safe_value($con, $_POST['username']);
            $password = safe_value($con, $_POST['password']);
    
            // query
            $query = "select * from users where (username = '$username' or email = '$username') && password = '$password'";
            $result = mysqli_query($con, $query);
    
            if (mysqli_fetch_assoc($result)) {
                $_SESSION["ADMIN"] = $username;
                header("location: ./index.php");
            }
            else {
                set_message(display_error("Wrong username or password"));
            }
        }
    }

    // Add category function
    function add_category() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cat_btn'])) {
            global $con;
            $category = safe_value($con, $_POST['category']);

            if (empty($category)) {
                set_message(display_error("Please Enter Category Name"));
            }
            else {
                $sql = "select * from categories where cat_name = '$category'";
                $check = mysqli_query($con, $sql);
                if (mysqli_fetch_assoc($check)) {
                    set_message(display_error("Category Already Exists"));
                }
                else {
                    // query
                    $query = "insert into categories (cat_name, status) values ('$category', '1')";
                    set_message(display_success($query));
                    $result = mysqli_query($con, $query);
            
                    if ($result) {
                        set_message(display_success("Category has been saved in database. <a href='list_category.php'>View Category</a>"));
                    }
                    else {
                        set_message(display_error("Error"));
                    }
                }
            }
        }
    }

    // View cat
    function view_category() {
        global $con;
        $sql = "Select * From categories";
        return mysqli_query($con, $sql);
    }

    function active_status() {
        global $con;
        if (isset($_GET['opr']) && $_GET['opr'] != null) {
            $opr = safe_value($con, $_GET['opr']);
            $id = safe_value($con, $_GET['id']);

            if ($opr == "active") {
                $status = '1';
            }
            else {
                $status = '0';
            }

            $query = "Update categories set status = $status where id = '$id'";
            $result = mysqli_query($con, $query);
            if ($result) {
                header("location: list_category.php");
            }
        }
    }

    // Update category function
    function update_category() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cat_btn_update'])) {
            global $con;
            $category = safe_value($con, $_POST['category']);
            $id = safe_value($con, $_POST['id']);

            if (empty($category)) {
                set_message(display_error("Please Enter Category Name"));
            }
            else {
                $sql = "select * from categories where cat_name = '$category' and Id != '$id'";
                $check = mysqli_query($con, $sql);
                if (mysqli_fetch_assoc($check)) {
                    set_message(display_error("Category Already Exists"));
                    return $category;
                }
                else {
                    // query
                    $query = "update categories set cat_name = '$category' where Id = '$id'";
                    set_message(display_success($query));
                    $result = mysqli_query($con, $query);
            
                    if ($result) {
                        header('location: list_category.php');
                    }
                    else {
                        set_message(display_error("Error"));
                    }
                }
            }
        }
    }

    // ----------------------------------------------------- Product page ------------------------------------------------------------------ //
    // Save category function
    function save_product() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pro_btn'])) {
            global $con;
            $category_id = safe_value($con, $_POST['category_id']);
            $product_name = safe_value($con, $_POST['product_name']);
            $MRP = safe_value($con, $_POST['MRP']);
            $price = safe_value($con, $_POST['price']);
            $qty = safe_value($con, $_POST['qty']);
            $description = safe_value($con, $_POST['description']);

            // save img
            $img = $_FILES['img']['name'];
            $type = $_FILES['img']['type'];
            $tmp_name = $_FILES['img']['tmp_name'];
            $size = $_FILES['img']['size'];
            $img_ext = explode('.', $img);
            $img_correct_ext = strtolower(end($img_ext));
            $allow = array('jpg', 'png', 'jpeg');

            $path = 'img/'.$img;

            if (empty($product_name) || empty($MRP) || empty($price) || empty($qty) || empty($img) || empty($description) ) {
                set_message(display_error("Please fill in the blanks"));
            }
            else {
                if (in_array($img_correct_ext, $allow)) {
                    if ($size < 50000) {
                        if ($category_id == 0) {
                            set_message(display_error("Please select category"));
                        }
                        else {
                            $sql = "select * from products where product_name = '$product_name'";
                            $check = mysqli_query($con, $sql);
                            if (mysqli_fetch_assoc($check)) {
                                set_message(display_error("Product Already Exists"));
                            }
                            else {
                                $query = "Insert into products (category_id, product_name, MRP, price, qty, img, description, status) values (
                                    '$category_id', '$product_name', '$MRP', '$price', '$qty', '$img', '$description', '1'
                                )";
                                $result = mysqli_query($con, $query);
            
                                if ($result) {
                                    set_message(display_success("Product has been saved in database. <a href='list_product.php'>View Product</a>"));
                                    move_uploaded_file($tmp_name, $path);
                                }
                            }
                        }
                    }
                    else {
                        set_message(display_error("Your file too large"));
                    }
                }
                else {
                    set_message(display_error("You can't store this file"));
                }
            }
        }
    }

     // View product
     function view_product() {
        global $con;
        $sql = "SELECT products.Id, categories.cat_name, products.product_name, products.MRP, products.price, products.qty, products.img, products.description, products.status FROM products JOIN categories on products.category_id = categories.Id";
        return mysqli_query($con, $sql);
    }

    function active_status_product() {
        global $con;
        if (isset($_GET['opr']) && $_GET['opr'] != null) {
            $opr = safe_value($con, $_GET['opr']);
            $id = safe_value($con, $_GET['id']);

            if ($opr == "active") {
                $status = '1';
            }
            else {
                $status = '0';
            }

            $query = "Update products set status = $status where Id = '$id'";
            $result = mysqli_query($con, $query);
            if ($result) {
                header("location: list_product.php");
            }
        }
    }

    function update_product() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pro_btn_update'])) {
            global $con;
            $id = safe_value($con, $_POST['id']);
            $category_id = safe_value($con, $_POST['category_id']);
            $product_name = safe_value($con, $_POST['product_name']);
            $MRP = safe_value($con, $_POST['MRP']);
            $price = safe_value($con, $_POST['price']);
            $qty = safe_value($con, $_POST['qty']);
            $description = safe_value($con, $_POST['description']);

            // save img
            $img = $_FILES['img']['name'];
            $type = $_FILES['img']['type'];
            $tmp_name = $_FILES['img']['tmp_name'];
            $size = $_FILES['img']['size'];
            $img_ext = explode('.', $img);
            $img_correct_ext = strtolower(end($img_ext));
            $allow = array('jpg', 'png', 'jpeg');

            $path = 'img/'.$img;

            if (empty($product_name) || empty($MRP) || empty($price) || empty($qty) || empty($description) ) {
                set_message(display_error("Please fill in the blanks"));
            }
            else {
                if (!empty($img)) {
                    if (in_array($img_correct_ext, $allow)) {
                        if ($size < 50000) {
                            if ($category_id == 0) {
                                set_message(display_error("Please select category"));
                            }
                            else {
                                $sql = "select * from products where product_name = '$product_name' and Id != '$id'";
                                $check = mysqli_query($con, $sql);
                                if (mysqli_fetch_assoc($check)) {
                                    set_message(display_error("Product Already Exists"));
                                }
                                else {
                                    $query = "Update products set category_id = '$category_id', product_name = '$product_name', MRP = '$MRP', price = '$price', qty = '$qty', img = '$img', description = '$description' where Id = '$id'";
                                    $result = mysqli_query($con, $query);
                
                                    if ($result) {
                                        set_message(display_success("Product has been Updated. <a href='list_product.php'>View Product</a>"));
                                        move_uploaded_file($tmp_name, $path);
                                    }
                                }
                            }
                        }
                        else {
                            set_message(display_error("Your file too large"));
                        }
                    }
                    else {
                        set_message(display_error("You can't store this file"));
                    }
                }
                else {
                    if ($category_id == 0) {
                        set_message(display_error("Please select category"));
                    }
                    else {
                        $sql = "select * from products where product_name = '$product_name' and Id != '$id'";
                        $check = mysqli_query($con, $sql);
                        if (mysqli_fetch_assoc($check)) {
                            set_message(display_error("Product Already Exists"));
                        }
                        else {
                            $query = "Update products set category_id = '$category_id', product_name = '$product_name', MRP = '$MRP', price = '$price', qty = '$qty', description = '$description' where Id = '$id'";
                            $result = mysqli_query($con, $query);
        
                            if ($result) {
                                set_message(display_success("Product has been Updated. <a href='list_product.php'>View Product</a>"));
                            }
                        }
                    }
                }
            }
        }
    }

    // ------------------------------------------- Contact ------------------------------------------------//
    function contact() {
        global $con;
        $sql = "Select * From contact";
        return mysqli_query($con, $sql);
    }
?>