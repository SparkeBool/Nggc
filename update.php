<?php
include "db_connect.php";
$fname = $lname = $email = $address = $state = $city = $phone = $acctNo = $acctName = $bankName = $sponsorid = $about = $username = "" ;

		if(isset($_POST['update'])) {


	        if($stmt = $conn->prepare('UPDATE members SET FNAME=?, LNAME=?, ADDRESS=?, STATE=?, CITY=?, PHONE=?, ACCT_NUM =?, ACCT_NAME=?, BANK_NAME=?, ABOUT=? WHERE EMAIL=?')){

	      		 $stmt->bind_param('ssssssss',$_POST['fname'],$_POST['lname'], $_POST['address'], $_POST['state'], $_POST['city'], $_POST['phone'],$_POST['acctNo'], $_POST['acctName'], $_POST['bankName'], $_POST['about'], $_POST['username']);
	      		$stmt->execute();
	         echo "<div class='alert alert-success alert-dismissible'>
	        <button type='button' class='close' data-dismiss='alert'>&times;</button> Record Updated Successfully </div>";

	        $conn->close();
	 } else {
	     echo "Error updating record: " . $conn->error;
	 }
		//header("Location:edit_staff.php");

	 }



 ?>
