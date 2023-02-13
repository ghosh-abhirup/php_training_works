<?php
// Using MySQL using 1. MySQLi extension, 2. PDO

$servername = "localhost";
$username = "root";
$password = "";
$database = "movies";

// Creating connection
$conn = mysqli_connect($servername, $username, $password, $database);
echo "Connection successful";

//--------------------Create a db--------------------------
// $sql = "CREATE DATABASE movies";
// mysqli_query($conn, $sql);

// -------------------Create a table-----------------------
/*$sql = "CREATE TABLE `info` (
    `id` INT(6) NOT NULL AUTO_INCREMENT,
    `movie_name` VARCHAR(30) NOT NULL,
    `released_year` YEAR(4) NOT NULL,
    PRIMARY KEY(`id`)
)";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Updated info table inside movies DB";
} else {
    echo "Error occurred " . mysqli_connect_error();
}*/
// Data to be inserted from form
$movie = "";
$year = "";

// -------------------Insert data------------------------------
$sql = "INSERT INTO `info` (`movie_name`, `released_year`) VALUES ($movie, $year)";
$res = mysqli_query($conn, $sql);

if ($res) {
    echo "<br>Updated data into info table inside movies DB";
} else {
    echo "Error occurred " . mysqli_connect_error();
}

?>