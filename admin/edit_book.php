<?php
session_start();
$con=mysqli_connect("localhost","root","","project");
if(!isset($_SESSION['success'])){
    header("location:index.php");
}
else if(isset($_POST['update'])){
    $id=$_GET['id'];
    $book_name=$_POST['book_name'];
    $category_id=$_POST['category'];
    $author_id=$_POST['author'];
    $isbn=$_POST['isbn'];
    $sql="UPDATE tblbooks SET book_name='$book_name',category_id='$category_id',author_id='$author_id',isbn='$isbn' WHERE id='$id'";
    if(mysqli_query($con,$sql)){
        $_SESSION['updatestatus'] = "Updated successfully";
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
                      <form method="post"  class="form-container">
                          <?php
                           $cnt=1;
                           $id=$_GET['id'];
                           $sql="SELECT tblbooks.book_name,tblcategory.categoryname,tblcategory.id as cid,tblauthor.author_name,tblauthor.id as athrid,tblbooks.isbn FROM tblbooks JOIN tblcategory on tblbooks.category_id =tblcategory.id JOIN tblauthor on tblauthor.id=tblbooks.author_id WHERE tblbooks.id='$id'";
                           $result=mysqli_query($con,$sql);
                           if($result->num_rows > 0){
                               while($row = $result->fetch_assoc())
                                  {?>
                            <h3 class="text-center font-weight-bold">EDIT BOOK</h3>
                            <b>Book Name:</b>
                            <div class="form-group">
                                <input type="text" class="form-control" name="book_name" value="<?php echo htmlspecialchars($row['book_name']);?>" required>
                            </div>
                            <b>category Name:</b>
                            <div class="form-group">
                                <select name="category" class="form-control" required>
                                    <option value="<?php echo htmlentities($row['cid']);?>"><?php echo htmlentities($catname=$row['categoryname']);?></option>
                                    <?php
                                        $sql1="SELECT * FROM tblcategory where status='1'";
                                        $result1=mysqli_query($con,$sql1);
                                        if($result1->num_rows > 0){
                                            while($row1=$result1->fetch_assoc()){
                                                if($catname==$row1['categoryname']){
                                                    continue;
                                                }
                                                else{?>
                                                    <option value="<?php echo htmlentities($row1['id']);?>"><?php echo htmlentities($row1['categoryname']);?></option>
                                                <?php }}} ?>
                                  </select>
                              </div>
                              <b>Author:</b>
                              <div class="form-group">
                                        <select name="author" class="form-control" required>
                                            <option value="<?php echo htmlentities($row['athrid']);?>"><?php echo htmlentities($author=$row['author_name']);?></option>
                                            <?php
                                                $sql1="SELECT * FROM tblauthor";
                                                $result1=mysqli_query($con,$sql1);
                                                if($result1->num_rows > 0){
                                                    while($row1=$result1->fetch_assoc()){
                                                        if($author==$row1['author_name']){
                                                            continue;
                                                        }
                                                        else{?>
                                                            <option value="<?php echo htmlentities($row1['id']);?>"><?php echo htmlentities($row1['author_name']);?></option>
                                                        <?php }}} ?>
                                        </select>
                                </div>

                            <b>ISBN:</b>
                            <div class="form-group">
                                <input type="int" class="form-control" name="isbn" value="<?php echo htmlspecialchars($row['isbn']);?>" required>
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
