<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
  $conn= new mysqli("localhost", "root","","rata");
   
   if ($conn->connect_error){
	   die("could not connect to the datebase".$conn->connect_error);
   }
  
?>
