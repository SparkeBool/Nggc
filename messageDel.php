<?php

include("db_connect.php");
$delete_id=$_GET['del'];
$delete_query="delete from message WHERE id='$delete_id'";//delete query
$run=mysqli_query($conn,$delete_query);
if($run)
{

    echo "<script>window.open('Notify.php?deleted= Message has been deleted','_self')</script>";
}


?>
