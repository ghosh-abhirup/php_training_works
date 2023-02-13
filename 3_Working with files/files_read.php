<?php

// Reading file but output will be with the number of characters
// Example - I am watching THE LAST OF US in disney plus hotstar.52  <----character at last
$file = readfile('myFile.txt');
echo $file;

echo "<hr>";
// Reading file
// Example - I am watching THE LAST OF US in disney plus hotstar.  <----character length not there
readfile('myFile.txt');

echo "<hr>";
// File pointer
$fptr = fopen("myFile.txt", "r");

if (!$fptr) {
    die("Unvalid file.");
}
$content = fread($fptr, filesize("myFile.txt"));
echo $content;

echo "<hr>";
// fgets Reads oneline after another
$filePointer = fopen("myFile.txt", "r");
echo fgets($filePointer);
echo "<br>";
echo "Second Time calling";
echo "<br>";
echo fgets($filePointer);
echo "<br>";
echo "Using while loop";
echo "<br>";

$filePointer2 = fopen("myFile.txt", "r");
while ($a = fgets($filePointer2)) {
    echo $a;
}

echo "<hr>";
// fgets Reads one character after another
$filePointer3 = fopen("myFile.txt", "r");
echo fgetc($filePointer3);

fclose($fptr);
fclose($filePointer);
fclose($filePointer2);
fclose($filePointer3);

?>