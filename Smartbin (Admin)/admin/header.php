<!DOCTYPE html>
<html lang="en">
<?php 
  include 'db_config.php'; ?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App title -->
        <title>Smart Bin</title>
        <!-- <title>Department Of Mathamatics  PG ELECTIVE  SEM:I</title> -->
<!-- <title>Department Of Commerce CA PG ELECTIVE  SEM-I</title> -->
        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="plugins/morris/morris.css">
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>



         <!-- Plugins css-->
        <link href="plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
        <link href="plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="plugins/switchery/switchery.min.css">

        
        <!-- DataTables -->
        <link href="plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>


        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>
        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Loader -->
        <!-- <div id="preloader">
            <div id="status">
                <div class="spinner">
                  <div class="spinner-wrapper">
                    <div class="rotator">
                      <div class="inner-spin"></div>
                      <div class="inner-spin"></div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
 -->
        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="dashboard.php" class="logo"><span>SmartBin<span></span></span><i><img src="##" height="30" width="30"></i></a>
                    
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">

                        <!-- Navbar-left -->
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <button class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>
                        </ul>

                       

                    </div><!-- end container -->
                </div><!-- end navbar -->
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <div class="user-details">
                            <div class="overlay"></div>
                            <div class="text-center">
                                <!-- <img src="img/logo1.png" alt="" class="thumb-md img-circle"> -->
                            </div>
                           
                        </div>

                       
                            <li class="menu-title">ADMIN PANEL</li>

                        <ul>

                            <!-- <li>
                                <a href="dashboard.php" class="waves-effect"><i class=" mdi mdi-apps"></i><span> Dashboard </span></a>
                            </li> -->
                            <li>
                                <a href="addbin.php" class="waves-effect"><i class=" mdi mdi-file-image"></i><span> Add Bin </span></a>
                            </li>
                             <li>
                                <a href="addreward.php" class="waves-effect"><i class=" mdi mdi-directions-fork"></i><span>Add Rewards</span></a>
                            </li>
                             <!-- <li>
                                <a href="session_handler.php" class="waves-effect"><i class=" mdi mdi-alarm-check"></i><span>  Session Handler</span></a>
                            </li> -->
                             <!-- <li>
                                <a href="addDepartment.php" class="waves-effect"><i class="mdi mdi-comment-plus-outline"></i><span> Add Department </span></a>
                            </li> -->

                            <!-- <li class="has_sub">
                                <a href="category.php" class="waves-effect"><i class="mdi mdi-file-document"></i> <span> Add Category</span> </a>
                            </li> -->

                            <!-- <li class="has_sub">
                                <a href="addproduct.php" class="waves-effect"><i class="mdi mdi-folder-plus"></i> <span> Add Product </span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="studentcsv.php">Add Student As CSV</a></li>
                                    <li><a href="addstudent.php">Add Student</a></li>
                                </ul>
                            </li> -->

                             <!-- <li class="has_sub">
                                <a href="trending.php" class="waves-effect"><i class="mdi mdi-wunderlist"></i> <span> Add Trending </span> </a>
                            </li>
                            <li class="has_sub">
                                <a href="testimony.php" class="waves-effect"><i class="mdi mdi-message-processing"></i> <span> Testimony </span> </a>
                            </li> -->
                            <!-- <li class="has_sub">
                                <a href="aboutus.php" class="waves-effect"><i class="mdi mdi-message-processing"></i> <span> About Us </span> </a>
                            </li> -->
                            <!-- <li class="has_sub">
                                <a href="subscriber.php" class="waves-effect"><i class="mdi mdi-shape-square-plus"></i> <span> Subscribers </span> </a>
                            </li> -->
                             

                            <li>
                                <a href="logout.php" class="waves-effect"><i class="mdi mdi-logout"></i><span> Logout </span></a>
                            </li>
                           
                        </ul>
                    </div>
                    <!-- Sidebar -->
                   
                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->