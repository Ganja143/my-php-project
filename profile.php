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
<?php  require 'user_session.php' ;
      
?>

 <header>
    <!-- place navbar here -->
    <nav class="nav nav-tabs nav-stacked bg-dark">
    <a class="nav-link " href="viewPost.php" ><b>View Posts</b></a>
    <a class="nav-link " href="createPost.php"><b>Send Posts</b></a>
    <div class="dropdown">
      <button id="my-dropdown" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i><b>Account</b></button>
      <div class="dropdown-menu" aria-labelledby="my-dropdown">
        <a class="nav-link " href="profile.php"><b>Profile</b></a>
        <a class="nav-link " href="account.php"><b>Account</b></a>
      <a class="nav-link" href="logout.php"><b>Logout</b></a>
      </div>
    </div>
 </nav><br>
  </header>
  <main>
     <div class="container-fluid">
         
         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="float:left;">
            <div class="card text-center bg-secondary ">
                <img class="card-img-top" src="./profile/<?=  $profile_pic   ?>" alt="Title" style="width:20%;height:37vh;margin-left:36%;margin-top:3%;border-radius:180px;">
                
                <div class="card-body">
                  <h4 class="card-title " style="margin-right:10%;color:white;"><?= $name ." ".$surname   ?></h4>
                  <p class="card-text" style="color:White; margin-right:3%;"><b><?= 'Email Address: '. $uname?></b></p>
                </div>
              <div id="accordianId" role="tablist" aria-multiselectable="true">
                <div class="card">
                  <div class="card-header" role="tab" id="section1HeaderId">
                    <h5 class="mb-0">
                      <a data-toggle="collapse" data-parent="#accordianId" href="#section1ContentId" aria-expanded="true" aria-controls="section1ContentId">
                       <i class="fa fa-phone-square" aria-hidden="true"></i> <?= "Contact Details" ?>
                      </a>
                    </h5>
                  </div>
                  <div id="section1ContentId" class="collapse in" role="tabpanel" aria-labelledby="section1HeaderId">
                    <div class="card-body bg-secondary">
                    <?php 

                              $sql="SELECT * FROM `user profile` WHERE Username='$user_mail'";
                              $result=mysqli_query($conn,$sql);

                              if($result->num_rows>0)
                              {
                                while($row=mysqli_fetch_assoc($result))
                                {
                                    $postal_address=$row['Postal Address'];
                                    $Cell_phone=$row['Phone'];
                                }
                                if(!empty($postal_address) && !empty($Cell_phone)){
                           
                    ?>
                              <p class="text-left " style="color:whitesmoke"><i class="fa fa-address-book" aria-hidden="true"></i><b>Postal Address:</b> <?=  $postal_address   ?></p>
                              <p class="text-left"  style="color:whitesmoke"><i class="fa fa-phone" aria-hidden="true"></i><b>Cellphone number:</b> <?=  $Cell_phone   ?></p>

                      <?php  
                             }else{
                                  
                      ?>
                            <form action="" method="post">
                              <div class="form-group text-left">
                                <b><label class="text-left">Postal Address</label></b>
                                <textarea class="form-control" name="postal"  rows="3"placeholder="Postal Address" required value="<?php echo $postal_address=isset($_POST['postal'])? $_POST['postal']: "";   ?>"></textarea>
                              </div>
                              <div class="form-group text-left">
                                <b><label class="text-left">Cell Number</label></b>
                                <input type="text"class="form-control" name="cell_num"  placeholder="Cell Number" <?php echo $Cell_phone=isset($_POST['cell_num'])? $_POST['cell_num']: "";   ?> required>
                              </div>
                              <button type="submit" class="btn btn-primary" name="contact">Submit</button>
                            </form>

                       <?php 
                           
                           if(isset($_POST['contact'])){

                              $sql="UPDATE `user profile` SET `Postal Address`='$postal_address', `Phone`='$Cell_phone'  WHERE Username='$uname'";
                              $result=mysqli_query($conn,$sql);
                              if($result){
                                header("location:profile.php");
                              }

                           }
                      
                      } }?>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" role="tab" id="section2HeaderId">
                    <h5 class="mb-0">
                      <a data-toggle="collapse" data-parent="#accordianId" href="#section2ContentId" aria-expanded="true" aria-controls="section2ContentId">
                         <p><i class="fa fa-briefcase" aria-hidden="true"></i><?= "Experience" ?></p>
                      </a>
                    </h5>
                  </div>
                  <div id="section2ContentId" class="collapse in" role="tabpanel" aria-labelledby="section2HeaderId">
                    <div class="card-body  bg-secondary">
                              
                     
                      <?php 

                        $sql="SELECT * FROM `user profile` WHERE Username='$user_mail'";
                        $result=mysqli_query($conn,$sql);

                        if($result->num_rows>0)
                        {
                          while($row=mysqli_fetch_assoc($result))
                          {
                            $positon=$row['Post'];
                            $tasks=$row['Tasks'];
                            $skills=$row['Skills'];
                          }
                          if(!empty($positon) && !empty($tasks) && !empty($skills)){
                      ?>

                        <p class="text-left" style="color:whitesmoke"><i class="fa fa-asterisk" aria-hidden="true"></i></b>Position: <?=  $positon   ?></p>
                        <p  class="text-left" style="color:whitesmoke"><i class="fa fa-sign-in" aria-hidden="true"></i><b>Tasks:</b> <?=  $tasks   ?></p>
                        <p  class="text-left"style="color:whitesmoke"><i class="fa fa-briefcase" aria-hidden="true"></i><b>Skills:</b> <?=  $skills   ?></p>

                      <?php  }else{    ?>

                        <form action="" method="post">
                              <div class="form-group text-left">
                                <b><label class="text-left">Position</label></b>
                                <input type="text"class="form-control" name="post"  placeholder="Position" value="<?php echo $position=isset($_POST['post'])? $_POST['post'] :""; ?>" required>
                              </div>
                              <div class="form-group text-left">
                                <b><label class="text-left">Skills</label></b>
                                <textarea class="form-control" name="skill"  rows="3"placeholder="skills" min="1" max="360" value="<?php $skills=isset($_POST['skill'])? $_POST['skill'] :"";   ?>" required></textarea>
                              </div>
                              <div class="form-group text-left">
                                <b><label class="text-left">Task</label></b>
                                <input type="text"class="form-control" name="task"  placeholder="Task" value="<?php $tasks=isset($_POST['task'])? $_POST['task'] :"";   ?>" required>
                              </div>
                              <button type="submit" class="btn btn-primary" name="experience">Submit</button>
                            </form>

                        <?php 
                      
                      if(isset($_POST['experience'])){

                        $sql="UPDATE `user profile` SET `Post`='$position', `Skills`='$skills', `Tasks`='$tasks' WHERE Username='$user_mail'";
                        $result=mysqli_query($conn,$sql);
                        if($result){
                          header("location:profile.php");
                        }

                     }

                      
                      
                      }  } ?>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" role="tab" id="section3HeaderId">
                    <h5 class="mb-0">
                      <a data-toggle="collapse" data-parent="#accordianId" href="#section3ContentId" aria-expanded="true" aria-controls="section2ContentId">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i> <?= "School" ?>
                      </a>
                    </h5>
                  </div>
                  <div id="section3ContentId" class="collapse in" role="tabpanel" aria-labelledby="section3HeaderId">
                    <div class="card-body bg-secondary">
                     
                      <?php 

                                  $sql="SELECT * FROM `user profile` WHERE Username='$user_mail'";
                                  $result=mysqli_query($conn,$sql);

                                  if($result->num_rows>0)
                                  {
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                      $school=$row['School Name'];
                                      $year=$row['Completion year'];
                                      $specialty=$row['Specialization'];
                                    }
                                    if(!empty($school) && !empty($year) && !empty($specialty)){
                        ?>
                           <p class="text-left" style="color:whitesmoke"><i class="fa fa-book" aria-hidden="true"></i><b>School:</b> <?=  $school   ?></p>
                          <p  class="text-left" style="color:whitesmoke"><i class="fa fa-clock-o" aria-hidden="true"></i><b>Year of Completion:</b> <?=  $year   ?></p>
                          <p  class="text-left"style="color:whitesmoke"><i class="fa fa-space-shuttle" aria-hidden="true"></i><b>Specialty:</b> <?=  $specialty   ?></p>
                          <?php  }else{    ?>   

                            <form action="" method="post">
                              <div class="form-group text-left">
                                <b><label class="text-left">School</label></b>
                                <input type="text"class="form-control" name="school"  placeholder="school" value="<?php echo $school=isset($_POST['school'])? $_POST['school'] :""; ?>" required>
                              </div>
                              <div class="form-group text-left">
                                <b><label class="text-left">Skills</label></b>
                                <textarea class="form-control" name="year"  rows="3"placeholder="year" min="1" max="360" value="<?php $year=isset($_POST['year'])? $_POST['year'] :"";   ?>" required></textarea>
                              </div>
                              <div class="form-group text-left">
                                <b><label class="text-left">Specialty</label></b>
                                <input type="text"class="form-control" name="Specialty"  placeholder="Specialty" value="<?php $specialty=isset($_POST['Specialty'])? $_POST['Specialty'] :"";   ?>" required>
                              </div>
                              <button type="submit" class="btn btn-primary" name="edu">Submit</button>
                            </form>


                            <?php 
                      
                                  if(isset($_POST['edu'])){

                                    $sql="UPDATE `user profile` SET `School Name`='$school', `Completion year`='$year', `Specialization`='$specialty' WHERE Username='$user_mail'";
                                    $result=mysqli_query($conn,$sql);
                                    if($result){
                                      header("location:profile.php");
                                    }

                                }

                      
                      
                      }  } ?>









                        
                    </div>
                  </div>
                </div>
              </div>
            </div>

         </div>
         

     </div>
  </main>
  <footer>
    <!-- place footer here -->
        
    
   
      
        
  </footer>

  <!-- Bootstrap JavaScript Libraries -->

<script src="../js/jquery.min.js"></script>
<script src="../js/jquery-3.3.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>

<?php
   
        }else{
            
          //If the user is not logged in they are redirected to the login
            header("Location:login.php");
        }  
      
?>