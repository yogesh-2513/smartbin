<?php
require 'db_config.php';
require_once 'phpqrcode/qrlib.php';
error_reporting(0);
$result=array('error'=>0,"msg"=>"");
if($_POST['action'] == "addproduct"){
    $location=$_POST["bin_location"];
    $query=mysqli_query($db,"INSERT INTO `addbin` (location)     values ('$location') ");
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
}elseif($_POST['action'] == "changestatus"){
    $id=$_POST['id'];
    $status=$_POST['status'];
    QRcode::png($id, 'uploads/qrcode/'.$id.'.png');
    $qr="uploads/qrcode/".$id.".png";
    // $query1 = mysqli_query($db,"SELECT status from `testimony` where id='$id'");
    // $row == mysqli_fetch_array($query1);
    $query=mysqli_query($db,"UPDATE addbin set status='$status', qrcode='$qr' where id='$id' ");

    if($query){
        $result['error']=0;
        $result['msg']=$status == 1?"Generated":"Deactivated";
        echo json_encode($result);
    }else{
        $result['error']=1;
        $result['msg']="Unable to Generate !!";
        echo mysqli_error($db);
        echo json_encode($result);
    }

}
elseif($_POST['action'] == "regenerate"){
    $id=$_POST['id'];
    $qrcode=mysqli_query($db,"SELECT qrcode from `addbin` where id='$id'");
    // echo "$qrcode";
    unlink("uploads/qrcode/".$id);

    QRcode::png($id, 'uploads/qrcode/'.$id.'.png');
    $qr="uploads/qrcode/".$id.".png";
    // $query1 = mysqli_query($db,"SELECT status from `testimony` where id='$id'");
    // $row == mysqli_fetch_array($query1);
    $query=mysqli_query($db,"UPDATE addbin set qrcode='$qr' where id='$id' ");

    if($qrcode){
        $result['error']=0;
        $result['msg']=$status == 1?"Regenrated !!":" Regenrated !!";
        echo json_encode($result);
    }else{
        $result['error']=1;
        $result['msg']="Unable to Generate !!";
        // echo mysqli_error($db);
        echo json_encode($result);
    }
    

}else if($_POST['action' ]== "delete_reward"){
    $id=$_POST['id'];
    if(mysqli_query($db,"DELETE FROM `reward` WHERE id='$id'")){
        $result['error']=0;
        $result['msg']="Reward deleted successfully";
        echo json_encode($result);
    }else{
        $result['error']=1;
        $result['msg']="Failed to delete the reward !!";
        echo json_encode($result);
    }
}


?>