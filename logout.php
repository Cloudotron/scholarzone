<?php 
ob_start();
session_start();
session_regenerate_id();

session_destroy();
header("location:login.php");
?>