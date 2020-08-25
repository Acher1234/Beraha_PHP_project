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
if($_SESSION["Types"] != "CAAI" && $_SESSION["Types"] != "Air_Force")
{
    header("Location:Redirection.php");
}
if($_SESSION["Types"] == "CAAI")
{
    $Action = 2;
    $Request = "hasCAAISign";
}
else
{
    $Action = 3;
    $Request = "hasAirFSign";
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
    <!-- עיצוב לתיבת בחירה תאריך -->

    <!--  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
      <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> -->




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
                <a class="nav-link active" data-toggle="pill" href="#menu1">ChangeTheSign</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " data-toggle="pill" href="#request">See all request</a>
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
                if($Request == "hasCAAISign")
                {
                    $query="SELECT * FROM request WHERE hasCAAISign=false AND ontypul=1";
                }
                else
                {
                    $query="SELECT * FROM request WHERE hasAirFSign=false AND ontypul=2";
                }
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
                            <td><a href="action.php?action=<?=$Action?>&idRequest=<?= $result[$i]['ID']; ?>" class="badge badge-danger p-2">sign this request</a></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="menu2" class="container tab-pane fade"><br>

    </div>
</div>
</div>



</body>
</html>
