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
<?php



$caption="Post notifications: see new post";
$date=date('D');
$date2=date('d/m/Y');
$unread=0;
$totalAlerts=0;
$likes=0;
$dislikes=0;

$user_mail=$_SESSION['mail'];

$sql="SELECT * FROM `users` WHERE Email = '$user_mail' ";
$res= mysqli_query($conn,$sql);

if($res->num_rows>0){

    while($row=mysqli_fetch_assoc($res)){
      
        $name=$row['First Name'];
        $surname=$row['Last Name'];
        $profile_pic=$row['Profile'];
    }
}
?>

 <header>
    <!-- place navbar here -->
    <nav class="nav nav-tabs nav-stacked bg-dark" >
    <a class="nav-link active" href="viewPost.php" ><b>View Posts</b></a>
    <a class="nav-link " href="createPost.php"><b>Send Posts</b></a>
    <div class="dropdown">
      <button id="my-dropdown" class="btn btn-dark nav-link  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#007bff;"><b><?= $name ?></b></button>
      <div class="dropdown-menu" aria-labelledby="my-dropdown">
        <a class="nav-link " href="profile.php"><b>Profile</b></a>
        <a class="nav-link " href="account.php"><b>Account</b></a>
      <a class="nav-link" href="logout.php"><b>Logout</b></a>
      </div>
    </div>
 </nav><br>
  </header>
  <main style="display:flex;flex-wrap:wrap;">
     
     <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bg-primary" style="float:left;">
      <div class="card" style="border-radius:5px;">
        <?php

            $sql="SELECT * FROM `users` WHERE Email != '$user_mail' ";
            $res= mysqli_query($conn,$sql);
            
            if($res->num_rows>0){
               
        ?>
      <div class="card-header" >
          <h4 class="text-center"> Posts notifications</h4>
        </div>
        <?php  

              while($row=mysqli_fetch_assoc($res)){
                $name1=$row['First Name'];
                $surname=$row['Last Name'];
                $profile_pic=$row['Profile'];
                $user=$row['Email'];
                $unread=$row['Alert'];
             
          ?>
        <div class="card-body text-left ">

           <a href="other_profiles.php?profile=<?= $user   ?>" style="text-decoration:none; color:black;">
                <div><h5 class="card-title"> <img src="./profile/<?=  $profile_pic  ?>" class="img-responsive"  alt="Image" width="10%" height="36vh" style="border-radius:150px; text-decoration:none;"><?= "   " . $name1; ?></h5></div>
           </a>
            <p class="card-text">
             <a href="viewPost.php?view=<?= $user   ?>"> <button class="btn btn-primary" >
                <?= $caption  ?>
                <span class="badge badge-pill bg-secondary"><?= $unread ?></span>
              </button></a>
          </p>
          
        </div>
     <?php 
          }
              } 
        ?>
         
      </div>
     </div>
     <?php
        if(isset($_GET['view'])){

          $sql="SELECT * FROM `posts` WHERE Username='" . $_GET["view"] . "'";
          $res=mysqli_query($conn,$sql);
          if($res)
          {
            $view=0;
          }

     ?>
     <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
      <?php
            if($res->num_rows>0){

      ?>
        <div class="card">
            <div class="card-header">
             <h3 class="text-center"><?php 
             $sql1="SELECT * FROM `users` WHERE Email='". $_GET["view"]. "'";
             $resu=mysqli_query($conn,$sql1);
              while($datayam=$resu->fetch_assoc()){
                echo"🧡 ". $datayam['First Name']."'s posts 🧡";
              }
             
             ?></h3>
            </div>
            <?php 
                while($row=mysqli_fetch_assoc($res)){

                  $caption=$row['Caption'];
                  $poster=$row['File Name'];
                  $day=$row['Day'];
                  $date2=$row['Date']; 
                  $id=$row['User_id'];
                  $like=$row['Total Likes'];
                  $dislike=$row['Total Dislikes'];

            ?>
            <div class="card-body" style="border:2px solid black">
              <p class="card-title bg-secondary" style="color:black;"><?= $caption  ?></p>
              <p class="card-text">
              <img src="../images/<?= $poster   ?>" class="img-responsive" alt="Image" width="100%" height="300vh">
              </p>
               
              <p>
              <p class="card-text" style="float:right"><?= $date."   ".$date2  ?></p>
             <!--   here we put the icons and likes/comments section     -->
              <?php 
                    $view=$_GET['view'];
                    $uid=$id;
                    if(isset($view) &&!isset($_GET['liked']) && !isset($_GET['dislike']) && $uid===$id){    
              ?>
              <span this.onload()><a href="viewPost.php?view=<?= $_GET['view']?>&&liked&&postid=<?= $id  ?>"><i class="fa fa-thumbs-o-up fa-2x" aria-hidden="true" style="margin-left:0%;"></i><?= $like;  ?></a></span>
              <span this.onload()><a href="viewPost.php?view=<?= $_GET['view']?>&&dislike&&postid=<?= $id  ?>"><i class="fa fa-thumbs-o-down fa-2x" aria-hidden="true" style="margin-left:2%;"></i><?= $dislike;  ?></a></span>
              <span this.onload()><a href="viewPost.php?view=<?= $_GET['view']?>&&comment&&postid=<?= $id  ?>"><i class="fa fa-commenting-o fa-2x" aria-hidden="true" style="margin-left:5%;"></i></a></span>  
              </p>
              <?php
                  }elseif(isset($view) &&isset($_GET['liked']) &&isset($_GET['postid']) ){ 
                    $dislikes=0; 
                    $likes=$likes+1;
                    $sql9="UPDATE `posts` SET `Total Likes`='$likes', `Total Dislikes`='$dislikes' WHERE `User_id`='". $_GET["postid"]. "' ";
                    $rest=mysqli_query($conn,$sql9); 
              ?>
               <span this.onload()><a href="viewPost.php?view=<?= $_GET['view']?>&&like&&postid=<?= $_GET['postid'] ?>"><i class="fa fa-thumbs-up fa-2x" aria-hidden="true" style="margin-left:0%;"></i><?= $like;  ?></a></span>
              <span this.onload()><a href="viewPost.php?view=<?= $_GET['view']?>&&dislike&&postid=<?= $_GET['postid']  ?>"><i class="fa fa-thumbs-o-down fa-2x" aria-hidden="true" style="margin-left:2%;"></i><?= $dislike;  ?></a></span>
              <span this.onload()><a href="viewPost.php?view=<?= $_GET['view']?>&&comment&&postid=<?= $_GET['postid']  ?>"><i class="fa fa-commenting-o fa-2x" aria-hidden="true" style="margin-left:5%;"></i></a></span>  
              </p>

              <?php }else if(isset($view) &&isset($_GET['dislike']) && isset($_GET['postid'])){ 

                    $dislikes=$dislikes+1;
                    $likes=0;
                    $sql19="UPDATE `posts` SET `Total Dislikes`='$dislikes', `Total Likes`='$likes' WHERE `User_id`='". $_GET["postid"]. "'";
                    $rest=mysqli_query($conn,$sql19);

              ?>
                <span this.onload()><a href="viewPost.php?view=<?= $_GET['view']?>&&likepostid=<?= $_GET['postid']  ?>"><i class="fa fa-thumbs-o-up fa-2x" aria-hidden="true" style="margin-left:0%;"></i><?= $like;  ?></a></span>
                <span this.onload()><a href="viewPost.php?view=<?= $_GET['view']?>&&dislike&&postid=<?= $_GET['postid']  ?>"><i class="fa fa-thumbs-down fa-2x" aria-hidden="true" style="margin-left:2%;"></i><?= $dislike;  ?></a></span>
                <span this.onload()><a href="viewPost.php?view=<?= $_GET['view']?>&&comment&&postid=<?= $_GET['postid']  ?>"><i class="fa fa-commenting-o fa-2x" aria-hidden="true" style="margin-left:5%;"></i></a></span> 
                
                     
                
               
               </p>
               <?php } 
                    if(isset($_GET['view']) && isset($_GET['comment']) && isset($_GET['postid'])){
                ?>
                 <form action="" method="post">
                    
                    <div class="form-group">
                      <label for="textareacomments" class="col-sm-2 control-label">comments:</label>
                      <div class="col-sm-8 justify-content-end" >
                        <textarea name="comments" id="textareacomments" class="form-control" rows="1" required="required"></textarea>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary" name="btn_submit">Send</button>
                      </div>
                    </div>
                    
              </form>

                <?php 

                  $commenter=$_SESSION['mail'];
                  $commenter_name=$name;
                  $pro_pic=$profile_pic;
                  $post_name=$poster;
                  $comment=isset($_POST['comments'])? $_POST['comments']:"";

              
              
              
                } ?>
                 
                </p>
            </div><br>
            <?php 
                   } } else{ 
            
            ?>

         
           <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
               <div class="card">
                    <div class="card-header">
                    <h2 class="text-center"> View Posts</h2>
                    </div>
               <div class="card-body" style="border:2px solid black">
              <h4 class="card-title"><span class="badge badge-pill badge-success">Oops!</span></h4>
              <p class="card-text">

                 <b><?php  require 'get_mail_data.php'; echo $name3." ".$surname3;  ?>:</b>  Has not posted anything yet
              </p>
              
             
            </div>
       <?php   } ?>
        </div>
     </div>
     
     <?php
      }else{
            if($unread==0){
              $sql="SELECT * FROM `posts`";
              $res=mysqli_query($conn,$sql);
            
      
     ?>
     <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
      <?php
            if($res->num_rows>0){

      ?>
        <div class="card">
            <div class="card-header">
             <h2 class="text-center"> View Posts</h2>
            </div>
            <?php 
                while($row=mysqli_fetch_assoc($res)){

                  $caption=$row['Caption'];
                  $poster=$row['File Name'];
                  $day=$row['Day'];
                  $date2=$row['Date'];


                  
            ?>
            <div class="card-body" style="border:2px solid black">
              <p class="card-title bg-secondary" style="color:black;"><?= $caption  ?></p>
              <p class="card-text">
              <img src="../images/<?= $poster   ?>" class="img-responsive" alt="Image" width="100%" height="300vh">
              </p>
              <p class="card-text" style="float:right"><?= $date."   ".$date2  ?></p>
             
              <span><a href="viewPost.php?like"><i class="fa fa-thumbs-o-up fa-2x" aria-hidden="true" style="margin-left:0%;"></i></a></span>
              <span><a href="viewPost.php?dislike"><i class="fa fa-thumbs-o-down fa-2x" aria-hidden="true" style="margin-left:2%;"></i></a></span>
              <span><a href="viewPost.php?comment"><i class="fa fa-commenting-o fa-2x" aria-hidden="true" style="margin-left:5%;"></i></a></span>

            </div><br>
            <?php 
                // setting the views back to zero such that when new ones come in the are set to new alerts again.
                $view=$unread;
                $totalAlerts=$totalAlerts+$view;
                $unread=0;
          } } }} ?>
        </div>
     </div>
      
  </main>
  <footer>
    <!-- place footer here -->
    <p>Development rights reserved </p>
  </footer>
  
  <!-- Bootstrap JavaScript Libraries -->

<script src="../js/jquery-3.3.1.slim.min.js"></script>
<script src="../js/jquery-2.1.4.min.js"></script>
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