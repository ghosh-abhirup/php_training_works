<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD App</title>

    <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">


</head>

<body>
    <!-- Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update note</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="m-auto" action="/phpw/CRUD App/index.php" method="post">
                        <input type="hidden" name="idEdit" id="idEdit">
                        <div class="mb-3">
                            <label for="noteEdit" class="form-label">Note Title</label>
                            <input type="text" name="noteEdit" class="form-control" id="noteEdit">
                        </div>
                        <div class="mb-3">
                            <label for="descEdit" class="form-label">Description</label>
                            <textarea class="form-control" name="descEdit" rows="3" id="descEdit"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Note</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SelfNotes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Form submission and other message -->

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "notes";

    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn) {
        die("Sorry we are not connected to the database" . mysqli_connect_error());
    }

    if (isset($_GET['delete'])) {
        $delId = $_GET['delete'];

        $sql = "DELETE FROM `notecrud` WHERE `id`=$delId;";
        $result3 = mysqli_query($conn, $sql);

        if ($result3) {
            echo '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Note is deleted
                  </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    <strong>Warning!</strong> Error in SQL query. Please check!
                  </div>';
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['idEdit'])) {
            $noteEdit = $_POST['noteEdit'];
            $descEdit = $_POST['descEdit'];
            $idEdit = $_POST['idEdit'];


            $sql = "UPDATE `notecrud` SET `note`='$noteEdit',`desc`='$descEdit' WHERE `id`=$idEdit;";
            $result2 = mysqli_query($conn, $sql);

            if ($result2) {
                echo '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Notes are Updated
                  </div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">
                    <strong>Warning!</strong> Error in SQL query. Please check!
                  </div>';
            }
        } else {

            $note = $_POST['note'];
            $desc = $_POST['desc'];

            $sql = "INSERT INTO `notecrud` (`note`, `desc`) VALUES ('$note', '$desc');";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo '<div class="alert alert-success" role="alert">
                <strong>Success!</strong> Form Submitted
              </div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">
                <strong>Warning!</strong> Error in SQL query. Please check!
              </div>';
            }
        }
    }
    ?>

    <div class="container mt-3 w-75">
        <h2>Add a note</h2>
        <form class="m-auto" action="/phpw/CRUD App/index.php" method="post">
            <div class="mb-3">
                <label for="note" class="form-label">Enter note title</label>
                <input type="text" name="note" class="form-control" id="note" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Enter description</label>
                <textarea class="form-control" name="desc" rows="3" id="desc"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>

    <div class="container mt-5 w-75 mb-3">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No.</th>
                    <th scope="col">Notes</th>
                    <th scope="col">Desc</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `notecrud`";
                $res = mysqli_query($conn, $sql);
                $t = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                    echo '<tr>
                    
                            <th scope="row">' . $t . '</th>
                            <td>' . $row['note'] . '</td>
                            <td>' . $row['desc'] . '</td>
                            <td><button type="button" id=' . $row['id'] . ' data-bs-toggle="modal" data-bs-target="#exampleModal" class="edit btn btn-primary">Edit</button> <button type="button" id=' . $row['id'] . ' class="delete btn btn-primary">Delete</button></td>
                        </tr>';
                    $t++;

                }
                ?>

            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>

    <script src="editIndex.js"></script>
</body>

</html>