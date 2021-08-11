<?php
error_reporting(0);
include "db_connect.php";
session_start();

  if(!$_SESSION['username']){
    header("Location: login.php");
  }

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>NGGC | Referrals</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
   </head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="assets/images/sidebar-4.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="dashboard.php" class="simple-text">
                      <img src="assets/images/company-logo.png"  alt="NGGC-logo" height="100px" width="150px">
                        </a>
                    </a>
                </div>
                <ul class="nav">
                    <li>
                        <a class="nav-link" href="dashboard.php">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="user.php">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li>
                      <li class="nav-item active">
                          <a class="nav-link" href="#">
                              <i class="nc-icon nc-circle-09"></i>
                              <p>Refferals</p>
                          </a>
                      </li>
                      <li class="nav-item ">
                          <a class="nav-link" href="Payment.php">
                              <i class="nc-icon nc-credit-card"></i>
                              <p>Payment</p>
                          </a>
                      </li>
                      <li class="nav-item ">
                          <a class="nav-link" href="UserMessage.php">
                              <i class="nc-icon nc-email-83"></i>
                              <p>MESSAGE</p>
                          </a>
                      </li>
                      <li>
                        <a class="nav-link" href="logout.php">
                        <i class="nc-icon nc-button-power"> </i>
                        <p>Log out</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#pablo"> Referrals</a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                      <ul class="nav navbar-nav">
                          <li class="nav-item">
                              <a href="#" class="nav-link" data-toggle="dropdown">
                              <span class="d-lg-none">Dashboard</span>
                              </a>
                          </li>



                      </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="card">

                                <div class="card-body">
                                  <?php

                                  $result ="";
                                  $sql = "SELECT * from referral where sponsor_username = '".$_SESSION['username']."' ";
                                  $result = $conn->query($sql);

                                   ?>

                                     <div class="table-responsive">
                                       <table class="table" id="stf_info">
                                    <thead class="text-primary">
                                      <tr>
                                    <th> Referrals ID</th>
                                    <th> Status</th>
                                    <th> Reffered </th>

                                  </tr>
                                  </thead>

                                    <tbody>
                                      <?php
                                      $dref = '';
                                      $sref= '';
                                      $total_Refs ='';
                                      if ($result->num_rows > 0) {

                                      // output data of each row
                                      while($row = $result->fetch_assoc()) {
                                        //getting referral reffrees;
                                        $_SESSION['sponsorsq'] =$row["Sponsee_username"];
                                        $sql2 = "SELECT * from referral where sponsor_username = '".$_SESSION['sponsorsq']."' ";
                                        $result2 = $conn->query($sql2);

                                        if ($result2->num_rows > 0) {
                                          $dref = $result2->num_rows;

                                        }else{
                                          $dref = 0;
                                        }
                                        $sref += $dref;

                                        $total_Refs = $result->num_rows + $sref;

                                        if($total_Refs == 0 || $total_Refs<=3){

                                            $_SESSION['userLvl'] = 1;
                                            $_SESSION['userstage']  = 1;

                                        }elseif ($total_Refs == 4 || $total_Refs <= 7) {
                                          // code...
                                              $_SESSION['userLvl'] = 2;
                                              $_SESSION['userstage']  = 1;

                                        }elseif ($total_Refs == 8 || $total_Refs<= 15) {
                                                $_SESSION['userLvl'] = 3;
                                                $_SESSION['userstage']  = 2;
                                                // code...
                                        }elseif ($total_Refs == 16 || $total_Refs<= 31) {
                                                $_SESSION['userLvl'] = 3;
                                                $_SESSION['userstage']  = 2;
                                                // code...
                                        }else{
                                          $_SESSION['userLvl'] = 1;
                                          $_SESSION['userstage']  = 1;
                                        }



                                          echo "<tr><td>" . $row["Sponsee_username"]. "</td><td> ". $row["Status"]. "</td><td> ". $dref. "</td>" ;
                                      }


                                    } else {
                                      echo "<tr colspan ='2'><td> No Referrals Yet </td><tr>";
                                    }


                                       ?>
                                    </tbody>

                                  </table>
                                </div>
                            </div>
                        </div>
                      </div>

                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <ul class="footer-menu">

                            <li>
                                <a href="#">
                                    Support
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                  FAQ
                                </a>
                            </li>

                        </ul>
                        <p class="copyright text-center">
                            ©Copyright NGGC    <script>
                                document.write(new Date().getFullYear())
                            </script> Powered by
                            <a href="http://www.chermcity.com">Chermcity</a>
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>

</body>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
 <script src="assets/js/plugins/bootstrap-switch.js"></script>
 <script src="assets/js/plugins/bootstrap-notify.js"></script>
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>


</html>
