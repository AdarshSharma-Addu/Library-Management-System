<?php
session_start();
    $con=mysqli_connect("localhost","root","","project");
    if(session_status() != PHP_SESSION_ACTIVE){

    }
    if(!isset($_SESSION['success'])){
            header("location:index.php");
    }

    if(isset($_POST['update'])){
        $Fullname=$_POST['FullName'];
        $Email=$_POST['Email'];
        $id=$_SESSION['stdid'];
        $sql="UPDATE register SET FullName='$Fullname',Email='$Email' WHERE id='$id'";
        if(mysqli_query($con,$sql)){
            $_SESSION['updatestatus'] = "Updated successfully";
            header("location:my-account.php");
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
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-4 col-md-4">
                    <?php
                    if(isset($_SESSION['updatestatus'])){
                        ?>
                        <strong> Success :</strong>
                     <?php
                       echo $_SESSION['updatestatus'];
                       unset($_SESSION['updatestatus']);
                    }?>

                    <form class="form-container" method="post">
                        <h3 class="text-center font-weight-bold">My Profile:</h3>
                        <?php
                                $sid=$_SESSION['stdid'];
                                $sql="SELECT id,FullName,Email,Registration_date,Updation_date,Status from register where id='$sid'";
                                $result=mysqli_query($con,$sql);
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_assoc())
                                       {?>
                                           <b>Student id: </b> <p><?php echo htmlspecialchars($row['id']);?></p>
                                           <b>reg Date: </b> <p><?php echo htmlspecialchars($row['Registration_date']);?></p>
                                           <b>Last Updation Date: </b> <p><?php echo htmlspecialchars($row['Updation_date']);?></p>
                                           <b>Status:</b><p><?php if($row['Status']==1){echo "Active";} else{ echo "Inactive"; } ?><p>
                                           <b>Enter Full Name: </b>
                                           <div class="form-group">
                                               <input type="text" class="form-control" name="FullName" value="<?php echo htmlspecialchars($row['FullName']);?>" required>
                                           </div>
                                           <b>Enter E-mail: </b>
                                           <div class="form-group">
                                               <input type="email" class="form-control" name="Email" value="<?php echo htmlspecialchars($row['Email']);?>" required>
                                           </div>
                                           <?php }} ?>

                                           <input type="submit" class="btn btn-success btn-block" name="update" value="update">
                    </form>
                </div>
            </div>
        </div>

  </body>
</html>
