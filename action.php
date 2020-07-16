<?php
//mysqli_stmt :: bind_param - mysqli_stmt_bind_param - קושר משתנים להצהרה מוכנה כפרמטרים
//mysqli_stmt_bind_result () - קושר משתנים להצהרה מוכנה לאחסון תוצאות
//mysqli_stmt_execute () - מבצע שאילתה מוכנה
//mysqli_stmt_fetch () - להביא תוצאות מהצהרה מוכנה למשתנים הכבולים
//mysqli_prepare () - הכן הצהרת SQL לביצוע
//mysqli_stmt_send_long_data () - שלח נתונים בחסימות
//mysqli_stmt_errno () - מחזיר את קוד השגיאה לשיחת ההצהרה האחרונה
//mysqli_stmt_error () - מחזירה תיאור מחרוזת עבור שגיאת הצהרה אחרונה
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
	$stmt=$conn->prepare($query);//mysqli_prepare () - הכן הצהרת SQL לביצוע
	$stmt->bind_param("ssss",$name,$email,$phone,$upload);//קושר משתנים להצהרה מוכנה כפרמטרים
	$stmt->execute();//mysqli_stmt_execute () - מבצע שאילתה מוכנה
	move_uploaded_file($_FILES['image']['tmp_name'],$upload);
	
	header('location:bootstraptray.php');
	$_SESSION['response']="successfully Inserted to the database!";
	$_SESSION['res_type']="success"; 
    
   }
   if(isset($_GET['delete'])){
	   $id=$_GET['delete'];
	   
	   // תצוגה של המחיקת רשומה 
	   $sql="SELECT photo FROM curd WHERE id=?";
	   $stmt2=$conn->prepare($sql);
	   $stmt2->bind_param("i",$id);
	   $stmt2->execute();
	   $result2=$stmt2->get_result();//mysqli_stmt_bind_result () - קושר משתנים להצהרה מוכנה לאחסון תוצאות
	   $row=$result2->fetch_assoc();//mysqli_stmt_fetch () - להביא תוצאות מהצהרה מוכנה למשתנים הכבולים
	   
	   $imagepath=$row['photo'];//התמונה נלקחת מהעמודה בשם PHOTO
       unlink($imagepath);
	   
	   
	   $query="DELETE FROM curd WHERE id=?";
	   $stmt=$conn->prepare($query);
	   $stmt->bind_param("i",$id);
	   $stmt->execute();
	   
	   header('location:bootstraptray.php');
	   $_SESSION['response']="successfully Deleted!";
	   $_SESSION['res_type']="danger";
   }
   	   // כפתור עריכה  
   if(isset($_GET['edit'])){
	   $id=$_GET['edit'];
	   
	   $query="SELECT * FROM curd WHERE id=?";
	   $stmt=$conn->prepare($query);
	   $stmt->bind_param("i",$id);
	   $stmt->execute();
	   $result=$stmt->get_result();
	   $row=$result->fetch_assoc();
	   
	   // להחחזיר את כל הנתונים המעודכנים לבסיס הנתונים
	   $id=$row['id'];
	   $name=$row['name'];// בתוך הסוגררים זה השם של העמודה בטבלה 
	   $email=$row['email'];// מתי שכפתור עריכה ילחץ יכנסו הערכית האלו לקובץ מקושר לטופס באמצעות פרמטטר VALUE
	   $phone=$row['phone'];
	   $photo=$row['photo'];
	   // הוספנו בתחילת הטופס ערך  מסוג מוחבא שהו
	   $update=true;
   }
    if(isset($_POST['update'])){
	   $id=$_POST['id'];// בכפתור של ינפוט אנחנו מקבלים את הנתונים באמצעות ה אי די
	   $name=$_POST['name'];
	   $email=$_POST['email'];
	   $phone=$_POST['phone'];
	   $oldimage=$_POST['oldimage'];//  זה השפ שנתנו לתמונה  בכפתור של הינפוט 
       
	   if(isset($_FILES['image']['name'])&&($_FILES['image']['name']!="")){
        $newimage="uploads/".$_FILES['image']['name'];//סוג הערך של הקובץ הוא תמונה ובכדי לקבל רק את השם שלה זה 
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
	  
	  $_SESSION['response']="פרטי המשתמש עודכנו במערכת בהצלחה  !";
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

