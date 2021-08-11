<?php
error_reporting(0);
include "db_connect.php";
session_start();

  if(!$_SESSION['username']){
    header("Location: login.php");
  }


  $sqlz = "SELECT * from payment_uploads where username = '".$_SESSION['username']."' ";
  $resultz = $conn->query($sqlz);

  if($resultz->num_rows > 0){

      while($row = $resultz->fetch_assoc()) {

       if($row['status'] == 'VERIFIED'){

         $_SESSION['PaymentStats'] = "VERIFIED";
       }
     }
  }else{
      $_SESSION['PaymentStats'] ="UNVERIFIED";
  }

// check user paymennt status
//   $sqll = "SELECT * from payment_uploads where username = '".$_SESSION['username']."' ";
//   $results = $conn->query($sqll);
//   if ($result->num_rows > 0) {
//
//   // output data of each row
//   while($row = $result->fetch_assoc()) {
//     if($row['status'] == 'VERIFIED'){
//       $_SESSION['PaymentStats'] = "VERIFIED";
//     }
//   }
// }


$result="";
$sql = "SELECT * from referral where sponsor_username = '".$_SESSION['username']."' ";
$result = $conn->query($sql);

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

  }else if($result2->num_rows < 0){
    $dref = 1;
  }
  $sref += $dref;
  // if($sref==0){
  //   $sref = 1;
  //   $dref =1;
  // }

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
                  $_SESSION['userLvl'] = 4;
                  $_SESSION['userstage']  = 2;
                  // code...
          }elseif ($total_Refs == 32 || $total_Refs<= 63) {
                          $_SESSION['userLvl'] = 5;
                          $_SESSION['userstage']  = 3;
                          // code...
            }elseif ($total_Refs == 64 || $total_Refs<= 127) {
                            $_SESSION['userLvl'] = 6;
                            $_SESSION['userstage']  = 3;
                            // code...
              }elseif ($total_Refs == 128 || $total_Refs<= 255) {
                              $_SESSION['userLvl'] = 7;
                              $_SESSION['userstage']  = 3;
                              // code...
                } elseif ($total_Refs == 256 || $total_Refs<= 511) {
                                $_SESSION['userLvl'] = 8;
                                $_SESSION['userstage']  = 4;
                                // code...
                  }  elseif ($total_Refs == 512 || $total_Refs<= 1023) {
                                  $_SESSION['userLvl'] = 9;
                                  $_SESSION['userstage']  = 4;
                                  // code...
                    } elseif ($total_Refs == 1024 || $total_Refs<= 8191) {
                                    $_SESSION['userLvl'] = 10;
                                    $_SESSION['userstage']  = 5;
                                    // code...
                      }elseif ($total_Refs == 8192 || $total_Refs<= 16383) {
                                      $_SESSION['userLvl'] = 13;
                                      $_SESSION['userstage']  = 5;
                                      // code...
                        } elseif ($total_Refs == 16384 || $total_Refs<= 32767) {
                                        $_SESSION['userLvl'] = 14;
                                        $_SESSION['userstage']  = 7;
                                        // code...
                          }elseif ($total_Refs == 32768 || $total_Refs<= 65535) {
                                          $_SESSION['userLvl'] = 15;
                                          $_SESSION['userstage']  = 7;
                                          // code...
                            }   else{
                        $_SESSION['userLvl'] = 1;
                        $_SESSION['userstage']  = 1;
                      }


        $_SESSION['Tree'] = "<b> > Tree: ".$total_Refs. '</b>';
        // $_SESSION['status'] = $row["Status"];
        // $_SESSION['dref'] = $dref ;
}

}





  $sql = "SELECT * from referral where sponsor_username = '".$_SESSION['username']."' ";
  $result = $conn->query($sql);

    if($result->num_rows < 0 ) {
    $_SESSION['referrals'] = 0;
  } else{

  $_SESSION['referrals'] = $result->num_rows;
}

$sql1 = "SELECT * from referral where sponsee_username = '".$_SESSION['username']."' ";
$result1 = $conn->query($sql1);
  while($row = $result1->fetch_assoc()) {
    $_SESSION['sponsor'] = $row["Sponsor_Username"];
  }

  //  var_dump($_SESSION["sponsor"]);

$_SESSION['bonusCalc'] = $total_Refs;

 ?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>NGGC|dashboard</title>
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
                    <a href="#" class="simple-text ">
                  <img src="assets/images/company-logo.png"  alt="NGGC-logo" height="100px" width="150px">
                    </a>

                </div>
                <ul class="nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="user.php">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>View your Profile</p>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_referral.php">
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
                  <a class="navbar-brand " href="dashboard.php">
                    Dashboard
                   </a>
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
                      <ul class="navbar-nav ml-auto">

                      </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 ">
                          <h5>Welcome <?php echo "<b>".$_SESSION['username']."</b>"; ?> <span class="float-right"> Your Sponsor: <?php echo "<b>".  $_SESSION['sponsor']. "</b>"; ?></span></h5>
                            <div class="card bg-info ">
                                <div class="card-header ">
                                    <h5 class="card-title p-2 m-2">Payment Status: <span class="text-white  text-md bg-danger p-2 "><strong><?php echo   $_SESSION['PaymentStats'];?></strong></span>

                                      <span class="card-title float-right" style="font-size:13px">LEVEL: <span class="text-white  text-md bg-danger p-2  "><strong>
                                      <?php if ($_SESSION['userLvl']=='' || $_SESSION['userstage']=='' ) {
                                        echo "1 stage 1";
                                      }else{ echo $_SESSION['userLvl'].' stage: '.$_SESSION['userstage'];}?></strong> </span></h5>

                                </div>
                                <div class="card-body text-white">
                                <div class="row">
                                  <div class="col-md-4 ">
                                    <h4>BALANCE</h4>
                                    <?php echo '#'.$_SESSION['bonusCalc']*250; ?>
                                    </div>
                                    <div class="col-md-4 ">
                                      <h4>REFERRAL BONUS</h4>
                                      <?php echo '#'.$_SESSION['bonusCalc']*250; ?>
                                      </div>
                                    <div class="col-md-4 ">
                                        <h4>REFERRALS</h4>
                                        <?php echo $_SESSION['referrals']. $_SESSION['Tree'];

                                         ?>
                                      </div>

                                </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 price-main-info">
                        <div class="price-inner card box-shadow">
                          <div class="card-body">

                                  <h4 class="text-uppercase text-center mb-3"> Our Compensation Plan</h4>

                                  <ul class="list-unstyled mt-3 mb-4">
                                    <li> <span class="nc-icon nc-bulb-63 text-warning"></span> Registration = N3,000 + products Choice.</li>
                                    <li> <span class="nc-icon nc-bulb-63 text-warning"></span> products = N1,000 + with general body test = N2,000</li>
                                    <li> <span class="nc-icon nc-bulb-63 text-warning"></span> Referral bonus = N250</li>

                                  </ul>

                              </div>
                        </div>
                      </div>

                        <div class="col-lg-6 col-md-6 price-main-info">
                    <div class="price-inner card box-shadow">

                        <div class="card-body">
                            <h4 class="text-uppercase text-center mb-3">REGISTRATION PACKAGES</h4>

                                <ul class="list-unstyled mt-3 mb-4">
                                <li> <span class="nc-icon nc-bulb-63 text-warning"></span> N3,000 = One way earned</li>
                                <li> <span class="nc-icon nc-bulb-63 text-warning"></span> N53,960 = Two way earned</li>
                                <li> <span class="nc-icon nc-bulb-63 text-warning"></span> N572,960 = For stocks four way earned</li>

                            </ul>

                        </div>
                    </div>
                </div>
                    </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <br>

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
                            ©Copyright NGGC                     <script>
                                document.write(new Date().getFullYear())
                            </script> Powered by
                            <a href="http://www.chermcity.com">Chermcity</a>
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>

  </div>

</body>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets/js/plugins/bootstrap-switch.js"></script>

<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.showNotification();

    });
</script>

</html>
