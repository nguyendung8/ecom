<?php require_once ("inc/header.php")?>
<?php
    if (isset($_GET['id']) && $_GET['id'] != "") {
        $id = safe_value($con, $_GET['id']);
        $query = "Delete from products where Id = '$id'";
        $result = mysqli_query($con, $query);
        
        if ($result) {
            header('location:list_product.php');
        }
    }
?>