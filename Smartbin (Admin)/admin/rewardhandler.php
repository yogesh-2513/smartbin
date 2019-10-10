<?php
require 'db_config.php';
error_reporting(0);
$result=array('error'=>0,"msg"=>"");
if($_POST['action'] == "addproduct"){
    $rname=$_POST["reward_name"];
    $rpoint=$_POST["reward_point"];
    $query=mysqli_query($db,"INSERT INTO `reward` (reward,points)     values ('$rname','$rpoint') ");
    if($query){
        $result['error']=0;
        $result['msg']="Insert Successfully !!";
        echo json_encode($result);
    }else{
        $result['error']=1;
        $result['msg']="Unable to Insert !!";
        echo mysqli_error($db);
        echo json_encode($result);
    }
}


?>