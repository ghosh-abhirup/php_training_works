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
    <?php include("./partials/_dbconnect.php");
    $id = $_GET['catId'];

    $sql = "SELECT * FROM `categories` WHERE `category_id`=$id";
    $res = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($res)) {
        $category_name = $row['category_name'];
        $category_desc = $row['category_desc'];
    }


    ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $threadTitle = $_POST['title'];
        $threadTitle = str_replace('<', '&lt', $threadTitle);
        $threadTitle = str_replace('>', '&gt', $threadTitle);

        $threadDesc = $_POST['desc'];
        $threadDesc = str_replace('<', '&lt', $threadDesc);
        $threadDesc = str_replace('>', '&gt', $threadDesc);
        $id = $_GET['catId'];
        $userID = $_SESSION['userId'];

        $sql = "INSERT INTO `threads` (`thread_title`,`thread_desc`,`thread_cat_id`,`thread_user_id`) 
            VALUE ('$threadTitle', '$threadDesc', '$id', '$userID')";
        $res = mysqli_query($conn, $sql);

        if ($res) {
            echo '<div class="alert alert-success" role="alert">
                    Your thread has been added to the discussion panel
                </div>';
        } else {
            echo '<div class="alert alert-success" role="alert">
                    Something went wrong
                </div>';
        }
    }
    ?>

    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Welcome to
                <?php echo $category_name; ?> thread
            </h1>
            <p class="col-md-8 fs-4">
                <?php echo $category_desc; ?>
            </p>
            <button class="btn btn-primary btn-lg" type="button">Learn More</button>
        </div>
    </div>

    <?php
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] = true) {
        echo '
            <div class="container my-4">
                <h1>Start a discussion</h1>
                <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold">Title</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="fw-bold">Your concern</label>
                        <textarea class="form-control" placeholder="Leave your questions here" name="desc" id="desc"
                            style="height: 100px"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>';
    } else {
        echo '<div class="container my-4"><div class="alert alert-warning" role="alert">
            Please login to start a discussion
          </div></div>';
    }
    ?>
    <div class="container py-4">
        <h1>Browse Questions</h1>
        <?php
        $id = $_GET['catId'];
        $sql = "SELECT * FROM `threads` WHERE `thread_cat_id`=$id";
        $res = mysqli_query($conn, $sql);

        $noResult = true;
        while ($row = mysqli_fetch_assoc($res)) {
            $user = $row['thread_user_id'];

            $sql2 = "SELECT `user_email` FROM `users` WHERE `user_id`= '$user'";
            $res2 = mysqli_query($conn, $sql2);

            $row2 = mysqli_fetch_assoc($res2);

            $noResult = false;
            echo '
            <div class="row d-flex align-items-center justify-content-around w-75 mt-4">
                    <img src="https://icons-for-free.com/download-icon-user+icon-1320190636314922883_512.png" alt=""
                        class="mr-3" style="width:100px">
                    <div class="w-75">
                        <div class="d-flex justify-content-between ">
                            <h5> <a href="thread.php?threadId=' . $row['thread_id'] . '">' . $row['thread_title'] . '</a></h5>
                            <div>
                            <button type="button" class="btn btn-dark btn-sm " disabled>' . $row2['user_email'] . '</button>
                            <button type="button" class="btn btn-dark btn-sm " disabled>' . $row['time'] . '</button>
                            </div>
                        </div>
                        <p>' . $row['thread_desc'] . '</p>
                    </div>
            </div>';
        }

        if ($noResult) {
            echo '<div class="alert alert-warning" role="alert">
            Be the first one to start a discussion
          </div>';
        }
        ?>



    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>