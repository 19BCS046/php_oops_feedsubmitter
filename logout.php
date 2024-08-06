<?php
echo"logout";
session_start();
include "./validation/Errors.php";
session_unset();
session_destroy();
header("Location: ./index.php");
?>