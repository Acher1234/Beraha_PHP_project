<?php
session_start();
echo $_SESSION["Types"];
if(isset($_SESSION["Types"]))
{
    if($_SESSION["Types"] == "custommer")
    {
        header('Location:ClientLogged.php');
    }
    if($_SESSION["Types"] == "Shmgar")
    {
        header('Location:Shamgarlogged.php');
    }
    if($_SESSION["Types"] == "CAAI" || $_SESSION["Types"] == "Air_Force")
    {
        header('Location:SpecialLoagged.php');
    }
}
