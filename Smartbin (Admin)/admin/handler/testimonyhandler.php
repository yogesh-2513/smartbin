<?php
require 'db_config.php';

// error_reporting(0);
$result=array('error'=>0,"msg"=>"");
if($_POST['action'] == "addtestimony"){
    function resizeImage($resourceType,$image_width,$image_height,$resizeWidth,$resizeHeight) {
        // $resizeWidth = 100;
        // $resizeHeight = 100;
        $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
        imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
        return $imageLayer;
    }
    
        $imageProcess = 0;
        if(is_array($_FILES)) {
            $new_width = 479;
            $new_height = 479;
        $fileName = $_FILES['upload_image']['tmp_name'];
        $name=$_FILES['upload_image']['name'];
            // print_r($_FILES['upload_image']);
            $sourceProperties = getimagesize($fileName);
            $resizeFileName = time();
            $uploadPath = "./uploads/";
            $fileExt = pathinfo($_FILES['upload_image']['name'], PATHINFO_EXTENSION);
            $uploadImageType = $sourceProperties[2];
            $sourceImageWidth = $sourceProperties[0];
            $sourceImageHeight = $sourceProperties[1];
            switch ($uploadImageType) {
                case IMAGETYPE_JPEG:
                    $resourceType = imagecreatefromjpeg($fileName); 
                    $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width,$new_height);
                    $name="priyam_".time().$name;
                    $move_file = imagejpeg($imageLayer,$uploadPath.$name);
                    break;
    
                case IMAGETYPE_GIF:
                    $resourceType = imagecreatefromgif($fileName); 
                    $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width,$new_height);
                    $name="priyam_".time().$name;
                    $move_file = imagegif($imageLayer,$uploadPath.$name);
                    break;
    
                case IMAGETYPE_PNG:
                    $resourceType = imagecreatefrompng($fileName); 
                    $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width,$new_height);
                    $name="priyam_".time().$name;
                    $move_file = imagepng($imageLayer,$uploadPath.$name);
                    break;
    
                default:
                    $imageProcess = 0;
                    break;
            }
            // $move_file = $uploadPath. $resizeFileName. ".". $fileExt;
            move_uploaded_file($fileName, $move_file);
            // echo "Path : ".$fileName;
            $imageProcess = 1;
        }
    $move_file=$uploadPath.$name;
        if($imageProcess == 1){
      
            $uname=$_POST["uname"];
            $umail=$_POST["mail"];
            $uphno=$_POST["phno"];
            $umessage=$_POST["message"];
            $query=mysqli_query($db,"INSERT into testimony (user_name,user_mail,user_phno,user_message,user_photo) values ('$uname','$umail','$uphno','$umessage','$move_file')");
            $result['error']=0;
            $result['msg']="Inserted Successfully !!";
            echo json_encode($result);
        }else{
            $result['error']=1;
            $result['msg']="Unable to insert !!";
        // echo mysqli_error($db);
            echo json_encode($result);
        }
        $imageProcess = 0;
}elseif($_POST['action'] == "updatetestimony"){
    $id=$_POST['id'];
    $uname=$_POST["uname"];
    $umail=$_POST["mail"];
    $uphno=$_POST["phno"];
    $umessage=$_POST["message"];
    $query=mysqli_query($db,"UPDATE testimony set user_name='$uname',user_mail='$umail',user_phno='$uphno',user_message='$umessage' WHERE id='$id'");
    // echo $query;
    if($query){
        $result['error']=0;
        $result['msg']="Updated Successfully !!";
        echo mysqli_error($db);
        echo json_encode($result);
    }else{
        $result['error']=1;
        $result['msg']="Unable to Update !!";
        // echo mysqli_error($db);
        echo json_encode($result);
    }
}elseif($_POST['action'] == "deletetestimony"){
    $id=$_POST['id'];
    $query = mysqli_query($db,"DELETE FROM testimony where id='$id'");
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
}elseif($_POST['action'] == "changestatus"){
    $id=$_POST['id'];
    $status=$_POST['status'];
    // $query1 = mysqli_query($db,"SELECT status from `testimony` where id='$id'");
    // $row == mysqli_fetch_array($query1);
    $query=mysqli_query($db,"UPDATE testimony set status='$status' where id='$id'");
    if($query){
        $result['error']=0;
        $result['msg']=$status == 1?"Activated":"Deactivated";
        echo json_encode($result);
    }else{
        $result['error']=1;
        $result['msg']="Unable to Delete !!";
        echo mysqli_error($db);
        echo json_encode($result);
    }

}


?>