<?php
include 'dbconnect.php';

$username=$_POST['username'];
$email=$_POST['email'];
$contact=$_POST['contact'];
$address=$_POST['address'];
$message=$_POST['message'];

$sql="INSERT INTO `contacts` ( `Username`, `Email`, `Contact`, `Address`, `Message`) VALUES ('$username','$email','$contact','$address','$message')";

$result=mysqli_query($con, $sql);

if($result){
   
    session_start();
    $_SESSION['status']="Message Sent Successfully!";
    
   header('Location:index.php');
}

?>

