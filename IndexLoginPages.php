<?php session_start();?>
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
	   
	   <link rel="stylesheet" href="Notview/style.css">
	   
 </head>
  <?php
  if (isset($_SESSION["Connected"]) && $_SESSION["Connected"])
  {
      header("Location:/ClientLogged.php");
  }
  ?>
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
  <?php
  include_once("function.php");
  if(isset($_POST["user_name"]))
  {
      $boolean = SetUserSession($_POST["user_name"], $_POST["password"]);
      if ($boolean)
      {
            Header("Location:/Redirection.php");
      }
      if (!$boolean) {
          $_SESSION["User"] = "";
          $_SESSION["Connected"] = false;
      }
  }


  ?>

  <body class="text-center">
  
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
  <input type="submit" class="btn <?php  if(isset($boolean)){echo "btn-outline-danger";}?>" value="כניסה">
  <br>
  </form>
  <a href="sign_in.php" class="mt-5 mb-3 text-muted">צור חשבון </a>
</div>


  </body>
</html>
