<?php
    session_start();
    include_once('Classes/Request.php');
    if($_GET["action"] == 0)
    {
        $id = $_GET["idRequest"];
        Request::RemoveOnId($id);
        header('Location:Redirection.php');
    }
    if($_GET["action"] == 1)//sign shamgar
    {
        $id = $_GET["idRequest"];
        $request = Request::getRequestOnId($id);
        $request->setHasShmSign(1);
        $request->setDateShmsign(date("Y/m/d"));
        $request->setOnTypes(1);
        $request->AddorUpgradeRequest();
        header('Location:Redirection.php');
    }
    if($_GET["action"] == 2)//sign CAAI
    {
        $id = $_GET["idRequest"];
        $request = Request::getRequestOnId($id);
        $request->setHasCAAIsign(1);
        $request->setDateCAAIsign(date("Y/m/d"));
        $request->setOnTypes(2);
        $request->AddorUpgradeRequest();
        header('Location:Redirection.php');
    }
    if($_GET["action"] == 3)//sign Air
    {
        $id = $_GET["idRequest"];
        $request = Request::getRequestOnId($id);
        $request->setHaAirforceSign(1);
        $request->setDateAirForcesign(date("Y/m/d"));
        $request->setOnTypes(3);
        $request->AddorUpgradeRequest();
        header('Location:createAndSendPDF.php?idRequest='.$id);
    }
    if($_GET["action"] == 4)//sign Air
    {
        $id = $_GET["idRequest"];
        $request = Request::getRequestOnId($id);
        $request->setHaAirforceSign(0);
        $request->setOnTypes(2);
        $request->AddorUpgradeRequest();
        header('Location:Redirection.php');
    }
    if($_GET["action"] == 5)//sign Air
    {
        $id = $_GET["idRequest"];
        $request = Request::getRequestOnId($id);
        $request->setHasCAAIsign(0);
        $request->setOnTypes(1);
        $request->AddorUpgradeRequest();
        header('Location:Redirection.php');
    }
    if($_GET["action"] == 6)//sign Air
    {
        $id = $_GET["idRequest"];
        $request = Request::getRequestOnId($id);
        $request->setHasShmSign(0);
        $request->setOnTypes(1);
        $request->AddorUpgradeRequest();
        header('Location:Redirection.php');
    }
    if($_GET["action"] == 7)//sign Air
    {
        $id = $_GET["idRequest"];
        $request = Request::getRequestOnId($id);
        $request->setOnTypes(1);
        $request->AddorUpgradeRequest();
        header('Location:Redirection.php');
    }
    ?>