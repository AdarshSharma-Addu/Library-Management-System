<?php
session_start();
$sql=$currentpass=$newpass=$repass=$error="";
$con=mysqli_connect("localhost","root","","project");
if(session_status() != PHP_SESSION_ACTIVE){
    session_start();
}
    if(!isset($_SESSION['success'])){
            header("location:index.php");
    }
    if(isset($_POST['submit'])){

       $currentpass = $_POST['currentpass'];
       $newpass=$_POST['newpass'];
       $repass=$_POST['repass'];
       $id=$_SESSION['stdid'];

       $sql="SELECT Password FROM register WHERE id='$id'";
       $res=mysqli_query($con,$sql);
       if($res->num_rows > 0){
           $row = $res->fetch_assoc();
               if($row['Password']==$currentpass){
                       if($newpass==$repass){

                           $sql="UPDATE register SET Password='$newpass' where id='$id'";
                               if(mysqli_query($con,$sql)){

                                   header("location:change-password.php");
                               }
                           }
                       else{
                           $error="New password doesn't match";
                       }
                   }
               }
               else{
                   $error="Wrong password";
               }
        }


 ?>


<Doctype html>
  <html>
    <head>
        <title>Login form Design</title>
        	<meta charset="utf-8">
        	<meta name="viewport" content="width=device-width,initial-scale=1">
        	<link rel="stylesheet" type="text/css" href="librarynew.css">
        	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
        	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <!-- jQuery library -->
        </head>
        <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        	<a href="index.php" class="navbar-brand" >
        		<img src="images/logo.png">  library
        	</a>
        	<ul class="nav ml-auto nav-pills">

        	  <li class="nav-item"><a class="nav-link active" href="index.php">HOME</a></li>

              <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#about">BOOK CATEGORIES<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <?php

                        $sql="SELECT id,categoryname FROM tblcategory";
                        $result=mysqli_query($con,$sql);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){?>
                                <li class="nav-item"><a class="nav-link" href="viewbook.php?id=<?php echo htmlentities($row['id']);?>"> <?php echo $row["categoryname"]; ?></a></li>

                        <?php }} ?>

                  </ul>
              </li>
              <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"> ACCOUNT <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="nav-item"><a class="nav-link" href="my-account.php">MY ACCOUNT</a></li>
                  	     <li class="nav-item"><a class="nav-link" href="change-password.php">CHANGE_PASSWORD</a></li>
                    </ul>
                </li>
        	  <li class="nav-item"><a class="nav-link" href="issued-book.php">ISSUED BOOKS</a></li>
              <button class="btn btn-danger navbar-btn"><a href="logout.php" class="nounderline">Log Out</a></button>
        	</ul>
        </nav>
    </head>
    <div class="container-fluid">
    	<div class="row justify-content-center">
    		<div class="col-12 col-sm-4 col-md-4">

                 <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form-container" >
                     <h3 class="text-center font-weight-bold">Change Password:</h3>
                     <?php if($error != ''): ?>
                         <div class="error bg-danger">
                             <b><?php echo "$error";?></b>
                         </div>
                     <?php endif ?>
                     <div class="form-group">
                     <b>Current Password:
                         <br><input type="password" class="form-control" name="currentpass" placeholder="Current Password" required><br>
                     </div>
                     <div class="form-group">
                      <b>New Password:
                         <br><input type="password" class="form-control" name="newpass" placeholder="New Password" required><br>
                     </div>
                     <div class="form-group">
                      <b>Re-enter Password:
                          <br><input type="password" class="form-control" name="repass" placeholder="Re-enter Password" required><br>
                      </div>
                      <div class="form-group">
                      <input type="submit" class="form-control btn btn-success" name="submit" value="Update">
                  </div>
                 </form>
             </div>
         </div>
     </div>
  </body>
</html>
