<?php
include 'action.php';
?>

<!DOCTYPE html> 
<html dir="rtl" lang="he-IL" xml:lang="he-IL" >
<meta http-equiv="Content-Type" content="text/html/sahil kumar" charset=utf-8" />
 <?php header('Content-Type: text/html; charset=utf-8'); ?>
   
<head>
 <title> CRUD APP </title>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 </head>
 

  <body  >
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
        <a class="nav-link active" data-toggle="pill" href="#menu1">מאגר משתמשים </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " data-toggle="pill" href="#request">מאגר בקשות</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  data-toggle="pill" href="#menu2">about</a>
      </li>
	  </ul>
    </ul> 
  </div>
  <form class="form-inline" action="/action_page.php">
       <input class="form-control mr-sm-2" type="text" placeholder="Search">
       <button class="btn btn-primary" type="submit">Search</button>
  </form>
</nav>
 <div class="container">
   <div class="row justify-content-center">
     <div class="col-md-6 mt-3 bg-info p-4 rounded">
	  <h2 class="bg-light p-2 rounded text-center text-dark ">מספר רשומה :<?= $vid; ?></h2>
	 <div class="text-center">
	  <img src="<?=$vphoto; ?>"  width="300" class="img-thumbnail">
	 </div>
	  <h4 class="text-light text-right">שם : <?=$vname; ?></h4>
	  <h4 class="text-light text-right">כתובת מייל  : <?=$vemail; ?></h4>
	  <h4 class="text-light text-right">מספר טלפון  : <?=$vphone; ?></h4>
	 </div>
  </div>
 </div>
</body>
</html>