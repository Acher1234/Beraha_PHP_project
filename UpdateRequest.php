<?php
session_start();
require_once ('Classes/Request.php');
require_once ('Classes/Personnes.php');
require_once ('Classes/customers.php');
$user = unserialize($_SESSION["User"]);
$RequestBase = Request::getRequestOnId($_POST["FormID"]);
if($_SESSION["Types"] == "Shmgar" || $_SESSION["Types"] == "custommer") {
    $Request = new Request();
    $imagepath = './Upload/';
    $Request->setID($_POST["FormID"]);
    $Request->setIDclient($_POST["ClientID"]);
    $Request->setCompanyName($_POST["Company_name"]);
    $Request->setCOSF($_POST["COSF"]);
    $Request->setDates(date("Y/m/d"));
    $Request->setENOTF($_POST["ENOTF"]);
    $Request->setIDclient($user->getID());
    $Request->setFlightCommunication($_POST["Flight_directions"]);
    $Request->setOperationalPilots($_POST["Operational_pilots"]);
    $Request->setDateEnd($_POST["DateEnd"]);
    $Request->setDateStart($_POST["DateStart"]);
    $Request->setHourStart($_POST["HourStart"]);
    $Request->setHourEnd($_POST["HourEnd"]);
    $Request->setTextSup($_POST["Explain_the_nature_of_the_flight"]);
    $Request->setPhotographyEquipement($_POST["Photography_equipment"]);
    $Request->setTexte($_POST["Texte"]);
    $Request->setOnTypes($RequestBase->getOnTypes());
    $Request->setHaAirforceSign($RequestBase->getHaAirforceSign());
    $Request->setHasCAAIsign($RequestBase->getHasCAAIsign());
    $Request->setHasShmSign($RequestBase->getHasShmSign());
    for ($i = 0; $i < count($_POST["start_point"]); $i++) {
        $Request->addArrayEndPoint($_POST["end_point"][$i]);
        $Request->addArrayStartPoint($_POST["start_point"][$i]);
        $Request->addArraytrackHeight($_POST["Track_height"][$i]);
        $image = $_FILES["image"];
        if ($image["size"][$i] == 0) {
            for ($j = 0; $j < count($RequestBase->getArrayStartPoint()); $j++) {
                if ($RequestBase->getArrayStartPoint()[$j] == $_POST["start_point"][$i] && $RequestBase->getArrayEndPoint()[$j] == $_POST["end_point"][$i]) {
                    $Request->addArrayImage($RequestBase->getArrayImage()[$j]);
                }
            }
        } else if ($image["size"][$i] != 0) {
            $Request->addArrayImage($image["name"][$i]);
            move_uploaded_file($image["tmp_name"][$i], $imagepath . $image["name"][$i]);

        }
    }
    print_r($Request);
    if($Request->AddorUpgradeRequest())
       {
          // header('Location:ClientLogged.php');
       }
}
else
{
    if(isset($_POST["Name_and_role"]))
    {
        $RequestBase->setNameAndRole($_POST["Name_and_role"]);
    }
    if(isset($_POST["yesno"]))
    {
        if($_POST["yesno"] == "yes")
        {
            $RequestBase->setHaAirforceSign(1);
        }
        else
        {
            $RequestBase->setHaAirforceSign(0);
        }
    }
    if(isset($_POST["detailrefused"]) && !$RequestBase->getHaAirforceSign())
    {
        $RequestBase->setAirForceReason($_POST["detailrefused"]);
    }
    if(isset($_POST["detailAccepted"]) && $RequestBase->getHaAirforceSign())
    {
        $RequestBase->setAirForceReason($_POST["detailAccepted"]);
    }
    if(isset($_POST["Additional_Comments"]))
    {
        print_r($_POST["Additional_Comments"]);
        $RequestBase->setAdditionalCommentsAirforce($_POST["Additional_Comments"]);
    }
    $RequestBase->setTexte($_POST["Texte"]);
    if($RequestBase->AddorUpgradeRequest())
    {
        if(isset($_POST["yesno"]) && $_POST["yesno"] == "yes")
        {
            header('Location:action.php?action=3&idRequest='. $RequestBase->getID().'');
        }
        elseif (isset($_POST["yesno"]) && $_POST["yesno"] == "no")
        {
            header('Location:action.php?action=4&idRequest='. $RequestBase->getID().'');
        }
        //header('Location:ClientLogged.php');
    }
}
echo 'Error';

?>