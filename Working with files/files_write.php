<?php

echo "Writing and appending into files";
$fptr = fopen("fileWrite.txt", "w");
fwrite($fptr, "I am writing in the file\n");
fwrite($fptr, "It is a content");


$filePointer = fopen("fileWrite.txt", "a");
fwrite($filePointer, "This is being appended");

fclose($fptr);
fclose($filePointer);
?>