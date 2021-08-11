<?php

include("db_connect.php");
$delete_id=$_GET['del'];
$delete_query="delete from users WHERE username='$delete_id'";//delete query
$run=mysqli_query($conn,$delete_query);
if($run)
{

    echo "<script>window.open('Admin_dashboard.php?deleted=$delete_id has been deleted','_self')</script>";
}

?>
