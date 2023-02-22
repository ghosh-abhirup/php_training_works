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
    $id = $_GET['threadId'];
    $sql = "SELECT * FROM `threads` WHERE `thread_id`=$id";
    $res = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($res)) {
        $thread_title = $row['thread_title'];
        $thread_desc = $row['thread_desc'];
    }

    ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $comment = $_POST['comment'];

        $sql = "INSERT INTO `comments` (`comment_content`,`thread_id`) 
            VALUE ('$comment', '$id')";
        $res = mysqli_query($conn, $sql);

        if ($res) {
            echo '<div class="alert alert-success" role="alert">
    Your comment has been added to the panel
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
            <h1 class="display-5 fw-bold">
                <?php echo $thread_title; ?>
            </h1>
            <p class="col-md-8 fs-4">
                <?php echo $thread_desc; ?>
            </p>
            <button class="btn btn-primary btn-lg disabled" type="button">Learn More</button>
        </div>
    </div>

    <div class="container my-4">
        <h1>Add a comment</h1>
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <div class="mb-3">
                <textarea class="form-control" placeholder="Leave a comment here" name="comment" id="comment"
                    style="height: 100px"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <div class="container py-4">
        <h1>Comments</h1>
        <div class="d-flex flex-column">
            <?php
            $sql = "SELECT * FROM `comments` WHERE `thread_id`=$id";
            $res = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($res)) {
                echo '<div class="border border-primary my-2 p-3 rounded">
                <p class="fw-semibold fs-7">At ' . $row['comment_time'] . '</p>
                <p class="fw-semibold fs-5">' . $row['comment_content'] . '</p>
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