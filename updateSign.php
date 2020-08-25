<?php
if($_SESSION["Types"] == "Shmgar")
{
    move_uploaded_file($_FILES["image"]["tmp_name"],"Signature/shamgarimages.png");
}
if($_SESSION["Types"] == "CAAI")
{
    move_uploaded_file($_FILES["image"]["tmp_name"],"Signature/CAAIimages.png");
}
if($_SESSION["Types"] == "Air_Force")
{
    move_uploaded_file($_FILES["image"]["tmp_name"],"Signature/AirForceimages.png");
}
header('Location:Redirection.php');