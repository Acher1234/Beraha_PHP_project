<?php
if(!isset($_POST["user_name"]))
{
    $message = "bug";
}
if(!isset($message))
{
    include_once('config.php');
    $conn = returnAConnexion();
    $stm = $conn->prepare("SELECT * from user WHERE user_name=?");
    $stm->execute([$_POST["user_name"]]);
    if (count($stm->fetchAll()) > 0) {
        $message = "username already exist";
    }
    $stm = $conn->prepare("SELECT * from user WHERE mail=?");
    $stm->execute([$_POST["mail"]]);
    if (count($stm->fetchAll()) > 0) {
        $message = "mail already exist";
    }
}
if(!isset($message))
{
    $stm = $conn->prepare("INSERT INTO user (mail,user_name,Password,Telephone,types) VALUES (?, ?, ?,?,?);  ");
    $r = $stm->execute([$_POST["mail"],$_POST["user_name"],password_hash($_POST["password"],PASSWORD_DEFAULT),$_POST["phone"],"custommer"]);
    if($r){$message = 'ok';}
    else{$message = 'error';}
}
echo $message;
