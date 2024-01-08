<?php

  // call for connection
  require 'connection.php';
  require 'logincode.php';

 //Session starts here
  session_start();

$user_mail= $_SESSION['mail'];

$sql4="SELECT Username FROM `user profile` WHERE `Username` = '$user_mail'";
$results=mysqli_query($conn,$sql4);

if(mysqli_num_rows($results) >0){

$row=mysqli_fetch_assoc($results);

    $user=$row['Username'];
 
}
    if($user_mail==$user)
    {
        header("Location:viewPost.php");
    }else{
        $sql2 ="INSERT INTO `user profile`(`User_id`, `Postal Address`, `Phone`, `Post`, `Tasks`, `School Name`, `Completion year`, `Specialization`, `Skills`, `Username`) VALUES ( '' , '' , '' , '' , '' , '' , '' , '' , '' , '$user_mail')";
        $res2=mysqli_query($conn,$sql2); 
        if($res2){

            echo 'We are good';
        }
    }
      
       
    


?>