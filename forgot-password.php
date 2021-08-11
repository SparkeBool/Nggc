
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>NGGC | Forgot Password</title>
  <!-- Template CSS -->
  <link href="//fonts.googleapis.com/css?family=Poppins:300,400,400i,500,600,700&display=swap" rel="stylesheet">
  <link href="//fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style-starter.css">
  <!-- Template CSS -->
</head>
<style media="screen">
  .error-info{
    color:red;
    padding: 5px;
  }
</style>
<body>
  <!--header-->
  <header id="site-header" class="fixed-top">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand " href="index.html">
          <img src="assets/images/company-logo.png"  alt="NGGC-logo" height="100px" width="150px">
         </a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="fa icon-expand fa-bars"></span>
          <span class="fa icon-close fa-times"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.html">Home </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html">About</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="services.html">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">REGISTER</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">LOGIN</a>
            </li>
          </ul>
          <ul class="navbar-nav search-right mt-lg-0 mt-2">

            <li class="nav-item"><a href="contact.html" class="btn btn-primary d-none d-lg-block btn-style mr-2">Contact
                Us</a></li>
          </ul>

          <!-- //toggle switch for light and dark theme -->
          <!-- search popup -->

          <!-- /search popup -->
        </div>
        <!-- toggle switch for light and dark theme -->
        <div class="mobile-position">
          <nav class="navigation">
            <div class="theme-switch-wrapper">

            </div>
          </nav>
        </div>
      </nav>
    </div>
  </header>
  <!--/header-->
   <!-- about breadcrumb -->
   <section class="w3l-about-breadcrumb position-relative text-center">
    <div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4">
      <div class="container py-lg-5 py-3">


      </div>
    </div>
  </section>
  <div class="w3-services py-5">
    <div class="container py-lg-4">
      <div class="row mt-4">

        <div class="col-md-7 mx-auto ">
          <div class="container">
            <?php

              include_once("db_connect.php");
              $username = $email= $details = $password ="";
              $error_Msg1 = $error_Msg2 ="";

                    if(isset($_POST['recover'])){

                    if(empty($_POST['uname'])){
                      $error_Msg1="*Please Enter Username";
                    }else{
                      $username = $_POST['uname'];
                    }

                    if(empty($_POST['email'])){
                      $error_Msg2="*Please Enter email";
                    }else{
                      $email= $_POST['email'];
                    }

                    if(empty($error_Msg1) || !empty($error_Msg2)){

                    $check_user="select * from passrecover WHERE username='$username'AND email='$email'";

                    $run=mysqli_query($conn,$check_user);

                    if(mysqli_num_rows($run)){

                      while($row = $run->fetch_assoc()) {
                      $username = $row["username"];
                      $password = $row['Password'];

                    $details = "Your Login Details are: <br>
                                <b>Username: </b> $username <br>
                                <b>Password: </b> $password <br>
                                <a href='login.php'> Back to Login page >>> </a>
                                ";
                    }
                  }else
                    {
                      echo "You entered An Invalid Username or Email";
                    }

                  }else {
                    echo "Please Enter Username and Email";
                  }

                }
            ?>
          <div class="card">
            <div class="card-header text-center bg-danger text-white">
            Password Recover
            </div>
            <div class="card-body">
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" id="regForm" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="exampleInputEmail1">username</label><span class="error-info"><?php echo"$error_Msg1";?></span>
                  <input type="text" name="uname" class="form-control"  >

                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="email" class="form-control" > <span class="error-info"><?php echo"$error_Msg2";?></span>
                  <small id="emailHelp" class="form-text text-muted">Please Enter the Email You registered with to recover your password.</small>
                </div>
                <input type="submit"  value="Recover Password"name="recover" class="btn btn-primary">
                <span class="text-success p-4"><br> <?php echo "$details" ?></span>
              </form>
            </div>
          </div>
      </div>
    </div>

        </div>
  
      </div>

  <!-- //about breadcrumb -->
	<!--/services-sec-->

  <footer class="w3l-footer-66">
    <section class="footer-inner-main">

      <div class="below-section">
        <div class="container">
          <div class="copyright-footer">
            <div class="columns text-lg-left">
              <p>© 2021 NGGC. All rights reserved | Designed by <a href="https://chermcity.com">Chermcity</a></p>
            </div>
            <ul class="columns text-lg-right">
              <li><a href="#">Privacy Policy</a>
              </li>
              <li>|</li>
              <li><a href="#">Terms Of Use</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- copyright -->
      <!-- move top -->
      <button onclick="topFunction()" id="movetop" title="Go to top">
        <span class="fa fa-long-arrow-up" aria-hidden="true"></span>
      </button>
      <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
          scrollFunction()
        };

        function scrollFunction() {
          if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("movetop").style.display = "block";
          } else {
            document.getElementById("movetop").style.display = "none";
          }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
          document.body.scrollTop = 0;
          document.documentElement.scrollTop = 0;
        }
      </script>
      <!-- /move top -->

    </section>
  </footer>
  <!--//footer-66 -->
  <!-- Template JavaScript -->
  <script src="assets/js/jquery-3.3.1.min.js"></script>
  <script src="assets/js/theme-change.js"></script>
  <!-- disable body scroll which navbar is in active -->
  <script>
    $(function () {
      $('.navbar-toggler').click(function () {
        $('body').toggleClass('noscroll');
      })
    });

  window.addEventListener("load", function(){
    Location.reload();
  });
    $(window).on("scroll", function () {
      var scroll = $(window).scrollTop();

      if (scroll >= 80) {
        $("#site-header").addClass("nav-fixed");
      } else {
        $("#site-header").removeClass("nav-fixed");
      }
    });

    //Main navigation Active Class Add Remove
    $(".navbar-toggler").on("click", function () {
      $("header").toggleClass("active");
    });
    $(document).on("ready", function () {
      if ($(window).width() > 991) {
        $("header").removeClass("active");
      }
      $(window).on("resize", function () {
        if ($(window).width() > 991) {
          $("header").removeClass("active");
        }
      });
    });
  </script>
  <!--//MENU-JS-->

  <script src="assets/js/bootstrap.min.js"></script>

  </body>

  </html>
