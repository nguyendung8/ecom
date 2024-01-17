<?php 
    require_once ('db.php');

    // Display category
    function display_cat() {
        global $con;
        $query = "Select * From categories where status = 1";
        return $result = mysqli_query($con, $query);
    }

    // Get product
    function get_new_product($category_id = '') {
        global $con;
        $query = "Select * From products where status = 1 order by Id desc";

        if ($category_id != '') {
            $query = "Select * From products where status = 1 and category_id = '$category_id' order by Id desc";
        }
        return $result = mysqli_query($con, $query);
    }

    // Get safe value 
    function safe_value ($con, $value) {
        return mysqli_real_escape_string($con, $value);
    }

    // Add to cart
    function add_cart($id, $qty) {
        $_SESSION['CART'][$id]['QUANTITY']=[$qty];
    }

    // Get total card
    function total_cart() {
        if (isset($_SESSION['CART'])) {
            return count($_SESSION['CART']);
        }
        else {
            return 0;
        }
    }
?>