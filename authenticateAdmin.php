<?php

  session_start();

  include("db_connect.php");
  $error_Msg1="";
  $error_Msg2="";
  $username = $user_pass="";

        if(isset($_POST['login'])){

        if(empty($_POST['userName'])){
          $error_Msg1="*Please Enter Username";
        }else{
          $username = $_POST['userName'];
        }

        if(empty($_POST['password'])){
          $error_Msg2="*Please Enter Password";
        }else{
          $user_pass= $_POST['password'];
        }

        if(empty($error_Msg1) || !empty($error_Msg2)){

        $check_user="select * from users WHERE username='nggc'AND PASSWORD='natural'";

        $run=mysqli_query($conn,$check_user);

        if(mysqli_num_rows($run))
        {
            echo "<script>window.open('Admin_dashboard.php','_self')</script>";
          //  echo "Login SUccess";

            $_SESSION['Admin']=$username;//here session is used and value of $user_email store in $_SESSION.

        }
        else
        {
          echo "<div class='alert alert-danger m-3 sticky-top'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <i class='material-icons'>&times;</i>
              </button>
              <span>
                <b> LOG IN FAILED - </b> Invalid Username or Password </span>
            </div> <script>$(document).ready(function(){resetForm(); }); </script>";
        }

      }else {
        echo "Please Enter Email and Password";
      }

    }
?>
