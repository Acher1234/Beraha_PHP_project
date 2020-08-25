<?php
session_start();
include_once('config.php')
?>

<!DOCTYPE html>
<html dir="rtl" lang="he-IL" xml:lang="he-IL" >
<meta http-equiv="Content-Type" content="text/html/sahil kumar" charset=utf-8" />

<head>
    <title> מערכת מהצד של שמגר </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>


<body >
<?php
if (!(isset($_SESSION["Connected"]) && $_SESSION["Connected"]))
{
    header("Location:IndexLoginPages.php");
}
require_once('Classes/Types.php');
require_once('Classes/customers.php');
if($_SESSION["Types"] != "Shmgar")
{

}
?>
<head>
    <title> הצד של הלקוח  </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="Notview/style.css">

</head>

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="#">
        <img src="logo_01.png" alt="Logo" style="width:200px;">
    </a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto"
        <!-- Nav pills -->
        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#menu1">change the sign</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " data-toggle="pill" href="#request">See all request</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  data-toggle="pill" href="#menu2">about</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="/LogOut.php">log out</a>
            </li>
        </ul>
        </ul>
    </div>
    <form class="form-inline" action="/actionform_page.php">
        <input class="form-control mr-sm-2" type="text" placeholder="">
        <button class="btn btn-primary" type="submit">Search</button>
    </form>
</nav>

<!-- Tab panes -->
<div class="tab-content">
    <div  id="menu1" class="container tab-pane active">
        <form action="updateSign.php" method="post">
            <input type="file" name="image"  class="custom-fle" accept="image/png" required>
            <br>
            <input type="submit">
        </form>
    </div>
    <div id="request" class="container tab-pane fade"><br>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3 class="text-center text-dark"> מאגר בקשות במערכת לאישור טיסה בטחונית חריגה  </h3>
            </div>
        </div>
        <div class="row justify-content-right" >
            <div class="col-md-8 "  >
                <?php
                $conn = returnAConnexion();
                $query="SELECT * FROM request";
                $stmt =$conn->prepare($query);
                $stmt->execute();
                $result=$stmt->fetchAll();
                ?>

                <h3 class="justify-content-center  text-info ">בקשות לטיפול הפתוחות במערכת </h3>
                <table class="table table-bordered table-hover ">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>בטיפול_אצל:</th>
                        <th>טופס_בקשה</th>
                        <th>תאריך_שליחת_הבקשה:</th>
                        <th>signRequest:</th>
                        <th>remove Sign:</th>
                        <th>accepted ?</th>
                        <th>sent CAAI:</th>
                        <th>sent mail:</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for($i=0;$i<count($result);$i++){ ?>
                        <tr>
                            <td><?= $result[$i]['ID']; ?></td>
                            <td><ul><?= $result[$i]['OnTypul'] == 1 ? "<li>CAAI</li>":"" ?>
                                    <?= $result[$i]['OnTypul'] == 0 ? "<li>Shamgar</li>":"" ?>
                                    <?= $result[$i]['OnTypul'] == 2 ? "<li>AirForce</li>":"" ?></ul></td>
                            <td>
                                <a href="details.php?idRequest=<?= $result[$i]['ID']; ?>" class="badge badge-primary p-2">עריכה /צפיה</a> |
                                <a href="action.php?action=0&idRequest=<?= $result[$i]['ID']; ?>" class="badge badge-danger p-2">מחיקה</a> |
                            </td>
                            <td><?=$result[$i]['Date']?> </td>
                            <td><?php if(!$result[$i]['hasShamgarSign']) echo '<a href="action.php?action=1&idRequest=' .$result[$i]['ID']. '"class="badge badge-danger p-2">sign this request</a>';?></td>
                            <td><?php
                                if($result[$i]['hasAirFSign'])
                                echo '<a href="action.php?action=4&idRequest='. $result[$i]['ID'] .'" class="badge badge-danger p-2">Remove Air sign</a>';
                                if($result[$i]['hasCAAISign'])
                                    echo '<a href="action.php?action=5&idRequest='. $result[$i]['ID'] .'" class="badge badge-danger p-2">Remove CIIA sign</a>';
                                if($result[$i]['hasShamgarSign'])
                                    echo '<a href="action.php?action=6&idRequest='. $result[$i]['ID'] .'" class="badge badge-danger p-2">Remove Shamgar sign</a>';
                            ?></td>
                            <td><?= $result[$i]['hasCAAISign'] ?  "YES":"NO"; ?></td>
                            <td><?=$result[$i]['OnTypul'] == 0 ? '<a href="\action.php?action=7&idRequest='. $result[$i]['ID'] .'"class=\"badge badge-danger p-2\">sent</a>':""?></td>
                            <td><a href="mailto:<?=Personnes::GetmailFromID($result[$i]['CLIENTID'])?>" class="badge badge-primary">sent mail</a></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="menu2" class="container tab-pane fade"><br>
        <form action="AddspecialUser.php" method="post" class="col-4">
            <div class="textbox">


                <i class="fas fa-user"></i>
                <input type="text" id="userNameVal" placeholder="שם משתמש" name="user_name" required>
                <small id="smallUser" style="display: none">username already taken</small>
            </div>
            <div class="textbox">

                <i class="far fa-envelope"></i>
                <input type="text" id="mailVal" placeholder="מייל" name="mail" required>
                <small id="smallMail" style="display: none">mail already in the system</small>
            </div>

            <div class="textbox">

                <i class="fas fa-phone"></i>
                <input type="number" id="phoneVal" placeholder="פאלפון" name="phone" required>
            </div>

            <div class="textbox">
                <i class="fas fa-lock"></i>
                <input type="password" id="passwordVal" placeholder="סיסמה" name="password" required>
            </div>
            <input list="browsers" name="Types" required>
            <datalist id="browsers">
                <option selected value="Shmgar" >
                <option value="CAAI">
                <option value="Air_Force">
            </datalist>
            <input type="submit"  class="btn"/>
        </form>

    </div>
</div>



</body>
</html>