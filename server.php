<?php
session_start();
$name=$email=$username=$password=$repassword=$status=$sql=" ";
$errors = array();
$con= mysqli_connect('localhost','root','','project');
if(isset($_POST['register'])){
        $name=mysqli_real_escape_string($con,$_POST['rname']);
        $username=mysqli_real_escape_string($con,$_POST['runame']);
        $email=mysqli_real_escape_string($con,$_POST['remail']);

        $password=mysqli_real_escape_string($con,$_POST['rpass']);
        $repassword=mysqli_real_escape_string($con,$_POST['rrepass']);

        if ($password!=$repassword){
                array_push($errors,"*Inncorrect password");
            }
        $sql="SELECT id FROM register WHERE UserName='$username'";
        $result=mysqli_query($con,$sql);
        if($result->num_rows > 0){
            array_push($errors,"*Username Already Used");
        }
        if (count($errors)==0){
            $sql= "INSERT INTO register (id,FullName,UserName,Email,Password,Status,Registration_date)
                        VALUES ('','$name','$username','$email','$password','1','')";
            if(mysqli_query($con,$sql)){
            $_SESSION['username']=$username;
            $_SESSION['success']="You are successfully logged in";

            header('location:main.php');
            }

        }


}
if(isset($_POST['login'])){
    $username=mysqli_real_escape_string($con,$_POST['runame']);
    $password=mysqli_real_escape_string($con,$_POST['rpass']);
    $sql="SELECT * FROM register WHERE UserName = '$username' AND Password = '$password'";
    $result= mysqli_query($con,$sql);
    if($result->num_rows > 0){
        while($row=$result->fetch_assoc()){
            $_SESSION['stdid']=$row['id'];
        }
        $_SESSION['username']=$username;
        $_SESSION['success']="You are successfully logged in";

        header('location:my-account.php');
    }
    else{
        array_push($errors,"Invalid username/password");
    }

}


?>
