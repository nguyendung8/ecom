<?php 
    session_start();
    require_once ('../functions/functions.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        global $con;
        $id = safe_value($con, $_POST['id']);
        $quantity = safe_value($con, $_POST['quantity']);
        $type = safe_value($con, $_POST['type']);
        
        if ($type == 'add') {
            add_cart($id, $quantity);
        }

        echo total_cart();
    }
?>