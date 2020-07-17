<?php
session_start();
if(isset($_SESSION["Connected"]) && $_SESSION["Connected"])
{
  header("Location:/LogedPages.php");
}
if(isset($_POST["user_name"]))
{

  include("config.php");
  $connextion = returnAConnexion();
  print_r($connextion);

}
$_SESSION["User"] = "";
$_SESSION["Connected"] = false;

?>
<!DOCTYPE html>
<html lang="he" dir="rtl">

<?include_once("NavbarLink.php")?>
  
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
  <a href="sign_in.php" class="mt-5 mb-3 text-muted">צור חשבון </a>
</div>


  </body>
</html>
