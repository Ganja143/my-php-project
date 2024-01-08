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
<link rel="stylesheet" href="../fontawesome-free-5.15.4-desktop/svgs/regular/all.css">
<link rel="stylesheet" href="../css/bootstrap.css">
<title>Title</title>
</head>
<body>
 <?php require 'user_session.php'; ?>
 <?php  require_once("user_comp_profile.php") ;  ?>
 
    <header>
        <!-- place navbar here -->
        <nav class="nav nav-tabs nav-stacked bg-dark" >
          <a class="nav-link" href="profile.php" ><b> <i class="fa fa-fast-backward" aria-hidden="true"></i> Back</b></a>
        </nav><br>
    </header>

    <main>

    <div class="card text-center">
      <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
          <li class="nav-item">
            <a class="nav-link active" href="#">Edit account</a>
          </li>
          <li class="nav-item">
          <a class="nav-link " href="view_user_posts.php">View your Posts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="account.php?del=<? $user_mail   ?>">delete Account</a>
          </li>
         
        </ul>
      </div>
      <div class="card-body">
        <h4 class="card-title">Your Account</h4>
        <p class="card-text">

        <form action="" method="post">

          <table class="table table-hover">
            
            <thead>
              <tr>
                <th>Title</th>
                <th>Edit details</th>
              </tr>
            </thead>
            <tbody>
              
              <tr>
                <td>First Name</td>
                <td><input type="text"  name="txt_name" value="<?php echo $name;  ?>"></td>
              
              </tr>
              <tr>
                <td>Last Name</td>
                <td><input type="text"  name="txt_surname" value="<?= $surname;  ?>"></td>
               
              </tr>
              <tr>
                <td>Postal Address</td>
                <td><textarea type="text"  name="txt_postal"  rows="3"><?= $postal;  ?></textarea></td>
              
              </tr>
              <tr>
                <td>Phone</td>

                <td><input type="text" name="txt_phone" value="<?= $phone;  ?>"></td>
            
              </tr>
              <tr>
                <td>Position</td>
                <td><input type="text" name="txt_post" value="<?= $post;  ?>"></td>
              
              </tr>
              <tr>
                <td>Task</td>
                <td><input type="text"  name="txt_task" value="<?= $task;  ?>"></td>
              
              </tr>
              <tr>
                <td>School</td>
                <td><input type="text"  name="txt_school" value="<?= $school;  ?>"></td>
             
              </tr>
              <tr>
                <td>Year</td>
                <td><input type="text"  name="txt_year" value="<?= $year;  ?>"></td>
             
              </tr>
              <tr>
                <td>Specialisation</td>
                <td><input type="text"  name="txt_special" value="<?= $special;  ?>"></td>
             
              </tr>
              <tr>
                <td>Skills</td>
                <td><textarea type="text"  name="txt_skills" rows="3"> <?= $skills;  ?></textarea></td>
             
              </tr>
            </tbody>
            <tfoot><tr><td>
            <button type="submit" name="btn_submit" class="btn btn-primary">Edit and click here to Update</button>
            <?php 
            
                if(isset($_POST['btn_submit']))
                {
                    $name=isset($_POST['txt_name'])? $_POST['txt_name']:"";
                    $surname=isset($_POST['txt_surname'])? $_POST['txt_surname']:"";
                    $postal=isset($_POST['txt_postal'])? $_POST['txt_postal']:"";
                    $post=isset($_POST['txt_post'])? $_POST['txt_post']:"";
                    $phone=isset($_POST['txt_phone'])? $_POST['txt_phone']:"";
                    $task=isset($_POST['txt_task'])? $_POST['txt_task']:"";
                    $school=isset($_POST['txt_school'])? $_POST['txt_school']:"";
                    $year=isset($_POST['txt_year'])? $_POST['txt_year']:"";
                    $special=isset($_POST['txt_special'])? $_POST['txt_special']:"";
                    $skills=isset($_POST['txt_skills'])? $_POST['txt_skills']:"";
            


                    $sql="UPDATE `users` SET `First Name`='$name',`Last Name`='$surname' WHERE Email = '$user_mail'";
                    $res=mysqli_query($conn,$sql);

                    $sql2="UPDATE `user profile` SET `Postal Address`='$postal',`Phone`='$phone',`Post`='$post',`Tasks`='$task',`School Name`='$school',`Completion year`='$year',`Specialization`='$special',`Skills`='$skills'  WHERE Username ='$user_mail'";
                    $res2=mysqli_query($conn,$sql2);

                    if($res){
                      header("Location:account.php");
                    }

                }
            ?>
            </td></tr></tfoot>
          </table>
          </form>

        </p>
      </div>
    </div>



    </main>

    <footer>

    </footer>












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