<?php

  // call for connection

  require 'connection.php';
  require 'logincode.php';

  session_start();

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
<link rel="stylesheet" href="../fonts1/shims.json">
<link rel="stylesheet" href="../css/bootstrap.css">
<!-- <link rel="stylesheet" href="/css/style.css"> -->
<title>Sign-up page</title>
</head>
<body>

    <?php
    // call for connection
    require 'connection.php';
    error_reporting(0);

    ?>
    
    <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 " style="margin-left:4%;">

           <!-- hey here we will put the registration form using bootstrap forms -->
   <div class="card">
   
   <div class="card-header text-center">
   <a href="login.php"><i class="fa fa-hand-o-left fa-1x" aria-hidden="true"style="float:left;text-decoration:none;color:black; margin-top:2vh;margin-left:2%;"><b> Login page</b></i></a>
      <h1 class="bg-primary" style="color:white">Registration Page</h1> 
   </div>
   <div class="card-body">
       
   <form  method="post"  enctype="multipart/form-data">
      
       <div class="form-group">
           <label for="First Name "><b>First Name :</b></label>
           <input type="text" name="txt_fname" class="form-control"  placeholder="First-Name" required="required"  value="<?= $fname=isset($_POST['txt_fname'])? $_POST['txt_fname'] : "" ;?>">
       </div>
       <div class="form-group">
           <label for="# "><b>Last Name :</b></label>
           <input type="text" name="txt_lname" class="form-control"  placeholder="Last-Name" required="required"  value="<?=  $lname=isset($_POST['txt_lname'])? $_POST['txt_lname'] : "" ;?>" >
       </div>
       <div class="form-group">
           <label for="# "><b>Username :</b></label>
           <input type="email" name="mail" class="form-control"  placeholder="Username" required="required" value="<?= $mail=isset($_POST['mail'])? $_POST['mail'] : "" ;    ?>" >
       </div>
       <div class="form-group">
               <label for="# "><b>Password :</b></label>
               <input type="password" name="pass" class="form-control"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  placeholder="Password" <?=  $pWord=isset($_POST['pass'])? $_POST['pass'] : "" ;    ?> required="required" ><br>

               <div class="alert alert-primary">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <strong>Follow this password setting format!</strong>
                   <p>1. Must contain at least lower case letter</p>
                   <p>2. Must have at least one number</p> 
                   <p>3. Must have at least one special character</p>
                   <p>4 Must be 8 characters long</p>
                   <p>5. Must have at least one Uppercase</p>
               </div><br>

       </div>
       <div class="form-group">
           <label for="# "><b>Profile Pic :</b></label>
           <input class="form-control" type="file" name="uploadfile" value="" accept="image/*" required="required"/>
       </div>

       <input type="submit" class="btn btn-primary justify" name="btn_submit" value="Register now">


   </form>
   </div>
   <?php

           if(isset($_POST['btn_submit'])){

               $fname=ucfirst($fname);
               $lname=ucfirst($lname);
               $mail=strtolower($mail);

               //file convention
               $filename = $_FILES["uploadfile"]["name"];
               $tempname = $_FILES["uploadfile"]["tmp_name"];
               $folder = "./profile/" . $filename;
              

              // $pWord=password_hash($pWord, PASSWORD_BCRYPT , array('cost'=>10));

               //check if email has been registered before
               
               if(isset($mail))
               {
                       
                   $sql2="SELECT * FROM `users` WHERE Email='$mail'";

                   $res=mysqli_query($conn,$sql2);
           
                   if (mysqli_num_rows($res) > 0) 
                   {
                           
                           $row = mysqli_fetch_assoc($res);

                           if($mail==isset($row['Email']))
                           {
                   ?>

                      <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                           <strong>Oops!</strong><br>
                           Email already exists...
                       </div>


                   <?php
                               
                           }
               


                   }else{

                     

                       $sql="INSERT INTO `users` (`User_id`, `First Name`, `Last Name`, `Email`, `Password`, `Profile`) VALUES (NULL, '$fname' , '$lname' , '$mail' ,'$pWord' , '$filename')";
                       $res= mysqli_query($conn,$sql);
                       if($res){
                   
               
                   // Now let's move the uploaded image into the folder: image
                   if (move_uploaded_file($tempname, $folder)) {
                       
                       echo "<h3> Profile image set successfully!</h3>";
                       
                   } 
              
    ?>
        
        
        <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Congratulations!</strong><br>
        You have successfully registered...
        <?php header('location:login.php') ; ?>
        </div>
        

    <?php
                }else {
                echo "<h3> Failed to upload image!</h3>";
            }
            }

            }
        }

    ?>

        
    </div>
    
 

<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>

<?php

    }else{
        header("Location:viewPost.php");
    }

?>