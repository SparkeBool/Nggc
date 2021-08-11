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
                      <li class="nav-item ">
                          <a class="nav-link" href="user_referral.php">
                              <i class="nc-icon nc-circle-09"></i>
                              <p>Refferals</p>
                          </a>
                      </li>
                      <li class="nav-item active">
                          <a class="nav-link" href="#">
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
                    <a class="navbar-brand" href="#pablo"> Payment</a>
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
                      <div class=" col-lg-10 col-md-10">
                        <div class="price-inner card box-shadow">
                          <div class="card-body">

                            <h4 class="text-success m-4"><i class="nc-icon nc-bank"></i> Account Details</h4>
                            <ul class="text-secondary" style="list-style-type: none;">
                              <li> <b>Account Number</b> : 2178333052</li>
                              <li> <b>Bank Name </b> : Zenith Bank</li>
                              <li> <b>Account Name</b> :  Natural Gift of God Company</li>
                            </ul>
                            <span class="text-danger"> <strong>NOTE:</strong> All payments are to be made to this Account only </span>
                              </div>
                        </div>
                      </div>

                    </div>
                    <div class="row">
                        <div class="col-md-10">
                        <div class="card">

                                <div class="card-body">
                                <span class="text-danger">
                                  <strong>INSTRUCTIONS</strong>
                                  <ul style="list-style-type:circle;">
                                    <li> Make Payment to the Bank Details Above</li>
                                      <li>scan the Bank teller or screenshot the proof of payment</li>
                                      <li>Upload the Payment Proof through the field below</li>
                                      <li> Refresh page to confirm Upload </li>
                                      <li>Admin will confirm payment and Your Dashboard will reflect if verified/unverified</li>
                                  </ul>
                                  <br>

                                </span>
                                 <br>
                                 <br>
                                 <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" id="regForm" enctype="multipart/form-data">
                                    <p class="text-primary p-1 m-1">Select the screenshot or scanned Payment Proof of ('jpg','png','jpeg','gif','pdf') format only:</p>
                                    <input type="file" name="file">
                                    <input type="submit" name="submit" value="Upload" class="btn btn-success" style="cursor:pointer;">
                                  </form>
                                </div>
                                <?php
                                        // Include the database configuration file
                                      $statusMsg = '';
                                      $status= '';

                                        // File upload path
                                        $targetDir = "payment_upload/";
                                        $fileName = basename($_FILES["file"]["name"]);
                                        $targetFilePath = $targetDir . $fileName;
                                        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                        $create_dateTime = strval( date("Y-m-d H:i:s"));

                                        if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
                                            // Allow certain file formats
                                            $allowTypes = array('jpg','png','jpeg','gif','pdf');
                                            if(in_array($fileType, $allowTypes)){
                                                // Upload file to server
                                                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){

                                              // check if file already exists
                                              $sql = "SELECT * from payment_uploads where username = '".$_SESSION['username']."' and file_name ='$fileName' ";
                                              $result = $conn->query($sql);

                                              if($result->mysqli_num_rows >0){
                                                $statusMsg = "File exists";
                                              }
                                                $status = "UNVERIFIED";
                                                    // Insert image file name into database

                                                    $stmt = $conn->prepare("INSERT INTO payment_uploads(username,file_name, uploaded_on,status) VALUES (?,?,?,?)");
                                                     $stmt->bind_param("ssss",$_SESSION['username'],$fileName,$create_dateTime,$status);

                                                    if( $stmt->execute()){
                                                        $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                                                          $conn->close();
                                                    }else{
                                                        $statusMsg = "File upload failed, please try again.";
                                                    }
                                                }else{
                                                    $statusMsg = "Sorry, there was an error uploading your file.";
                                                }
                                            }else{
                                                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
                                            }
                                        }else{
                                            $statusMsg = '<p class="p-2 m-1">Please select a file to upload.</p>';
                                        }
                                        // Display status message
                                        echo $statusMsg;
                                        ?>


                            </div>

                        </div>


                        <div class="col-lg-10 col-md-10">

                          <div class="price-inner card box-shadow">
                            <div class="card-header">
                              <h4>Payment Proof</h4>
                            </div>
                            <div class="card-body">
                          <?php

                          $sql = "SELECT * from payment_uploads where username = '".$_SESSION['username']."' order by uploaded_on DESC ";
                          $result = $conn->query($sql);

                           ?>


                             <div class="table-responsive">
                               <table class="table" >
                            <thead class="text-primary">
                              <tr>
                            <th> File Name</th>
                            <th> Date </th>
                            <th>Status </th>

                          </tr>
                          </thead>

                            <tbody>
                              <?php
                              if ($result->num_rows > 0) {

                              // output data of each row
                              while($row = $result->fetch_assoc()) {



                                  echo  "<tr><td>" . $row["file_name"]. "</td><td> ". $row["uploaded_on"]. "</td><td>". $row["status"]. "</td><td> ";
                              }


                            } else {
                              echo "<tr colspan ='2'><td> No payment uploaded </td></tr>";
                            }
                            $conn->close();
                               ?>
                            </tbody>

                          </table>
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
