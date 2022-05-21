<?php
 session_start();

    if(!isset($_SESSION['success'])){
            header("location:index.php");
    }
    $con=mysqli_connect("localhost","root","","project");
    if(isset($_GET['del'])){
        $id=$_GET['del'];
        $sql="DELETE FROM tblcategory WHERE id = $id";
        if(mysqli_query($con,$sql)){
            $_SESSION['delmsg']="Deleted";
            header('location:manage_category.php');
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
   <div class="container ">
       <div class="row justify-content-center">
           <div class="col-md-10 col-sm-14 col-xm-4">
                             <h3 class="text-center font-weight-bold">Manage Category</h3>
                            <table class="table table-responsive" >
                                <thead class="thead-dark">
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Creation Date</th>
                                    <th scope="col">Updatation Date</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                 $sql="";
                                 $cnt=1;

                                 $sql="SELECT * FROM tblcategory";
                                 $result=mysqli_query($con,$sql);
                                 if($result->num_rows > 0){
                                     while($row = $result->fetch_assoc()){?>
                                    <tbody>
                                        <tr>
                                            <td scope="row"><?php echo $cnt;?></td>
                                            <td><?php echo $row['categoryname']; ?></td>
                                            <td><?php if($row['status']==1){echo "active";} else{ echo "inactive";} ?></td>
                                            <td><?php echo $row['creationdate']; ?></td>
                                            <td><?php echo $row['updatedate'];?></td>
                                            <td><a href="edit_category.php?id=<?php echo htmlentities($row['id']);?>"><input type="button" class="btn btn-success" name="edit" value="Edit"> <a href="manage_category.php?del=<?php echo htmlentities($row['id']);?>"><input type="button" class="btn btn-danger" name="delete" value="delete"></td>
                                        </tr>
                                        <?php $cnt=$cnt+1; ?>
                                        <?php } ?>
                                        <?php } ?>
                                        </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        <?php
        if(isset($_SESSION['msg'])){
            ?>
            <strong> Success :</strong>
         <?php
         echo $_SESSION['msg'];
         unset($_SESSION['msg']);
        }
        if(isset($_SESSION['updatestatus'])){
            ?>
            <strong> Success :</strong>
            <?php
            echo $_SESSION['updatestatus'];
            unset($_SESSION['updatestatus']);
        }?>
        <?php
        if(isset($_SESSION['delmsg'])){
            ?>
            <strong> Success :</strong>
            <?php
            echo $_SESSION['delmsg'];
            unset($_SESSION['delmsg']);
        }?>

  </body>
  </html>
