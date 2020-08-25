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
function ReturnAllMail($id)
{
  $request = returnAConnexion();
  $stm = $request->prepare("SELECT * FROM user");
  $stm->execute();
  $r = $stm->fetchAll();
  $Return = [];
  for ($i = 0;$i<count($r);$i++)
  {
    if($r[$i]["types"] != "custommer" || $r[$i]["ID"] == $id)
    {
      if (filter_var($r[$i]["mail"], FILTER_VALIDATE_EMAIL))
        array_push($Return,$r[$i]["mail"]);
    }
  }
  return $Return;
}
?>
