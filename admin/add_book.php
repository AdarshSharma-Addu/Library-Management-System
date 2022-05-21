<?php
session_start();
$con=mysqli_connect("localhost","root","","project");

if(!isset($_SESSION['success'])){
    header("location:index.php");
    }
if(isset($_POST['booksubmit'])){
    $book_name=$_POST['bookname'];
    $category_id=$_POST['category'];
    $author_id=$_POST['author'];
    $isbn=$_POST['isbn'];
    $sql="INSERT into tblbooks(id,book_name,category_id,author_id,isbn) values('','$book_name','$category_id','$author_id','$isbn')";
    if(mysqli_query($con,$sql)){
        $_SESSION['msg']="Inserted book succesfully";
        header("location:manage_book.php");
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
              <form method="post" class="form-container">
                    <h3 class="text-center font-weight-bold">ADD BOOK:</h3>

                    <b>Book Name</b><span style="color:red";>*</span><br>
                    <div class="form-group">
                        <input class="form-control" placeholder="Enter Book Name" type="text" name="bookname" required>
                    </div>

                            <b>Category</b><span style="color:red";>*</span><br>
                            <select class="form-control" name="category" required>
                                <option value="" >Select category</option>
                                <?php
                                    $status=1;
                                    $sql="SELECT * FROM tblcategory WHERE status='$status'";
                                    $result=mysqli_query($con,$sql);

                                    if($result->num_rows > 0){

                                        while($row = $result->fetch_assoc()){?>

                                                <option value="<?php echo htmlentities($row['id']);?>"> <?php echo htmlspecialchars($row['categoryname']);?></option>

                                            <?php

                                    } } ?>
                            </select>

                            <br><b>Author</b><span style="color:red";>*</span><br>
                            <select class="form-control" name="author" required>
                                <option value="" >Select author</option>
                                <?php
                                    $sql="SELECT * FROM tblauthor";
                                    $result=mysqli_query($con,$sql);
                                    if($result->num_rows > 0){

                                        while($row = $result->fetch_assoc()){?>

                                                <option value="<?php echo htmlentities($row['id']);?>"> <?php echo htmlspecialchars($row['author_name']);?></option>
                                            <?php
                                    } } ?>
                            </select>

                            <b>ISBN number</b><span style="color:red";>*</span><br>
                        <div class="form-group">
                            <input class="form-control" placeholder="Enter ISBN" type="text" name="isbn" required><br>
                        </div>
                            <a style="color:#444"> An ISBN is an International Standard Book Number.ISBN Must be unique</a>

                    <div class="form-group">
                        <input class="btn btn-success form-control" type="submit" name="booksubmit" value="Submit">
                    </div>
              </form>
        </div>
    </div>
</div>
</body>
</html>
