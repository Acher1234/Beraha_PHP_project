<?php
function returnAConnexion():PDO
{
  $ipAddress = "localhost:8889";
  $user_name = "Acher";
  $Password = "Project01";
  $databaseName = "projectdatabase";
  $sdn = 'mysql:host='.$ipAddress.';dbname='.$databaseName;
  $conn= new PDO($sdn,$user_name,$Password);
  if(!$conn)
  {
      die("could not connect to the datebase".$conn->connect_error);
      return 'error';
  }
  return $conn;
} 
?>
