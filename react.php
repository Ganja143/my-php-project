<?php

  // call for connection
  require 'connection.php';
  require 'logincode.php';

 //Session starts here
  session_start();

  //Checking if the user is logged in to access this page
  if(isset($_SESSION['mail'])){
 

    require 'user_session.php';
    require 'user_comp_profile.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/font-awesome.min.css">
<link rel="stylesheet" href="../fontawesome-free-5.15.4-desktop/svgs/regular/all.css">
<link rel="stylesheet" href="../css/bootstrap.css">

<title>Title</title>
</head>
<body>


<!-- Bootstrap JavaScript Libraries -->
<script src="../js/jquery-3.3.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php
   
        }else{
            
          //If the user is not logged in they are redirected to the login
            header("Location:login.php");
        }  
      
?>