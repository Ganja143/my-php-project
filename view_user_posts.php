
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
 <?php  require_once("user_comp_profile.php") ; 
 
 $user_mail=$_SESSION['mail'];
 
 ?>
 
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
              <a class="nav-link " href="account.php">Edit account</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="view_user_posts.php">View your Posts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="account.php?del=<? $user_mail   ?>">delete Account</a>
            </li>
        </ul>
      </div>
      <div class="card-body">
        <h4 class="card-title">Your Posts</h4>
        <p class="card-text">
            <?php
                  $count=0;
                  $sql="SELECT * FROM `posts` WHERE `Username` ='$user_mail'";

                  $res=mysqli_query($conn,$sql);

                  if(mysqli_num_rows($res) >0){ 
             ?>
              
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                 
                 <table class="table table-condensed table-hover ">
                  <thead>
                    <tr>
                      <th>Posts</th>
                      <th>Images</th>
                      <th>Caption</th>
                      <th>Date</th>
                      <th>Day</th>
                      <th>Edit posts</th>
                      <th>Delete posts</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        while($row=mysqli_fetch_assoc($res)){
                     
                          $image=$row['File Name'];
                          $caption=$row['Caption'];
                          $date=$row['Date'];
                          $day=$row['Day'];
                          $postId=$row['User_id'];
                          $count=$count+1;
                    ?>
                    <tr>
                      <td><?= $count; ?></td>
                      <td><img src="../images/<?= $image  ?>" height="60vh" width="width:30%" alt="" ></td>
                      
                      <td>
                        
                        
                            <?php 
                            if(!isset($_GET['caption'])){
                              echo $caption; 
                            }
                            
                            if(isset($_GET['caption']))

                            {   ?>
                        <form  method="post">
                          <input type="text" name="caption" value="<?= $caption ?> ">
                          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                          <?php
                                $cap=isset($_POST['caption'])? $_POST['caption']: "";

                                  if(isset($_POST['submit'])){

                                   

                                    $sql="UPDATE `posts` SET `Caption`='$cap' WHERE `User_id` = '".$_GET['caption']."'";
                                    $res=mysqli_query($conn,$sql);
                                    if($res){
                                      header("Location:view_user_posts.php");
                                    }

                                  }
                            
                          ?>
                        </form>
                        <?php   } ?>

                        <td><?= $date  ?></td>
                      </td>
                      <td><?= $day  ?></td>
                      <td> <a href="view_user_posts.php?caption=<?= $postId   ?>">Edit</a></td>
                      <td> <a href="view_user_posts.php?del=<?= $postId   ?>">Delete</a></td>
                      <?php

                              if(isset($_GET['del'])){

                                $sql="DELETE FROM `posts` WHERE `User_id` = '".$_GET['del']."'";
                                $res=mysqli_query($conn,$sql);
                                if($res){
                                  header("Location:view_user_posts.php");
                                }
                              }

                      ?>

                    </tr>
                    <?php 
                 } 
                }else{
                  header("Location:createPost.php");
            }  ?> 
                  </tbody>
               
                 </table>
                 
             
                 
                
            </div>
            
         
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