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

            $c = "SELECT `password` FROM `users` WHERE `email`='$email'";
            $r = mysqli_query($conn, $c);

            $row = mysqli_fetch_assoc($r);

            if (password_verify($password, $row['password'])) {
                echo '<div class="alert alert-success" role="alert">
                        <strong>Success!</strong> You are signed up. Please proceed to login.
                        </div>';

                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['usermail'] = $email;
                header("location: /phpw/login system/welcome.php");
            } else {
                echo '<div class="alert alert-danger" role="alert">
                        <strong>Warning!</strong> Email or password is invalid.
                        </div>';
            }
        }

    }
    ?>
    <div class="container">
        <h2 class="text-center">Login to our website</h2>

        <form class="w-50 m-auto mt-3" action="/phpw/login system/login.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" name="pass" id="pass">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>