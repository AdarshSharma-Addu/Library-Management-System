<?php
    session_start();
    $error=$username=$password='';
    $con=mysqli_connect('localhost','root','','project');


    if(isset($_POST['login'])){
        $username=mysqli_real_escape_string($con,$_POST['uname']);
        $password=mysqli_real_escape_string($con,$_POST['pass']);
        $sql="SELECT * FROM admin WHERE UserName = '$username' AND Password = '$password'";
        $r = mysqli_query($con,$sql);
        if (mysqli_num_rows($r) == 1){
            $_SESSION['username']=$username;
            $_SESSION['success']=" admin You are successfully logged in";
            header('location:manage_book.php');
        }
        else{
            $error="Invalid username/password";
        }
    }
?>

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
	<a href="../index.php" class="navbar-brand" >
		<img src="../images/logo.png">  library
	</a>
	<ul class="nav ml-auto nav-pills">
	  <li class="nav-item"><a class="nav-link active" href="../index.php">Home</a></li>

	</ul>
</nav>

<div class="container-fluid bg-blur">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-4 col-md-4">
              <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form-container img-form">

                  <h3 class="text-center font-weight-bold">Admin Login:</h3><br>
                      <?php if($error != ''): ?>
                          <div class='error'>
                              <?php echo "$error";?>
                          </div>
                      <?php endif ?>
                    <div class="form-group">
                            <input class="form-control" type="text" name="uname" placeholder="Enter Username" required>
                    </div>
                    <div class="form-group">
                            <input class="form-control" type="password" name="pass" placeholder="Enter password" required>
                    </div>
                  <input class="btn btn-success form-control" type="submit" name="login" value="LOGIN">

              </form>
    </div>
    </div>
</div>
  </body>
</html>
