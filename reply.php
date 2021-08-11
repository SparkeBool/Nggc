<?php
session_start();
include_once('db_connect.php');



if(isset($_POST['sendMsg'])){

          $replyMsg ='';
          $theSndr = $_SESSION['send'];
          $message =  $_POST['replymsg'];
          $status ="UNREAD";
          $by ='Admin';
          $create_dateTime = strval( date("d/m/Y g:i:a"));

        //var_dump($username);

        if(!empty($message)){

          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

         // prepare and bind
         $stmt = "INSERT INTO message(Message,Sender ,Receiver,status,sendDate) VALUES ('".$message."','".$by."', '".$theSndr."','".$status."' ,'".$create_dateTime."')";
         $result = $conn->query($stmt);
       if(  $result){
        $replyMsg = "<span class='text-white bg-success nc-icon nc-check-2 p-2  m-1'> Message Sent</span>";
        echo "<script>window.open('Notify.php?deleted= Message has been deleted','_self')</script>";
    }
        }

        }else{
                $replyMsg = "<span class='text-white bg-danger nc-icon nc-check-2 p-2  m-1'> Message Not Sent</span>";
        }

      unset($_SESSION['send']);

        ?>
