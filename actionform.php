<?php
ob_start();
include 'config.php';
session_start();
$update=false;
$FormID="";
$Company_name="";
$Operational_pilots="";
$Flight_communication="";
$Photography_equipment="";
$Explain_the_nature_of_the_flight="";
$Casual_or_staying_flight="";
// טבלת נקודות 
$PID="";
$start_point="";
$end_point="";
$Track_height="";
$photo="";
 
if(isset($_POST['add'])){
	
    $Company_name=$_POST['Company_name'];
	$Operational_pilots=$_POST['Operational_pilots'];
	$Flight_communication=$_POST['Flight_communication'];
	$Photography_equipment=$_POST['Photography_equipment'];
	$Explain_the_nature_of_the_flight=$_POST['Explain_the_nature_of_the_flight'];
	$Casual_or_staying_flight=$_POST['Casual_or_staying_flight'];
      
	  
	  $query="INSERT INTO reqestform22(Company_name,Operational_pilots,Flight_communication,Photography_equipment,Explain_the_nature_of_the_flight,Casual_or_staying_flight)VALUES(?,?,?,?,?,?)";
	  $stmt=$conn->prepare($query);
	  $stmt->bind_param("ssssss",$Company_name,$Operational_pilots,$Flight_communication,$Photography_equipment,$Explain_the_nature_of_the_flight,$Casual_or_staying_flight);
	  $stmt->execute();
	  header('location:form.php');
	  $_SESSION['response']="successfully Inserted to the database!";
	   $_SESSION['res_type']="success"; 
		
}
if(isset($_POST['add1'])){
	$start_point=($_POST['start_point']);
	$end_point=($_POST['end_point']);
	$Track_height=($_POST['Track_height']);
	
    $photo=basename($_FILES['image']['name']);
    $upload="uploads/".$photo;
	   
	$query="INSERT INTO position(start_point,end_point,Track_height,photo)VALUES(?,?,?,?)";
	$stmt=$conn->prepare($query);
	$stmt->bind_param("ssss",$start_point,$end_point,$Track_height,$upload);
	$stmt->execute();
	move_uploaded_file($_FILES['image']['tmp_name'],$upload);
	
	
	header('location:form.php');
	  $_SESSION['response']="successfully Inserted to the database!";
	  $_SESSION['res_type']="success"; 
		
	
   }
   
   if(isset($_GET['edit'])){
	   $FormID=$_GET['edit'];
	   
	   $query="SELECT * FROM `userspage`.`reqestform22` WHERE `FormID` = RequestForm 
	   ";
	   $stmt=$conn->prepare($query);
	   $stmt->bind_param("i",$FormID);
	   $stmt->execute();
	   $result=$stmt->get_result();
	   $row=$result->fetch_assoc();
	   
	   // להחחזיר את כל הנתונים המעודכנים לבסיס הנתונים
	   $FormID=$row['RequestForm'];
	   $name=$row['name'];// בתוך הסוגררים זה השם של העמודה בטבלה 
	   $email=$row['email'];// מתי שכפתור עריכה ילחץ יכנסו הערכית האלו לקובץ מקושר לטופס באמצעות פרמטטר VALUE
	   $phone=$row['phone'];
	   $photo=$row['photo'];
	   // הוספנו בתחילת הטופס ערך  מסוג מוחבא שהו
	   $update=true;
   }
   
   if(isset($_GET['details'])){
	  $id=$_GET['details']; 
      $query="SELECT * FROM reqestform22 WHERE FormID=?";
      $stmt=$conn->prepare($query);
	  $stmt->bind_param("i",$FormID);
	  $stmt->execute();
	  $result=$stmt->get_result();
	  $row=$result->fetch_assoc();

	  $vFormID=$row['FormID'];
	  $vCompany_name=$row['Company_name'];
	  $vOperational_pilots=$row['Operational_pilots'];
	  $vPhotography_equipment_communication=$row['Photography_equipment'];
	  $vExplain_the_nature_of_the_flight=$row['Explain_the_nature_of_the_flight'];
	  $vCasual_or_staying_flight=$row['Casual_or_staying_flight'];
   }
   ?>