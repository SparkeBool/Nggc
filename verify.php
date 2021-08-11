<?php

include("db_connect.php");
$verify_id=$_GET['approve'];
$verify_query="UPDATE payment_uploads set status='VERIFIED' WHERE id='$verify_id'";//delete query
$run=mysqli_query($conn,$verify_query);
if($run)
{

    echo "<script>window.open('Admin_dashboard.php?Verified= md5($verify_id) payment status','_self')</script>";
}

?>
