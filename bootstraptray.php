<?php
include 'action.php';
?>

<!DOCTYPE html> 
<html dir="rtl" lang="he-IL" xml:lang="he-IL" >
<meta http-equiv="Content-Type" content="text/html/sahil kumar" charset=utf-8" />
 <?php header('Content-Type: text/html; charset=utf-8'); ?>
   
<head>
 <title> מערכת מהצד של שמגר </title>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 </head>
 

  <body >
     <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">
    <img src="logo_01.png" alt="Logo" style="width:200px;">
  </a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto" 
	<!-- Nav pills -->
	 <ul class="nav nav-pills" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="pill" href="#menu1">מאגר משתמשים </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " data-toggle="pill" href="#request">מאגר בקשות</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  data-toggle="pill" href="#menu2">about</a>
      </li>
	  </ul>
    </ul> 
  </div>
  <form class="form-inline" action="/action_page.php">
       <input class="form-control mr-sm-2" type="text" placeholder="Search">
       <button class="btn btn-primary" type="submit">Search</button>
  </form>
</nav>
<input type='time' id='myTime' /> 
<input type="date"  name="flb5" placeholder="Datum" class="datePickerPlaceHolder"/> 
<input type="date" id="myDate" >

<!-- Tab panes -->
  <div class="tab-content">
  <div  id="menu1" class="container tab-pane active">
    <div class="row justify-content-center">
	  <div class="col-md-10">
	    <h3 class="text-center text-dark"> מאגר משתמשים במערכת לאישור בקשות לטיסה בטחונית חריגה  </h3> 
		  <?php if(isset($_SESSION['response'])){ ?>
		  <div class="alert alert-<?= $_SESSION['res_type'];?> alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
          <b><?=$_SESSION['response'];?></b>
		  </div>  
		  <?php } unset($_SESSION['response']); ?>
	  </div>
	</div>
	  <div class="row" >
        <div class="col-md-4"  >
		  <h3 class="text-center text-info">  הוספת משתמש חדש </h3>
         	<form action="action.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id; ?>">
			  
			  <div class="form-group">
                <input type="text" name="name" value="<?= $name; ?>" class="form-control" placeholder="Enter name" required>
			  </div>
			  <div class="form-group">
               <input type="email" name="email"  value="<?= $email; ?>" class="form-control" placeholder="Enter e-mail" required>
			  </div>
		      <div class="form-group">
                <input type="tel" name="phone" value="<?= $phone; ?>" class="form-control" placeholder="Enter phone" required>
			 </div>	 
	         <div class="form-group">
			    <input type="hidden" name="oldimage" value="<?= $photo; ?>">
                <input type="file" name="image"  class="custom-file" accept="image/gif, image/jpeg, image/png">
			    <img src="<?= $photo; ?>" width="120" class="img-thumbnail">
			 </div> 
			 
			 <div class="form-group">
			 <?php if($update==true){?>
			   <input type="submit" name="update" class="btn btn-success btn-block" value="Update Record">
			 <?Php } else { ?>
			   <input type="submit" name="add" class="btn btn-primary btn-block" value="Add Record">
			 <?php }?>
			 </div> 
           </form>	
		</div>
		<div class="col-md-8"  >
		  <?php
		    $query="SELECT * FROM curd";
			$stmt =$conn->prepare($query);
			$stmt->execute();
			$result=$stmt->get_result();
		  ?>
	
		 <h3 class="text-center text-info"> משתמשים קימים במערכת  </h3>
         	<table class="table table-bordered table-hover">
              <thead>
                   <tr>
                    <th>#</th>
                    <th>image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>phone</th>
                    <th>Action</th>			
                   </tr>
             </thead>
               <tbody>
			      <?php while($row=$result->fetch_assoc()){ ?>
                   <tr>
                    <td><?= $row['id']; ?></td>
                    <td><img src="<?=$row['photo'];?>" width="25"></td>
                    <td><?=$row['name'];?></td>
					<td><?=$row['email'];?></td>
					<td><?=$row['phone'];?></td>
					<td>
					 <a href="details.php?details=<?= $row['id']; ?>" class="badge badge-primary p-2">Details</a> |
					 <a href="action.php?delete=<?= $row['id']; ?>" class="badge badge-danger p-2">Delete</a> |
					 <a href="bootstraptray.php?edit=<?= $row['id']; ?>" class="badge badge-success p-2">Edit</a>|
					</td>
                  </tr>
				  <?php }?>
             </tbody>
         </table>
		</div>
	  </div>
  </div>
    <div id="request" class="container tab-pane fade"><br>
      <div class="row justify-content-center">
	    <div class="col-md-10">
	    <h3 class="text-center text-dark"> מאגר בקשות במערכת לאישור טיסה בטחונית חריגה  </h3> 
		  <?php if(isset($_SESSION['response'])){ ?>
		  <div class="alert alert-<?= $_SESSION['res_type'];?> alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
          <b><?=$_SESSION['response'];?></b>
		  </div>  
		  <?php } unset($_SESSION['response']); ?>
	  </div>
	  </div>
	  <div class="row justify-content-right" >
        <div class="col-md-8 "  >
		  <?php
		    $query="SELECT * FROM request";
			$stmt =$conn->prepare($query);
			$stmt->execute();
			$result=$stmt->get_result();
		  ?>
	
		 <h3 class="justify-content-center  text-info ">בקשות לטיפול הפתוחות במערכת </h3>
         	<table class="table table-bordered table-hover ">
              <thead>
                   <tr>
                    <th>#</th>
                    <th>סוג_הבקשה</th>
                    <th>סיווג_הבקשה</th>
                    <th>לקוח_פונה </th>
					<th>טופס_בקשה</th>
                    <th>בטיפול_אצל:</th>
                    <th>סטטוס_הבקשה</th>
					<th>תאריך_שליחת_הבקשה:</th>
                    <th> ביצוע_פעולות_בטופס_הבקשה:</th>					
                   </tr>
             </thead>
               <tbody>
			      <?php while($row=$result->fetch_assoc()){ ?>
                   <tr>
				   <td><?= $row['RequestID']; ?></td>
                    <td><?=$row['R_Type'];?></td>
                    <td><?=$row['R_Classification'];?></td>
					<td><?=$row['Customer'];?></td>
					<td><?=$row['R_Form'];?><a href="form.php?edit=<?= $row['RequestID']; ?>" class="badge badge-success p-2"> לטופס </a> |</td>
					<td><?=$row['R_Handler'];?></td>
					<td><?=$row['R_Status'];?></td>
					<td><?=$row['Date_send_r'];?></td>
					<td>
					 <a href="details.php?details=<?= $row['RequestID']; ?>" class="badge badge-primary p-2">צפיה</a> |
					 <a href="action.php?delete=<?= $row['RequestID']; ?>" class="badge badge-danger p-2">מחיקה</a> |
					 <a href="edit.php?edit=<?= $row['RequestID']; ?>" class="badge badge-success p-2">עריכה</a>|
					</td>
	                </tr>
				  <?php }?>
             </tbody>
         </table>
		</div>
	  </div>
  </div>
  
   <div id="menu2" class="container tab-pane fade"><br>
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div> 
 </div>
    
  
  
  </body>
</html>