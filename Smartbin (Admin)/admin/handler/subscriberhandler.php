<?php
require 'db_config.php';

// error_reporting(0);
$result=array('error'=>0,"msg"=>"");
if($_POST['action'] == "addsubscriber"){
       
    $umail=$_POST["mail"];
    $query=mysqli_query($db,"INSERT into subscriber (user_mail) values ('$umail')");
    if($query){
        $result['error']=0;
        $result['msg']="Thank You...";
        echo mysqli_error($db);
        echo json_encode($result);
    }else{
        $result['error']=1;
        $result['msg']="Thank You...";
    // echo mysqli_error($db);
        echo json_encode($result);
    }
}elseif($_POST['action'] == "deletesubscriber"){
    $id=$_POST['id'];
    $query = mysqli_query($db,"DELETE FROM subscriber where id='$id'");
    if($query){
        $result['error']=0;
        $result['msg']="Delete Successfully !!";
        echo json_encode($result);
    }else{
        $result['error']=1;
        $result['msg']="Unable to Delete !!";
        echo mysqli_error($db);
        echo json_encode($result);
    }
}


?>