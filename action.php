<?php
//mysqli_stmt :: bind_param - mysqli_stmt_bind_param - ���� ������ ������ ����� ��������
//mysqli_stmt_bind_result () - ���� ������ ������ ����� ������ ������
//mysqli_stmt_execute () - ���� ������ �����
//mysqli_stmt_fetch () - ����� ������ ������ ����� ������� �������
//mysqli_prepare () - ��� ����� SQL ������
//mysqli_stmt_send_long_data () - ��� ������ �������
//mysqli_stmt_errno () - ����� �� ��� ������ ����� ������ �������
//mysqli_stmt_error () - ������ ����� ������ ���� ����� ����� ������
session_start();
include 'config.php';
$update=false;
$id="";
$name="";
$email="";
$phone="";
$photo="";


 if(isset($_POST['add'])){
	$name=$_POST['name'];
    $email=$_POST['email'];	
    $phone=$_POST['phone'];
	
	$photo=basename($_FILES['image']['name']);
	$upload="uploads/".$photo;
	$photo=($_FILES['image']['name']);
	$upload="uploads/".$photo;
	
	
	$query="INSERT INTO curd(name,email,phone,photo)VALUES(?,?,?,?)";
	$stmt=$conn->prepare($query);//mysqli_prepare () - ��� ����� SQL ������
	$stmt->bind_param("ssss",$name,$email,$phone,$upload);//���� ������ ������ ����� ��������
	$stmt->execute();//mysqli_stmt_execute () - ���� ������ �����
	move_uploaded_file($_FILES['image']['tmp_name'],$upload);
	
	header('location:bootstraptray.php');
	$_SESSION['response']="successfully Inserted to the database!";
	$_SESSION['res_type']="success"; 
    
   }
   if(isset($_GET['delete'])){
	   $id=$_GET['delete'];
	   
	   // ����� �� ������ ����� 
	   $sql="SELECT photo FROM curd WHERE id=?";
	   $stmt2=$conn->prepare($sql);
	   $stmt2->bind_param("i",$id);
	   $stmt2->execute();
	   $result2=$stmt2->get_result();//mysqli_stmt_bind_result () - ���� ������ ������ ����� ������ ������
	   $row=$result2->fetch_assoc();//mysqli_stmt_fetch () - ����� ������ ������ ����� ������� �������
	   
	   $imagepath=$row['photo'];//������ ����� ������� ��� PHOTO
       unlink($imagepath);
	   
	   
	   $query="DELETE FROM curd WHERE id=?";
	   $stmt=$conn->prepare($query);
	   $stmt->bind_param("i",$id);
	   $stmt->execute();
	   
	   header('location:bootstraptray.php');
	   $_SESSION['response']="successfully Deleted!";
	   $_SESSION['res_type']="danger";
   }
   	   // ����� �����  
   if(isset($_GET['edit'])){
	   $id=$_GET['edit'];
	   
	   $query="SELECT * FROM curd WHERE id=?";
	   $stmt=$conn->prepare($query);
	   $stmt->bind_param("i",$id);
	   $stmt->execute();
	   $result=$stmt->get_result();
	   $row=$result->fetch_assoc();
	   
	   // ������� �� �� ������� ��������� ����� �������
	   $id=$row['id'];
	   $name=$row['name'];// ���� �������� �� ��� �� ������ ����� 
	   $email=$row['email'];// ��� ������ ����� ���� ����� ������ ���� ����� ����� ����� ������� ������ VALUE
	   $phone=$row['phone'];
	   $photo=$row['photo'];
	   // ������ ������ ����� ���  ���� ����� ���
	   $update=true;
   }
    if(isset($_POST['update'])){
	   $id=$_POST['id'];// ������ �� ����� ����� ������ �� ������� ������� � �� ��
	   $name=$_POST['name'];
	   $email=$_POST['email'];
	   $phone=$_POST['phone'];
	   $oldimage=$_POST['oldimage'];//  �� ��� ����� ������  ������ �� ������ 
       
	   if(isset($_FILES['image']['name'])&&($_FILES['image']['name']!="")){
        $newimage="uploads/".$_FILES['image']['name'];//��� ���� �� ����� ��� ����� ����� ���� �� �� ��� ��� �� 
	    unlink($oldimage);
		move_uploaded_file($_FILES['image']['tmp_name'], $newimage);
	  }
	  else{
		  $newimage=$oldimage;
	  }
	  $query="UPDATE curd SET name=?, email=?, phone=?, photo=? WHERE id=?";
      $stmt=$conn->prepare($query);
	  $stmt->bind_param("ssssi",$name,$email,$phone,$newimage,$id);
	  $stmt->execute();
	  
	  $_SESSION['response']="���� ������ ������ ������ ������  !";
	  $_SESSION['res_type']="primary";
	 
	  header('location:bootstraptray.php');
 }  
 
   if(isset($_GET['details'])){
	  $id=$_GET['details']; 
      $query="SELECT * FROM curd WHERE id=?";
      $stmt=$conn->prepare($query);
	  $stmt->bind_param("i",$id);
	  $stmt->execute();
	  $result=$stmt->get_result();
	  $row=$result->fetch_assoc();
	  
	  $vid=$row['id'];
	  $vname=$row['name'];
	  $vemail=$row['email'];
	  $vphone=$row['phone'];
	  $vphoto=$row['photo'];
   }
	
?>

