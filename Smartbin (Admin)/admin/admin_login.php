<?php
session_start();
 require 'db_config.php'; 

$uname=mysqli_real_escape_string($db,$_POST['uname']);
$pass=mysqli_real_escape_string($db,$_POST['pass']);
// $uname=$_POST['uname'];
// $pass=$_POST['pass'];
$sql=mysqli_query($db,"SELECT * FROM admin_login WHERE username='$uname' and password='$pass'");



 if(mysqli_num_rows($sql) > 0) {
$_SESSION['isAdminLogin']=true;
echo 1;
}
 
 else{


 	echo 0;
 }







?>