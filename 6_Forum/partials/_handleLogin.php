<?php
include("_dbconnect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];

    $sql = "SELECT * FROM `users` WHERE `user_email`='$email'";
    $res = mysqli_query($conn, $sql);

    $numRows = mysqli_num_rows($res);
    if ($numRows == 1) {
        $row = mysqli_fetch_assoc($res);
        if (password_verify($pass, $row['user_pass'])) {
            session_start();
            $_SESSION['loggedIn'] = true;
            $_SESSION['userEmail'] = $email;
            $_SESSION['userId'] = $row['user_id'];
            echo 'LoggedIn';
            header("Location: /phpw/6_Forum/index.php");
            exit();

        } else {
            echo 'Unable to login';
        }
    }
    header("Location: /phpw/6_Forum/index.php");
}
?>