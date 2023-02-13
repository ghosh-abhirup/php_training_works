<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Database connect Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/phpw/moviedbtest.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $movie = $_POST['name'];
        $state = $_POST['state'];


        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "movies";

        // Creating connection
        $conn = mysqli_connect($servername, $username, $password, $database);

        if (!$conn) {
            echo '<div class="alert alert-danger" role="alert">
            Error in database connection
            </div>';
        } else {
            // -------------------Insert data------------------------------
            $sql = "INSERT INTO `extra` (`name`, `state`) VALUES ('$movie' , '$state')";
            $res = mysqli_query($conn, $sql);

            if ($res) {
                echo '<div class="alert alert-success" role="alert">
                 Updated data into info table inside movies DB
                 </div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">
                 Error in SQL querry
                 </div>';
            }
        }
    }
    ?>


    <h2 class="my-3 text-center">Please enter the details</h2>

    <form class="m-auto mt-3 w-50" action="/phpw/moviedbtest.php" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Enter name</label>
            <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="state" class="form-label">Enter the state</label>
            <input type="text" name="state" class="form-control" id="state">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>