    <?php
    error_reporting(0);
    include "db_connect.php";

     $username = $password = $cpass = $email = $create_dateTime = $sponsor= $status="" ;
     $usernameErr =$emailErr =  $passwordErr = $cpassErr =$sponsorErr ="";


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      if(empty($_POST['username'])){

        $usernameErr = "<span class='bi-patch-exclamation'> Please Enter Username </span>";

    }else{
      $username =  $_POST["username"];

     }

     if(empty($_POST['password'])){
      $passwordErr = "<span  class='bi-patch-exclamation'> Please Enter Password</span>";

    }else if ( strlen($_POST["password"]) < 8) {
        $passwordErr = "Password should be atleast 8 characters";


      }else{
          $password =  $_POST["password"];

    }


    if(empty($_POST['cpass'])){

      $cpassErr = "<span  class='bi-patch-exclamation'>  Please Confirm your password </span>";

    }elseif (strval($password) !== $_POST['cpass']) {
      $cpassErr = "<span  class='bi-patch-exclamation'> Passwords do not Match! </span>";

      }else{
       $cpass =  $_POST["cpass"];

      }
      //var_dump($_POST['cpass']);

      if(empty($_POST['sponsor'])){

        $sponsorErr = "<span class='bi-patch-exclamation'> Enter Sponsor/referral Username </span>";

    }else{
      $sponsor =  $_POST["sponsor"];

     }
     if($stmt = $conn->prepare("SELECT username FROM users WHERE username=? ")){

          $stmt->bind_param('s',$_POST["sponsor"]);
         $stmt->execute();

          $result = $stmt->get_result();
           if(!$result->num_rows >0 ){
             $sponsorErr = " Invalid Sponsor/referral Id suppllied";
         }
       }else {
         $sponsorErr = "";
       }

      if(empty($_POST['email'])){

        $emailErr = "<span  class='bi-patch-exclamation'> Enter your Email </span>";

      }else{
        $email = $_POST['email'];
      }

    if($stmt = $conn->prepare("SELECT email FROM users WHERE email=? ")){

         $stmt->bind_param('s',$_POST['email']);
        $stmt->execute();

         $result = $stmt->get_result();
          if($result->num_rows >0 ){
            $emailErr = " User already exists";
        }
      }else {
        $emailErr ="";
        $email = $_POST['email'];
      }

      if($stmt = $conn->prepare("SELECT username FROM users WHERE username=? ")){

           $stmt->bind_param('s',$_POST['username']);
          $stmt->execute();

           $result = $stmt->get_result();
            if($result->num_rows >0 ){
              $usernameErr = " Username Already exists";
          }
        }else {
          $usernameErr ="";
        }

        $create_dateTime = strval( date("Y-m-d H:i:s"));



      if (!empty($usernameErr) || !empty($cpassErr) || !empty($emailErr) || !empty($passwordErr) || !empty($sponsorErr)) {

        echo "  <div class='alert alert-danger m-3  fadeOut text-danger '>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <i class='material-icons'>&times;</i>
            </button>
            <span>
              <b> Warning - </b> Please fill all <b>Fields</b> correctly then proceed</span>
          </div>";

  }else{


 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }

// prepare and bind
 $stmt = $conn->prepare("INSERT INTO users(username, email, password,reg_DateTime) VALUES (?, ?, ?, ?)");

 // set parameters and execute
   if($stmt){
     $stmt->bind_param("ssss", $username, $email, md5($password), $create_dateTime);

   if ($stmt->execute()) {
     $status = "Registered";
       echo "<div class='alert alert-success m-3 sticky-top'>
           <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
             <i class='material-icons'>&times;</i>
           </button>
           <span>
             <b> SUCCESS - </b> Registration Successfully!<a href='login.php'> Click here to Login</a></span>
         </div>";
         //create password recover backup
         $stmt1 = $conn->prepare("INSERT INTO passRecover(username,password,email) VALUES (?,?,?)");
          $stmt1->bind_param("sss",$username,$password,$email);
          $stmt1->execute();
          //create user referral record
          $stmt = $conn->prepare("INSERT INTO referral(sponsor_username,sponsee_username,status) VALUES (?,?,?)");
           $stmt->bind_param("sss",$sponsor,$username,$status);
           $stmt->execute();
           //create member record
           $stmt = $conn->prepare("INSERT INTO member(USERNAME,EMAIL,SPONSOR_ID) VALUES (?,?,?)");
            $stmt->bind_param("sss",$username,$email,$sponsor);
            $stmt->execute();
   }else{
       echo "Error: " .$conn->error;
     }
 }else{
     echo "Error: " .$conn->error;
   }



     $stmt->close();
     $conn->close();
  }


}







    ?>
