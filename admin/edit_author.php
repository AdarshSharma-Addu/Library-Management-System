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
                <form method="post" class="form-container">
                    <?php
                     $id=$_GET['id'];
                     $con=mysqli_connect("localhost","root","","project");
                     $sql="SELECT * FROM tblauthor WHERE id = '$id'";
                     $result=mysqli_query($con,$sql);
                     if($result->num_rows > 0){
                         while($row = $result->fetch_assoc())
                            {?>

                      <h3 class="text-center font-weight-bold">EDIT Author:</h3>
                      <b>Author Name</b>
                       <div class="form-group">
                           <input type="text" class="form-control" name="auname" value="<?php echo htmlspecialchars($row['author_name']);?>" required>
                       </div>
                       <div class="form-group">
                           <input type="submit" class="btn btn-success form-control" name="update" value="Update">
                       </div>
                  <?php } }?>
                </form>
            </div>
        </div>
    </div>
    </body>
    <?php
    session_start();
        if(isset($_POST['update'])){

            $author_name=$_POST['auname'];
            $sql="UPDATE tblauthor SET author_name='$author_name' WHERE id='$id'";
            if(mysqli_query($con,$sql)){
                $_SESSION["msg"] = "updated";
                header('location:manage_author.php');
            }
        }
        if(!isset($_SESSION['success'])){
            header("location:main.php");
        }
     ?>
    </html>
