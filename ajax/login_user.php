<?php 
    session_start();
    require_once ('../functions/functions.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        global $con;
        $email = safe_value($con, $_POST['email']);
        $password = safe_value($con, $_POST['password']);

        $query = "select * from user_register where email = '$email' and password = '$password'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result)) {
            while($row = mysqli_fetch_assoc($result)) { 
                $_SESSION['USER_ID'] = $row['Id'];
                $_SESSION['NAME'] = $row['name'];
                $_SESSION['EMAIL'] = $row['email'];
            }
            echo "success";
        }
        else {
            echo 'Email or Password not correct';
        }
    }
?>