<?php
session_start();
if(isset($_SESSION['isAdminLogin'])){
    if($_SESSION['isAdminLogin'] == false){
        header("Location:index.php");
        exit();
    }
}else{
    header("Location:index.php");
    exit();
}

/*session_start();*/
require 'header.php';
require 'db_config.php';

//if ($_SESSION['id']=='') {
 // echo "<script>window.location.replace('index.php')</script>";
//}
?>
   <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <h4 class="page-title">REWARD INFORMATION </h4>
                                    
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title"><b>Add Reward</b></h4>
                              
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-horizontal">
                    <form id="form_addbin" action="" method="post">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Reward Name</label>
                                        <div class="col-md-10">
                                            <input type="text" required class="form-control" id="product_name" name="reward_name" placeholder ="Enter a Reward Description...." pattern="{a-zA-z}+">
                                        </div>
                                    </div>
                                         
                                    </div>
                                </div>

                                

                                <div class="col-md-6">
                                  <div class="form-horizontal">
                                    
                                  <div class="form-group">
                                                  <label class="col-md-2 control-label">Reward Point</label>
                                                  <div class="col-md-10">
                                                      <input type="text" required class="form-control" id="product_name" name="reward_point" placeholder ="Enter a Reward Point...." pattern="[0-9]+">
                                                  </div>
                                              </div>
                                                  
                                              

                                               <div class="col-md-8 col-md-offset-6 m-t-50">
                                              <button type="submit" name="action" class="btn btn-custom waves-light waves-effect w-md" >Submit</button>
                                                <!-- <button type="submit" name="action" class="btn btn-custom waves-light waves-effect w-md" id="update" onclick="updateStudent()">Update</button> -->
                                         <!-- <input type="submit" name="action" class="btn btn-custom waves-light waves-effect w-md" id="action"> -->
                                         </form> </div>
                                </div>
                                </div>
                              </div>

                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                     <div class="row">
                            <div class="col-sm-12" >
                                <div class="card-box table-responsive" id="">

                                    <h4 class="m-t-0 header-title"><b>REWARD DETAILS</b></h4>
                                  <div id="table_container">

                                  <table id="datatable-responsive"
                                           class="table table-striped  table-colored table-info dt-responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th>Reward no</th>
                                            <th>Reward Name</th>
                                            <th>Reward Points</th>
                                            <th>Action</th>
                                            
                                        
                                        </tr>
                                         
                                        </thead>
                                        <tbody id="dataTablesBody" class='tBody'>
                                            <?php

                                                $sql=mysqli_query($db,"SELECT * FROM `reward`");
                                                if(mysqli_num_rows($sql)>0){
                                                    while($row=mysqli_fetch_array($sql)){
                                                        echo "<tr>";
                                                            echo "<td>".$row['id']."</td>";
                                                            echo "<td>".$row['reward']."</td>";
                                                            echo "<td>".$row['points']."</td>";
                                                            echo "<td><button class='btn btn-inverse btn-bordered waves-effect w-md waves-light' onclick='delete_reward(".$row['id'].")'>Delete </button></td>";        
                                                            
                                                    }
                                                }

                                                
                                            ?>

                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div> <!-- container -->
                </div> <!-- content -->


<script type="text/javascript">

            $('#form_addbin').on('submit',function(event){
                event.preventDefault()
                var formdata = new FormData(this);
                formdata.append("action","addproduct")
                $.ajax({
                    url:"rewardhandler.php",
                    type:"POST",
                    processData:false,
                    contentType:false,
                    data : formdata,
                    success : function(response){
                        console.log(response);
                        var temp=JSON.parse(response);
                        alert(temp['msg'])
                        if(temp['error'] == 0){
                            
                            $("#table_container").load("addreward.php #datatable-responsive");
                        }
                    }
                })
            });
           
            function delete_reward(id){
                var formdata = new FormData();
                formdata.append("id",id);
                formdata.append("action","delete_reward")
                $.ajax({
                    url:"ajaxhandler.php",
                    type:"POST",
                    processData:false,
                    contentType:false,
                    data : formdata,
                    success : function(response){
                        console.log(response);
                        var temp=JSON.parse(response);
                        alert(temp['msg'])
                        if(temp['error'] == 0){
                
                            $("#table_container").load("addreward.php #datatable-responsive");
                        }
                    }
                })
            }

    </script>


<?php

require 'footer1.php';

?>