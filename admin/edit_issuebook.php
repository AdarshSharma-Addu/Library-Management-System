<?php
session_start();
$con=mysqli_connect("localhost","root","","project");
if(!isset($_SESSION["success"])){
    header("location:index.php");
}
else if(isset($_POST['update'])){
    $id=$_GET['id'];
    $fine=$_POST['fine'];
    $sql="UPDATE tblissuebook SET fine='$fine',return_status='0' WHERE id='$id'";
    if(mysqli_query($con,$sql)){
        $_SESSION['updatestatus'] = "Updated successfully";
        header("location:manageissuebook.php");
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
                      <form method="post"  class="form-container">
                          <?php
                           $cnt=1;
                           $id=$_GET['id'];
                           $sql="SELECT register.FullName,tblbooks.book_name,tblbooks.isbn,tblissuebook.issue_date,tblissuebook.return_date,tblissuebook.return_status,tblissuebook.fine FROM tblissuebook JOIN tblbooks on tblissuebook.book_id =tblbooks.id JOIN register on register.id=tblissuebook.student_id  WHERE tblissuebook.id='$id'";
                           $result=mysqli_query($con,$sql);
                           if($result->num_rows > 0){
                               while($row = $result->fetch_assoc())
                                  {?>
                            <h3 class="text-center font-weight-bold">ISSUE BOOK DETAILS</h3>
                            <b>Student Name: </b> <p><?php echo htmlspecialchars($row['FullName']);?></p>


                            <b>Book Name:</b><p><?php echo htmlspecialchars($row['book_name']);?></p>

                            <b>ISBN:</b><p><?php echo htmlspecialchars($row['isbn']);?></p>

                            <b>Book Issue Date:</b><p><?php echo htmlspecialchars($row['issue_date']);?></p>


                            <b>Book Return Date:</b><p><?php if($row['return_status']==1){echo "Not Return Yet";}else{echo $row['return_date'];} ?></p>

                            <b>Fine:</b>
                            <div class="form-group">
                                <input type="number" class="form-control" name="fine" placeholder="Enter Fine" required>
                                <?php }} ?>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="form-control btn btn-success" name="update" value="Update">
                            </div>
                      </form>
                </div>
            </div>
        </div>
</body>
</html>
