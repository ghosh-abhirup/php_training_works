<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <?php require('partials/_nav.php') ?>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "abhi";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        echo '<div class="alert alert-danger" role="alert">
        <strong>Warning!</strong> Database is not connected.
      </div>';
    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $confirm = $_POST['conPass'];

            if ($confirm == $password) {

                if (!isset($email) || !isset($password)) {
                    echo '<div class="alert alert-danger" role="alert">
                            <strong>Warning!</strong> Invalid input.
                        </div>';
                } else {

                    $c = "SELECT * FROM `users` WHERE `email`='$email'";
                    $r = mysqli_query($conn, $c);
                    $check = mysqli_num_rows($r);

                    if ($check == 0) {
                        $hash = password_hash($password, PASSWORD_DEFAULT);
                        $insert = "INSERT INTO `users` (`email`,`password`) VALUES ('$email', '$hash')";
                        $res = mysqli_query($conn, $insert);

                        if ($res) {
                            echo '<div class="alert alert-success" role="alert">
                            <strong>Success!</strong> You are signed up. Please proceed to login.
                            </div>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert">
                            <strong>Warning!</strong> There are some problem with the server or your input.
                            </div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert">
                            <strong>Warning!</strong> Account already exists.
                            </div>';
                    }
                }

            } else {
                echo '<div class="alert alert-danger" role="alert">
                        <strong>Warning!</strong> Password confirmation input is wrong.
                        </div>';
            }


        }
    }
    ?>
    <div class="container">
        <h2 class="text-center">Sign up to our website</h2>

        <form class="w-50 m-auto mt-3" action="/phpw/login system/signup.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" name="pass" id="pass">
            </div>
            <div class="mb-3">
                <label for="conPass" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="conPass" name="conPass">
            </div>
            <button type="submit" class="btn btn-primary">Sign up</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>