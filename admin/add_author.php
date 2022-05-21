<?php
session_start();
$con=mysqli_connect("localhost","root","","project");
if(!isset($_SESSION['success'])){
    header("location:index.php");
}
if(isset($_POST['authorsubmit'])){
    $author_name=$_POST['autname'];
    $sql="INSERT INTO tblauthor (id,author_name)
        VALUES('','$author_name')";
    if(mysqli_query($con,$sql)){
        $_SESSION['msg']="successfully added";
        header('location:manage_author.php');
    }
}
 ?>
 <doctype html>
   <html>
   <title>Library</title>
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
    <a href="main.php" class="navbar-brand" >
        <img src="../images/logo.png">  library
    </a>
    <ul class="nav ml-auto nav-pills">
         <li class="nav-item"><a class="nav-link active" href="../index.php" class='active'>HOME</a></li>
         <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"> CATEGORIES <span class="caret"></span></a>
               <ul class="dropdown-menu">
                   <li class="nav-item"><a class="nav-link" href="addcategory.php">ADD CATEGORY</a></li>
                    <li class="nav-item"><a class="nav-link" href="manage_category.php">MANAGE CATEGORY</a></li>
               </ul>
           </li>
          <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"> AUTHORS <span class="caret"></span></a>
                 <ul class="dropdown-menu">
                     <li class="nav-item"><a class="nav-link" href="add_author.php">ADD AUTHOR</a></li>
                      <li class="nav-item"><a class="nav-link" href="manage_author.php">MANAGE AUTHORS</a></li>
                 </ul>
         </li>
         <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"> BOOKS <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item"><a class="nav-link" href="add_book.php">ADD BOOK</a></li>
                     <li class="nav-item"><a class="nav-link" href="manage_book.php">MANAGE BOOKS</a></li>
                </ul>
        </li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">ISSUE BOOKS <span class="caret"></span></a>
               <ul class="dropdown-menu">
                   <li class="nav-item"><a class="nav-link" href="issuebook.php">ISSUE NEW BOOK</a></li>
                    <li class="nav-item"><a class="nav-link" href="manageissuebook.php">MANAGE ISSUED BOOKS</a></li>
               </ul>
       </li>
          <li class="nav-item"><a class="nav-link" href="Registered_students.php">REGISTERED STUDENTS</a></li>
              <li class="nav-item"><a class="nav-link" href="change_password.php">CHANGE PASSWORD</a></li>
              <button class="btn btn-danger navbar-btn"><a href="logout.php" class="nounderline">Log Out</a></button>
    </ul>
   </nav>
   <div class="container-fluid">
       <div class="row justify-content-center">
           <div class="col-12 col-sm-4 col-md-4">
                  <form method="post" class="form-container" >
                        <h3 class="text-center font-weight-bold" >ADD AUTHOR:</h3>

                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Author Name" name="autname" required>
                        </div>

                        <input type="submit" class="btn btn-success form-control" name="authorsubmit" value="Submit">
                  </form>
            </div>
        </div>
    </div>

</body>

</html>
