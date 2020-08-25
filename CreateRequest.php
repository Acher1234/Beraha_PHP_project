<?php
session_start();
require_once ('Classes/Request.php');
require_once ('Classes/Personnes.php');
require_once ('Classes/customers.php');
$user = unserialize($_SESSION["User"]);
$Request = new Request();
$imagepath ='Upload/';
$Request->setCompanyName($_POST["Company_name"]);
$Request->setCOSF($_POST["COSF"]);
$Request->setDates(date("Y/m/d"));
$Request->setENOTF($_POST["ENOTE"]);
$Request->setIDclient($user->getID());
$Request->setFlightCommunication($_POST["Flight_directions"]);
$Request->setOperationalPilots($_POST["Operational_pilots"]);
$Request->setDateEnd($_POST["DateEnd"]);
$Request->setDateStart($_POST["DateStart"]);
$Request->setHourStart($_POST["HourStart"]);
$Request->setHourEnd($_POST["HourEnd"]);
$Request->setTextSup($_POST["Explain_the_nature_of_the_flight"]);
$Request->setPhotographyEquipement($_POST["Photography_equipment"]);
$Request->setHaAirforceSign(0);
$Request->setHasCAAIsign(0);
$Request->setHasShmSign(0);
$Request->setDateAirForcesign("");
$Request->setDateCAAIsign("");
$Request->setDateShmsign("");
for ($i = 0; $i < count($_POST["start_point"]);$i++)
{
    $Request->addArrayEndPoint($_POST["end_point"][$i]);
    $Request->addArrayStartPoint($_POST["start_point"][$i]);
    $Request->addArraytrackHeight($_POST["Track_height"][$i]);
    $image = $_FILES["image"];
    $Request->addArrayImage($image["name"][$i]);
    move_uploaded_file($image["tmp_name"][$i],$imagepath.$image["name"][$i]);
}
    if($Request->AddorUpgradeRequest())
    {
        header('Location:ClientLogged.php');
    }
    echo 'Error';

?>