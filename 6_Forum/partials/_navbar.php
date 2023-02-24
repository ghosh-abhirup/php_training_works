<?php
include("_dbconnect.php");
session_start();

echo '
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/phpw/6_Forum/">Forum</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex align-items-center justify-content-between w-100"> 
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/phpw/6_Forum/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu">';

$sql = "SELECT * FROM `categories`";
$res = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($res)) {
    $id = $row['category_id'];
    echo '<li><a class="dropdown-item" href="/phpw/6_Forum/threadList.php?catId=' . $id . '">' . $row['category_name'] . '</a></li>';
}

echo '
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="./contact.php">Contact</a>
                </li>
            </ul>';
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] = true) {
    echo '
        <div class="justify-content-end">
            <button type="button" class="btn btn-outline-light" disabled>Welcome ' . $_SESSION['userEmail'] . '</button>
            <a role="button" href="partials/_logout.php" class="btn btn-primary">Logout</a>
        </div>';
} else {
    echo '
        <div class="justify-content-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signUpModal">Sign Up</button>
        </div>';
}


// echo '<form class="form-inline d-flex" role="search">
//                 <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
//                 <button class="btn btn-outline-success" type="submit">Search</button>

//             </form>
echo '  </div>
        </div>
    </div>
</nav>';

include "partials/_loginModal.php";
include "partials/_signUpModal.php";

if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
    echo '<div class="alert alert-success" role="alert">
    You are signed in
  </div>';
}
?>