<?php

include("db_connect.php");
$verify_id=$_GET['payslip'];

// Get images from the database
$sql = "SELECT file_name FROM payment_uploads where id='$verify_id' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        $imageURL = 'payment_upload/'.$row["file_name"];}
      }
?>

<img src="<?php echo $imageURL; ?>" alt="" />
