<?php

  // call for connection
  require 'connection.php';
  require 'logincode.php';

 //Session starts here
  session_start();

  //Checking if the user is logged in to access this page
  if(isset($_SESSION['mail'])){

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
<link rel="stylesheet" href="../css/bootstrap.css">
<title>Title</title>
</head>
<body>
<?php  require 'user_session.php' ; ?>
<header>
    <!-- place navbar here -->
    <nav class="nav nav-tabs nav-stacked bg-dark">
    <a class="nav-link " href="viewPost.php" ><b>View Posts</b></a>
    <a class="nav-link active" href="createPost.php"><b>Send Posts</b></a>
    <div class="dropdown">
      <button id="my-dropdown" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#007bff;"><b><?=$name?></b></button>
      <div class="dropdown-menu" aria-labelledby="my-dropdown">
        <a class="nav-link " href="profile.php"><b>Profile</b></a>
        <a class="nav-link " href="account.php"><b>Account</b></a>
      <a class="nav-link" href="logout.php"><b>Logout</b></a>
      </div>
    </div>
 </nav><br>
</header>
  <main class="bg-primary">
    
    <div class="col-xs- col-sm- col-md- col-lg-  bg-secondary  ">
        <h4 class="text-center" style="color:white;">Create Post</h4>
      <form method="post" action="" enctype="multipart/form-data" >
            <div class="form-group">
                    <label for="# "><b>Profile Pic :</b></label>
                    <input class="form-control" type="file" name="uploadfile" value="" accept="image/*" required="required"/>
            </div>
            <div class="mb-3">
              <label for="" class="form-label"><b>Caption</b></label>
              <input type="text"
                class="form-control" name="caption"  placeholder="Enter Caption" value="<?php echo $cap=isset($_POST['caption'])? $_POST['caption']:"";  ?>" >
            </div>
            
            <div class="form-group">
              <div class="col-sm-6 col-sm-offset-2">
                <button type="submit" class="btn btn-primary" name="btn_submit" >Submit</button>
              </div>
            </div>
            
      </form>
    </div>
    <?php
       
       $view=0;

          if(isset($_POST['btn_submit'])){

            $date=date('D');
            $date2=date('d/m/Y');
            $cap=ucfirst($cap);
            $user=$_SESSION['mail'];
           

             //file convention
             $filename = $_FILES["uploadfile"]["name"];
             $tempname = $_FILES["uploadfile"]["tmp_name"];
             $folder = "../images/" . $filename;

               // Now let's move the uploaded image into the folder: image
               if (move_uploaded_file($tempname, $folder)) {
                 
                  $sql="INSERT INTO `posts`(`User_id`, `File Name`, `Caption`, `Username`, `Date`, `Day`, `view_post`) VALUES ( NULL , '$filename' , '$cap' , '$user' , '$date2' , '$date' , '$view')";
                  $res=mysqli_query($conn,$sql);
                  if($res){
                    
                    $view=$view+1;
                    header("Location:viewPost.php");

                  }

               }else {
                           echo "<h3> Failed to upload image!</h3>";
                  }
                

                $sql5="UPDATE `users` SET `Alert`='$view' WHERE Email='$user'";
                $result=mysqli_query($conn,$sql5);
                if($result)
                {
                  header("Location:viewPost.php");
                }

          }

    ?>
    

  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  
  <!-- Bootstrap JavaScript Libraries -->
<script src="../js/popper.min.js"></script>
<script src="../js/jquery-3.3.1.slim.min.js"></script>
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