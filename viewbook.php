<?php
if(session_status() != PHP_SESSION_ACTIVE){
    session_start();
}
    if(!isset($_SESSION['success'])){
            header("location:index.php");
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
        <div class="container">
        	<div class="row  justify-content-center">
        		<div class="col-xm-4 col-sm-14 col-md-10">
                <h3 class="text-center font-weight-bold">Book Details</h3>

                <table class="table table-responsive">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Book author</th>
                        <th scope="col">Book category</th>
                        <th scope="col">ISBN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          $id=$_GET['id'];
                          $cnt=1;
                          $sql="SELECT tblbooks.book_name,tblbooks.isbn,tblauthor.author_name,tblcategory.categoryname FROM tblbooks JOIN tblcategory on tblbooks.category_id = tblcategory.id JOIN tblauthor on tblbooks.author_id = tblauthor.id where tblbooks.category_id=$id";
                          $result=mysqli_query($con,$sql);

                                if($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()){?>
                                      <tbody>
                                       <tr>
                                           <td scope="row"><?php echo $cnt;?></td>
                                           <td><?php echo $row['book_name']; ?></td>
                                           <td><?php echo $row['author_name'] ?></td>
                                           <td><?php echo $row['categoryname']; ?></td>
                                            <td><?php echo $row['isbn'];?></td>
                                       </tr>
                                   <?php $cnt=$cnt+1; ?>
                                   <?php } ?>
                                   <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
      </div>

  </body>
</html>
