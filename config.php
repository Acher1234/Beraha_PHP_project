<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
function returnAConnexion()
{
  $ipAddress = "localhost:8889";
  $user_name = "Acher";
  $Password = "Project01";
  $databaseName = "ProjectDatabase";
  $conn= new mysqSli($ipAddress,$user_name,$Password,$databaseName);
   
   if ($conn->connect_error){
     die("could not connect to the datebase".$conn->connect_error);
     return "error";
   }
   return $conn;
} 
?>
