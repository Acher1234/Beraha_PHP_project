<?php
session_start();
$_SESSION["User"] = "";
$_SESSION["Connected"] = false;
$_SESSION["Types"] = "";
header('Location:IndexLoginPages.php');
?>