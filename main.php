<?php
if(session_status() != PHP_SESSION_ACTIVE){
    session_start();
}

    if(!$_SESSION['success']){
            header("location:index.php");
    }
 ?>
<Doctype html>
  <html>
    <head>
        <title>Login form Design</title>
        	<meta charset="utf-8">
        	<meta name="viewport" content="width=device-width,initial-scale=1">
        	<?php include('server.php'); ?>
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

        	  <li class="nav-item"><a class="nav-link active" href="main.php">DASHBOARD</a></li>

              <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#about">BOOK CATEGORIES<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <?php

                        $con=mysqli_connect("localhost","root","","project");
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
        <div class="container-fluid bg">
        </div>
  </body>
</html>
