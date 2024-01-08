<?php

$user_mail=$_SESSION['mail'];

$sql="SELECT * FROM `users` WHERE Email = '$user_mail' ";
$res= mysqli_query($conn,$sql);

if($res->num_rows>0){

    while($row=mysqli_fetch_assoc($res)){
        $name=$row['First Name'];
        $surname=$row['Last Name'];
        $profile_pic=$row['Profile'];
        $uname=$row['Email'];
    }
}
 
?>

