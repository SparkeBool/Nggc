
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>NGGC | Register</title>
  <!-- Template CSS -->
  <link href="//fonts.googleapis.com/css?family=Poppins:300,400,400i,500,600,700&display=swap" rel="stylesheet">
  <link href="//fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/style-starter.css">
  <link href=" css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <style  >
    .error_Msg{
      color:red;
      padding: 5px;
      font-size: 10px;
          }
  </style>

</head>

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
            <li class="nav-item active">
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
  <!-- //about breadcrumb -->
	<!--/services-sec-->
	<div class="w3-services py-5">
		<div class="container py-lg-4">
      <div class="row">

      <div class="col-md-7 mx-auto ">
        <?php include "form_validate.php" ?>
        <div class="card">
          <div class="card-header bg-danger">
           <h4 class="text-white">Registration Form</h4>
           <span class="text-white text-small">(Please Fiil in the fields correctly)<br>
             <b>NOTE:</b> Your details will not be shared with third party</span>
          </div>
        <div class="card-body">

       <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" id="regForm" enctype="multipart/form-data">
                 <div class="row">
           <div class="col-md-12">
             <div class="form-group">
               <label class="bmd-label-floating text-dark">Username* </label>
               <input type="text" class="form-control" value = '<?php echo "$username"; ?>' name="username" >
               <span class="error_Msg"><?php echo "$usernameErr"; ?></span>
             </div>
           </div>
           <div class="col-md-12 ">
            <div class="form-group ">
            <label for="password" class="bmd-label-floating text-dark">Email*</label>
                 <input class="form-control" value="<?php echo "$email"; ?>"  name="email" type="email" >
                  <span class="error_Msg"><?php echo "$emailErr"; ?></span>
               </div>
               </div>
               <div class="col-md-12 ">
                <div class="form-group ">
                <label for="password" class="bmd-label-floating text-dark">Password*</label>
                     <input class="form-control" value="<?php echo "$password"; ?>"  name="password" type="password"  >
                      <span class="error_Msg"><?php echo "$passwordErr"; ?></span>
                </div>
                </div>

                <div class="col-md-12 ">
                 <div class="form-group ">
                 <label for="password" class="bmd-label-floating text-dark">Confirm Password*</label>
                      <input class="form-control" name="cpass" type="password" value="<?php echo "$cpass"; ?>" >
                       <span class="error_Msg"><?php echo "$cpassErr"; ?></span>
                    </div>
                    </div>

                    <div class="col-md-12 ">
                       <div class="form-group ">
                     <label for="password" class="bmd-label-floating text-dark">Sponsor ID(Referral) </label>
                          <input class="form-control" name="sponsor" value="<?php echo "$sponsor"; ?>" type="text">
                           <span class="error_Msg"><?php echo "$sponsorErr"; ?></span>
                        </div>
                        </div>

               <button type="submit" class="btn btn-danger btn-lg w-100 mb-2" >Register</button>
              <div class="container">
               <span class="float-right">Already have an Account? <a href="login.php">Login</a></span>
               </div>
       </form>
</div>
  </div>

      </div>

    </div>
  </div>
</div>
</div>
	<!--//services-sec-->
  <!-- footer-66 -->
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
  <script src=" assets/js/jquery.min.js"></script>
  <script src=" assets/js/popper.min.js"></script>
  <script src=" assets/js//bootstrap-material-design.min.js"></script>
  <script src="assets/js/jquery-3.3.1.min.js"></script>
  <script src="assets/js/theme-change.js"></script>
  <!-- disable body scroll which navbar is in active -->
  <script>

  function resetForm(){
    document.getElementById("regForm").reset();
  }
    $(function () {
      $('.navbar-toggler').click(function () {
        $('body').toggleClass('noscroll');
      })
    });
  </script>
  <!-- disable body scroll which navbar is in active -->
  <!--/MENU-JS-->
  <script>
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
