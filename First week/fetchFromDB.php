<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "movies";

$conn = mysqli_connect($servername, $username, $password, $database);

if ($conn) {
    echo "Connected Successfully";
} else {
    echo "Error";
}

$sql = "SELECT * FROM `extra` WHERE `state`='West Bengal'";
$res = mysqli_query($conn, $sql);

// Find the no of rows
echo "<br>";
$num = mysqli_num_rows($res);
echo $num;

// Print rows
echo "<br>";

if ($num > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        // echo "ID = " . $row['id'] . " --- Name = " . $row['name'] . " ---- State = " . $row['state'];
        echo var_dump($row);
        echo "<br>";
    }
}
?>