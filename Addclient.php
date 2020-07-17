<?php
session_start();
if(!isset($_POST["user_name"]))
{
    //header relocation here
}
include_once('config.php');
$conn = returnAConnexion();
$stm = $conn->prepare("SELECT * from user WHERE user_name=?");
$stm->execute($_POST["user_name"]);
if(count($stm->fetchAll()) > 0)
{
    $message = "username already exist";
}
$stm = $conn->prepare("SELECT * from user WHERE mail=?");
$stm->execute($_POST["mail"]);
if(count($stm->fetchAll()) > 0)
{
    $message = "mail already exist";
}
if(!isset($message))
{
    $stm = $conn->prepare("INSERT INTO user () ");

}
