<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Coding Forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <?php include("./partials/_navbar.php"); ?>
    <?php include("./partials/_dbconnect.php"); ?>

    <div class="container text-center mt-4">
        <h1>Forum Categories</h1>
    </div>
    <div class="d-flex justify-content-center ">

        <div class="row w-75 m-3">

            <?php
            $sql = "SELECT * FROM `categories`";
            $res = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['category_id'];
                echo '<div class="col-md-4 my-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">' . $row['category_name'] . '</h5>
                        <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                        <p class="card-text">' . substr($row['category_desc'], 0, 50) . ' ...</p>
                        <a href="/phpw/6_Forum/threadList.php?catId=' . $id . '" class="btn btn-primary">View Threads</a>
                    </div>
                </div>
            </div>';
            }
            ?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>