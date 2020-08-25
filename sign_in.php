<?php session_start();?>
<!DOCTYPE html>
<html lang="he" dir="rtl">
  
<div dir="ltr" color=black>
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

        <link rel="stylesheet" href="Notview/style.css">

    </head>

    <body class="text-center">

    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->

        <img src="logo_01.png" alt="Logo" style="width:300px ;height:60PX ;padding:5px;">


        <!-- Navbar links -->
    </nav>
<p> שלום אורח/ת </p>
</div>


<script>
    function badText()
    {
        $("#submitBut").addClass("btn-danger");
        setTimeout(()=>{$("#submitBut").removeClass("btn-danger");},1500);
    }
    $(document).ready(function(){
    $("#submitBut").click(function ()
    {
        if($("#userNameVal").val() == ""){badText();return;}
        if($("#mailVal").val() == ""){badText();return;}
        if($("#phoneVal").val() == NaN){badText();return;}
        if($("#passwordVal").val() == ""){badText();return;}
        var array = {user_name:$("#userNameVal").val(),phone:$("#phoneVal").val(),mail:$("#mailVal").val(),password:$("#passwordVal").val()}
        $.post("/Addclient.php",array,//need to crypt pass here
            function(data)
            {
                console.log(data);
                if(data == "ok")
                {
                    window.location.href = "/indeLoginPages.php"
                }
                else if(data == "mail already exist")
                {
                    $("#smallMail").css("display","inline");//aficher
                }
                else if(data == "username already exist")
                {
                    $("#smallUser").css("display","inline");//aficher
                }
            })})})
</script>
  
<div class="login-box">
  <h1>הרשמה</h1>
  <form>
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

      <input type="submit" onclick="return false;" id="submitBut" class="btn">כניסה</input>
  </form>
²
</div>


  </body>
</html>
