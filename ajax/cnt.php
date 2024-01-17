<?php 
    require_once ('../functions/functions.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        global $con;
        $name = safe_value($con, $_POST['name']);
        $email = safe_value($con, $_POST['email']);
        $subject = safe_value($con, $_POST['subject']);
        $message = safe_value($con, $_POST['message']);

        $query = "insert into contact (name, email, subject, message) values ('$name', '$email', '$subject', '$message')";
        $result = mysqli_query($con, $query);

        if ($result) {
            echo 'Success';
        }
    }
?>