<?php 
    require_once ('../functions/functions.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        global $con;
        $name = safe_value($con, $_POST['name']);
        $email = safe_value($con, $_POST['email']);
        $password = safe_value($con, $_POST['password']);

        $query = "select * from user_register where email = '$email'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result)) {
            echo "Email already exists";
        }
        else {
            $query = "insert into user_register (name, email, password) values ('$name', '$email', '$password')";
            $result = mysqli_query($con, $query);
    
            if ($result) {
                echo 'Success';
            }
        }
    }
?>