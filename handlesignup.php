<?php
session_start();
$showError = "false";
if($_SERVER["REQUEST_METHOD"]== "POST"){
    include 'dbconnect.php';
    $user_email=$_POST['signupEmail']; 
    $pass=$_POST['signupPassword'];
    $cpass=$_POST['signupcPassword'];
    //check whether this email exist
     $existSql="SELECT * FROM `users` WHERE user_email = '$user_email'";
     $result= mysqli_query($con,$existSql);
     $numRows =mysqli_num_rows($result);
     if($numRows>0){
         $showError = "Email is already in use";
     }
     else{
         if($pass == $cpass){
          $hash = password_hash($pass,PASSWORD_DEFAULT);  
          $sql="INSERT INTO `users` ( `user_email`, `user_pass`, `timestamp`) VALUES ( '$user_email', '$hash', CURRENT_TIMESTAMP)";
          $result = mysqli_query($con,$sql);
          if($result){
              $showAlert = true;
              $_SESSION['status']="now log in";
              header("Location:index.php?signupsuccess =true");
              exit();
          }
         }
         else {
              $showError = "Password do not match";
             
     }
    
}
      header("Location:index.php?signupsuccess=false&error=$showError");
}
?>