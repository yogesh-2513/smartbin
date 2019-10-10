<?php
session_start();
$_SESSION['isAdminLogin']=false;
session_unset($_SESSION['isAdminLogin']);
session_destroy();
header("Location:index.php");
?>