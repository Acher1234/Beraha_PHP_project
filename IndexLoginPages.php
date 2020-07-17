<?php
session_start();
if(isset($_SESSION["Connected"]) && $_SESSION["Connected"])
{
  header("Location:/LogedPages.php");
}
if(isset($_POST["user_name"]))
{
  include("config.php");
  $connexion = returnAConnexion();
  $connexion->prepare("Select * into user WHERE user_name = ?");
  $connexion->bind_param("s",$_POST["user_name"]);
  $connexion->
}
$_SESSION["User"] = "";
$_SESSION["Connected"] = false;

?>
<!DOCTYPE html>
<html lang="he" dir="rtl">
  <head>
 
   
   

 <title> כניסה למערכת  </title>
  <meta charset="utf-8">
    
    
	
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
	   
	   <link rel="stylesheet" href="style.css">
	   
 </head>

  <body class="text-center">
   <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  
    <img src="logo_01.png" alt="Logo" style="width:300px ;height:60PX ;padding:5px;">

  
  <!-- Navbar links -->
  </nav>
  
<div dir="ltr" color=black>
<p> שלום אורח/ת </p>
</div>
  
  
  
<div class="login-box">
  <h1>התחברות</h1>
  <div class="textbox">
  <form action="" method="POST">
    <i class="fas fa-user"></i>
    <input type="text" placeholder="שם משתמש" name="user_name"  require>
  </div>

  <div class="textbox">
    <i class="fas fa-lock"></i>
    <input type="password" placeholder="סיסמה" name="password" require>
  </div>

  <input type="submit" class="btn" value="כניסה">
  <br>
  </form>
  <a href="singin1.php" class="mt-5 mb-3 text-muted">צור חשבון </a>
</div>


  </body>
</html>
