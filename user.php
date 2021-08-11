<?php
include "db_connect.php";
session_start();

  if(!$_SESSION['username']){
    header("Location: login.php");
  }


$fname = $lname = $email = $address = $state = $city = $phone = $acctNo = $acctName = $bankName = $sponsorid = $about = $username =  "" ;
$message ="";


if($stmt = $conn->prepare("SELECT * FROM member WHERE username=?  ")){

		 $stmt->bind_param('s', $_SESSION['username']);
		$stmt->execute();

		 $result = $stmt->get_result();

			if($result->num_rows >0 ){
				while($row = $result->fetch_assoc()) {
        $username = $row['USERNAME'];
				$fname = $row["FNAME"];
				$lname = $row['LNAME'];
				$email = $row['EMAIL'];
				$address = $row['ADDRESS'];
				$state = $row['STATE'];
				$city= $row['CITY'];
				$phone = $row['PHONE'];
				$acctNo = $row['ACCT_NUM'];
				$acctName = $row['ACCT_NAME'];
				$bankName = $row['BANK_NAME'];
				$sponsorid = $row['SPONSOR_ID'];
				$about = $row['ABOUT'];

				}

			}

		}




 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>NGGC |  Profile</title>
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
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li class="nav-item ">
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
                    <li class="nav-item">
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
                    <a class="navbar-brand" href="#pablo"> User Profile </a>
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
                          <?php

                              if(isset($_POST['update'])) {

                                    if($stmt = $conn->prepare('UPDATE member SET FNAME=?, LNAME=?, ADDRESS=?, STATE=?, CITY=?, PHONE=?, ACCT_NUM =?, ACCT_NAME=?, BANK_NAME=?, ABOUT=? WHERE username=?')){

                                       $stmt->bind_param('sssssssssss',$_POST['fname'],$_POST['lname'], $_POST['address'], $_POST['state'], $_POST['city'], $_POST['phone'],$_POST['acctNo'], $_POST['acctName'], $_POST['bankName'], $_POST['about'], $_SESSION['username']);
                                      $stmt->execute();

                                     echo "<div class='alert alert-success alert-dismissible'>
                                    <button type='button' class='close' data-dismiss='alert'>&times;</button> Record Updated Successfully </div>";

                                    $conn->close();
                             } else {
                               echo "<div class='alert alert-danger alert-dismissible'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button> Record not Updated</div>";
                             }

                             } ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                   <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post"  enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-5 pr-1">
                                                <div class="form-group">
                                                    <label>Company </label>
                                                    <input type="text" class="form-control" disabled="" placeholder="Company" value="NGGC">
                                                </div>
                                            </div>
                                            <div class="col-md-3 px-1">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $username ?>"readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email address</label>
                                                    <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $email ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control"  name="fname" value="<?php echo $fname ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pl-1">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?php echo $lname ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control" name="address" placeholder="Home Address" value= "<?php echo $address ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <input type="text" class="form-control" name="state"placeholder="State of Residence" value="<?php echo $state ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <input type="text" class="form-control" name="city" placeholder="City of Residence" value="<?php echo $city ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input type="number" name="phone" class="form-control" placeholder="mobile number" value="<?php echo $phone ?>">
                                                </div>
                                            </div>
                                            <hr>

                                            <div class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label>Account Number</label>
                                                    <input type="number" name="acctNo" class="form-control" placeholder="Bank Account number" value="<?php echo $acctNo ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label>Account Name</label>
                                                    <input type="text" name="acctName" class="form-control" placeholder="Bank Account name" value="<?php echo $acctName ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label>Bank Name</label>
                                                    <input type="text" name="bankName" class="form-control" placeholder="Bank Name" value="<?php echo $bankName ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label>Sponsor ID</label>
                                                    <input type="text" name="sponsor" class="form-control" placeholder="referral ID" value="<?php echo $sponsorid ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>About Me</label>
                                                    <textarea rows="40" cols="80" name="about" class="form-control" placeholder="Here can be your description" ><?php echo $about; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-fill pull-right" name="update">Update Profile</button>
                                        <div class="clearfix"></div>
                                    </form>
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

</body>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
 <script src="assets/js/plugins/bootstrap-switch.js"></script>
 <script src="assets/js/plugins/bootstrap-notify.js"></script>
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>


</html>
