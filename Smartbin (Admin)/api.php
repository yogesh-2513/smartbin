<?php
require_once "db.php";

$action=$_POST['action'];

if(isset($action)){
    if($action == "user_login"){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $data=mysqli_query($db,"SELECT * FROM `users`");
        $flag=0;
        $user_points=0;
        $rewards=array();
        if(mysqli_num_rows($data) >0){
            while($res=mysqli_fetch_assoc($data)){
                if($res['username'] == $username && $res['password'] == $password){
                    $flag++;
                    $user_points=$res['points'];
                }
            }
        }
        if($flag !=0){

            $get_rewards=mysqli_query($db,"SELECT * FROM `reward` WHERE points <= $user_points");

            if(mysqli_num_rows($get_rewards) >0){
                while($row=mysqli_fetch_assoc($get_rewards)){
                    array_push($rewards,$row);
                }
            }

            $result=array(
                "userID"=>$username,
                "error"=>0,
                "msg"=>"Login successfully !!",
                "points"=>$user_points,
                "rewards"=>$rewards
            );
            echo json_encode($result);
        }else{
            $result=array(
                "error"=>1,
                "msg"=>"Invalid credentials !!"
            );
            echo json_encode($result);
        }
    }else if($action == "user_signup"){

        $username=$_POST['username'];
        $password=$_POST['password'];
        $data=mysqli_query($db,"INSERT INTO `users` (username,password) VALUES ('$username','$password')");
        $check=mysqli_query($db,"SELECT * FROM `users` WHERE username='$username'");
        if(mysqli_num_rows($check) == 0){
            if($data){
                $result=array(
                    "error"=>0,
                    "msg"=>"Registration successfully !!"
                );
                echo json_encode($result);
            }else{
                $result=array(
                    "error"=>1,
                    "msg"=>"Failed to register !!"
    
                );
                echo json_encode($result);
            }
        }else{
            $result=array(
                "error"=>1,
                "msg"=>"username already exists !!"

            );
            echo json_encode($result);
        }
        
    }else if($_POST['action'] == "update_reward"){
        $user_id=$_POST['userID'];
        $qr_result=$_POST['qrResult'];
        $query=mysqli_query($db,"SELECT * FROM `addbin` WHERE id='$qr_result'");

        if(mysqli_num_rows($query) == 0){
            $result=array(
                "error"=>1,
                "msg"=>"Dustbin not found !!"

            );
            echo json_encode($result);
        }else{
            if(mysqli_query($db,"UPDATE `users` SET points=points+5 WHERE username='$user_id'")){
                $result=array(
                    "error"=>0,
                    "msg"=>"You got the reward !!"

                );
                echo json_encode($result);
            }else{
                $result=array(
                    "error"=>1,
                    "msg"=>"Something went wrong !! Try again..."
    
                );
                echo json_encode($result);
            }
        }
    }
}

?>