<?php 
session_start();
session_destroy();
header("location: teladelogin.php");
?>