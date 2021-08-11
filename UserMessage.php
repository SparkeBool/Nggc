<?php
session_start();
//error_reporting(0);
include "db_connect.php";

if(!$_SESSION['username']){
  header("Location: login.php");
}


if(isset($_POST['id'])){
	$id = $_POST['id'];
//var_dump($_POST['id']);
	$sql = "select * from message where ID='".$id."'";
	$result = mysqli_query($conn,$sql);

	$response = "<table  bg-white p-4 border='0' width='100%'>";
	while( $row = mysqli_fetch_array($result) ){
		$_SESSION['Message'] = $row['Message'];
		$_SESSION['Sender'] = $row['Sender'];

    $response .= "<h5> FROM: ". $_SESSION['Sender']."</h5>";
		$response .= "<tr>";
		$response .= "<td> ".	$_SESSION['Message']."</td>";
		$response .= "</tr>";

	}
	$response .= "</table>";

	echo $response;
	exit;
}


$username= $message = $dateTime ="";
$errorMsg="";
$status ='';
$MessageStats ='';

$create_dateTime = strval( date("d/m/Y g:i:a"));

if(isset($_POST['sendMsg'])){


    $username = $_POST['receiver'];
    $message =  $_POST['msg'];
    $status ="UNREAD";
    $from =$_SESSION['username'];

    //var_dump($username);

    if(empty($errorMsg)|| !empty($_POST['msg'])){
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

     // prepare and bind
      $stmt = "INSERT INTO message(Message,Sender ,Receiver,status,sendDate) VALUES ('".$message."','".$from."', '".$username."','".$status."' ,'".$create_dateTime."')";
      $result = $conn->query($stmt);
      if($result){
    $MessageStats = "<span class='text-white bg-success nc-icon nc-check-2 p-2  m-1'> Message Sent</span>";
  }else{
    $MessageStats = "<span class='text-white bg-danger nc-icon nc-check-2 p-2  m-1'> Message not Sent</span>";
  }


      // set parameters and execute

    }else{
          $errorMsg= " <span class='text-danger'> Please fill the fields Appropriately</span>";
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
                  <li class="nav-item ">
                      <a class="nav-link" href="dashboard.php">
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
                  <li class="nav-item active ">
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
                    <a class="navbar-brand" href="#pablo">MESSAGES </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                      <ul class="nav navbar-nav">
                          <li class="nav-item">
                              <a href="#" class="nav-link" data-toggle="dropdown">
                              <span class="d-lg-none">Messages</span>
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
                        <div class="col-md-7">
                        <div class="card">
                          <div class="card-header">
                            <h4 class="">Send Message to Admin</h4>
                            <?php echo "$errorMsg"; ?>
                          </div>

                                <div class="card-body">
                                <form class="" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">

                                    <div class="form-group">
                                    <label class="bmd-label-floating text-dark">TO </label>
                                  <select class="form-control" name="receiver">
                                    <option>Admin</option>



                                  </select>
                                    </div>
                                </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="msg" class="bmd-label-floating text-dark">MESSAGE</label>
                                  <textarea rows="6" cols="20" name="msg" class="form-control" placeholder="type in your Message here" > </textarea>
                              </div>
                              <?php echo "$MessageStats"; ?>
                                </div>

                                <button type="submit" class="btn btn-primary btn-fill pull-right nc-icon nc-send" name="sendMsg" style="cursor:pointer;"> SEND</button>
                                <div class="clearfix"></div>
                              </form>


                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="card ">
                                    <div class="card-header ">
                                        <h4 class="card-title nc-icon nc-email-83"> INBOX </h4>
                                    </div>
                                    <div class="card-body ">
                                      <table class="table border-bottom table-hover table-striped" style="table-layout: fixed">
                                        <thead>

                                        <tr>

                                            <th>From</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>

                                        <?php
                                        include("db_connect.php");
                                        $sql = "SELECT * from message where Receiver ='".$_SESSION['username']."' order by sendDate DESC ";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc())//while look to fetch the result and store in a array $row.
                                        {
                                            $msgId= $row['ID'];
                                            $sender = $row['Sender'];
                                            $message=$row["Message"];
                                            $stats = $row['status'];
                                            $date=$row["sendDate"];
                                            $_SESSION['send'] = $row['Sender'];
                                        ?>

                                        <tr style="font-size: 12px;">
                                <!--here showing results in the table -->
                                            <td><?php echo'<b>'. $sender .'</b>'; ?></td>
                                            <td><?php echo'<b>'. $stats .'</b>';  ?></td>
                                            <td><?php echo'<b>'. $date .'</b>';  ?></td>
                                            <td><button   data-id="<?php echo $msgId ?>" class='btn btn-info btn-sm btn-popup'>Read</button></td>
                                        </tr>

                                      <?php }
                                    }else{echo "<tr colspan ='4'><td> No new Messages </td></tr>";} ?>

                                    </table>
                          </div>
                          </div>
                        </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title nc-icon nc-email-83"> SENT </h4>
                                </div>
                                <div class="card-body ">
                                  <table class="table border-bottom table-hover table-striped" style="table-layout: fixed">
                                    <thead>

                                    <tr>

                                        <th>RECEIVER</th>
                                        <th>MESSAGE</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>

                                    <?php
                                    include("db_connect.php");
                                    $sql = "SELECT * from message where Sender ='".$_SESSION['username']."' order by sendDate DESC ";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc())//while look to fetch the result and store in a array $row.
                                    {
                                        $id=$row['ID'];
                                        $receiver = $row['Receiver'];
                                        $message=$row["Message"];
                                        $stats = $row['status'];
                                        $date=$row["sendDate"];
                                    ?>

                                    <tr style="font-size: 12px;">
                            <!--here showing results in the table -->
                                        <td><?php echo'<b>'. $receiver .'</b>'; ?></td>
                                        <td><?php echo'<b>'. $message .'</b>';  ?></td>
                                        <td><?php echo'<b>'. $date .'</b>';  ?></td>
                                      <td><a href="usermessageDel.php?del=<?php echo $id ?>" class="btn btn-fill btn-sm btn-danger text-white" style="cursor:pointer;"> Delete</a></td>
                                    </tr>

                                  <?php }
                                }else{echo "<tr colspan ='3'><td> No Messages Sent </td></tr>";} ?>

                                </table>


                      </div>
                      </div>
                    </div>
                      </div>

                      <!-- The Modal -->
                      <div class="modal fade" id="myModal" tabindex = "-1" role = "dialog" aria-hidden = "true">

                     <?php

                                              //readmessages
                         $updateQuery = "UPDATE message SET Status = 'READ' WHERE id='".$msgId."'";
                         $effectChange =  $conn->query($updateQuery);

                        if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()){
                            $thesender = $row['Sender'];
                            $theMessage = $row["Message"];

                                  }
                                        }

                                                            ?>
                       <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                         <div class="modal-content">

                           <!-- Modal Header -->
                           <div class="modal-header text-white bg-info p-2">
                             <h4 class="modal-title">MESSAGE</h4>
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                           </div>
                          <!-- modal body -->
                           <div class="modal-body bg-light">

                             <span id='content' class="p-2 border-bottom-4">


                                 </span>

                            <form  action="userReply.php" method="post">
                               <div class="col-md-12">
                                 <div class="form-group">
                                   <p>REPLY MESSAGE:</p>
                                   <textarea rows="6" cols="20" name="replymsg" class="form-control" placeholder="REPLY MESSAGE" > </textarea>
                               </div>

                                 </div>

                                 <button type="submit" class=" p-1 float-right btn btn-primary btn-fill pull-right nc-icon nc-send" name="sendMsg" style="cursor:pointer;">  REPLY </button>
                            </form>

                                 <div class="clearfix"></div>



                           </div>

                           <!-- Modal footer -->
                           <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                             </form>

                           </div>

                         </div>
                       </div>
                      </div>
        </div>

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

<script type="text/javascript">
  $(document).ready(function () {

    $('.btn-popup').click(function () {
      var id = $(this).data('id');
      $.ajax({
        url: 'UserMessage.php',
        type: 'POST',
        data: { id: id },
        success: function (response) {
          $('#content').html(response);
          $('#myModal').modal('show');
        }
      });
    });

  });
</script>


</html>
