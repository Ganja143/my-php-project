
<?php

  // call for connection

  require 'connection.php';
  require 'logincode.php';

  if(!isset($_SESSION['mail'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="PHP Posting app"/>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/font-awesome.min.css">
<link rel="stylesheet" href="../css/bootstrap.css">
<title>Sign in page</title>
 <style>

    .nav{
        margin-right:auto;
    }
 </style>
 
</head>
<body>

 
 <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"style="margin-left:25%; margin-top:10vh;">

 <div class="card">

    <div class="card-body">
        <h1 class="card-title text-center bg-primary" style="color:white">Login Page</h1><br><br>

        <form method="post">

            <div class="form-group">
            <label >Username</label>
            <input type="email" class="form-control" name="mail"  placeholder="Username" required>
            </div>
            <div class="form-group">
            <label >Password</label>
            <input type="password" class="form-control" name="pass"  placeholder="Password" required>
            </div>
            <p>Don't have an account? <a href="register.php">Create one</a></p>
            <div class="form-group">
                <input type="submit" name="login" class="btn btn-primary w-30" value="Submit" style="margin-left:45%; margin-top:5vh;">
            </div>

        </form>


    </div>
</div>
    
 </div>
    
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php
   
        }else{
                 require 'relative_data.php';
                header("Location:viewPost.php");
        } 
         
      
      ?>