    
<?php

/*function upload_image()
{
 if(isset($_FILES["user_image"]))
 {
  $extension = explode('.', $_FILES['user_image']['name']);
  $new_name = rand() . '.' . $extension[1];
  $destination = './upload/' . $new_name;
  move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
  return $new_name;
 }
}

function get_image_name($user_id)
{
 include('db.php');
 $statement = $connection->prepare("SELECT image FROM users WHERE id = '$user_id'");
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row["image"];
 }
}

function get_total_all_records()
{
 include('db.php');
 $statement = $connection->prepare("SELECT * FROM users");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->row_array();
}*/

function SetUserSession($user,$pass)
{
  include_once("config.php");
  include 'Classes/Personnes.php';
  $connexion = returnAConnexion();
  if(!$connexion)
  {
   echo "could not connect to the datebase".$connexion->connect_error;
   die();
  }
  $stm = $connexion->prepare("Select * FROM user WHERE user_name = ?");
  $stm->execute([$user]);
  $r = $stm->fetchAll();
  if(count($r) == 0)
  {
    return false;
  }
  if(password_verify($pass,$r[0]["Password"]))
  {
   require_once('Classes/Types.php');
   $user = new Personnes($r[0]["user_name"], $r[0]["mail"], $r[0]["Telephone"], $r[0]["Password"], $r[0]["ID"],$r[0]["types"]);
   $_SESSION["User"] = serialize($user);
   $_SESSION["Connected"] = true;
   $_SESSION["Types"] = $r[0]["types"];
   return true;
  }
  return false;
}

?>
   
