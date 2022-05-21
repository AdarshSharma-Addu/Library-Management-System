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
        	<a href="#" class="navbar-brand" >
        		<img src="images/logo.png">  library
        	</a>
        	<ul class="nav ml-auto nav-pills">
        	  <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
        	  <li class="nav-item"><a class="nav-link" href="Register.php">Student Register</a></li>
        	  <li class="nav-item"><a class="nav-link" href="login.php">Student login</a></li>
        	</ul>
        </nav>
        <div class="container-fluid bg-blur">
        	<div class="row justify-content-center">
        		<div class="col-12 col-sm-4 col-md-4 " >
                      <form method="post"  action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form-container img-form">
                          <h3 class="text-center font-weight-bold">Registration</h3>
                            <p class="bg-danger"><?php include('registerError.php'); ?></p>

                        <div class="form-group">

                          <br><input type="text" class="form-control" name="rname" placeholder="Enter Full name" required>
                      </div>

                      <div class="form-group">

                          <input type="text"  class="form-control" name="runame" placeholder="Enter Username" required>
                      </div>

                      <div class="form-group">

                          <input type="email" class="form-control" name="remail" placeholder="Enter Email" required>
                      </div>

                      <div class="form-group">

                          <input type="password" class="form-control" name="rpass" placeholder="Enter Password" required>
                      </div>

                      <div class="form-group">

                          <input type="password" class="form-control" name="rrepass" placeholder="Enter Password" required>
                      </div>

                      <div class="form-group">
                          <input type="submit" class="form-control btn btn-success" name="register" value="Register">
                      </div>
                      </form>

    </body>
  </html>
