<?php
session_start();
echo 'Logging you out .....';
session_destroy();
header("Location: /phpw/6_Forum/index.php");
?>