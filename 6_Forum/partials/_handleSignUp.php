<?php
include("_dbconnect.php");
$showError = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userEmail = $_POST['signUpEmail'];
    $password = $_POST['signUpPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $sql = "SELECT * FROM `users` WHERE `user_email` = '$userEmail'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $showError = "Email already in use";
    } else {
        if ($password == $confirmPassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO `users` (`user_email`,`user_pass`) VALUE ('$userEmail', '$hash')";
            $res = mysqli_query($conn, $sql);

            if ($res) {
                $showAlert = true;
                header("Location: /phpw/6_Forum/index.php?signupsuccess=true");
                exit();
            } else {
                $showError = "Something is not right";
            }
        } else {
            $showError = "Passwords do not match";
        }
    }
    header("Location: /phpw/6_Forum/index.php?signupsuccess=false&error=$showError");
}
?>