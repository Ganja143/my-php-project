<?php

require 'connection.php' ;


$myusername=isset($_POST['mail'])? $_POST['mail']: "";
$mypassword=isset($_POST['pass'])? $_POST['pass']: ""; 

$myusername=strtolower($myusername);

if(isset($_POST["login"]))
 {

            // To protect MySQL injection (more detail about MySQL injection)
            $myusername = stripslashes($myusername);
            $mypassword = stripslashes($mypassword);
            $myusername = mysqli_real_escape_string($conn,$myusername);
            $mypassword = mysqli_real_escape_string($conn,$mypassword);
           

            // //Authentication
            // $stmt=$conn->prepare("SELECT * FROM `users` WHERE Email= ?");
            // $stmt->bind_param("s", $myusername);
            // $stmt->execute();
            // $user=$stmt->get_result()->fetch_assoc();

            // //Verification
            // if($user && password_verify($mypassword, $user['Password']))
            // {
            //     session_start();
            //     $_SESSION["mail"] = $myusername;
            //     $_SESSION["pass"] = $mypassword;


            //     header("Location:viewPost.php");

           // }
           

            $sql="SELECT * FROM `users` WHERE Email='$myusername' AND `Password` ='$mypassword' ";
            $result=mysqli_query($conn,$sql);
 
          // Mysql_num_row is counting table row
              $count=mysqli_num_rows($result);
         // If result matched $myusername and $mypassword, table row must be 1 row
          if($count==1)
         {
             //start session
            session_start();
            // Register $myusername, $mypassword and redirect to file "sign in.php"
           //$_SESSION["userid"] = mysql_result($result, 0);
             $_SESSION["mail"] = $myusername;
             $_SESSION["pass"] = $mypassword;
           

         }else
                {
                    echo'<p style="position:relative;top:75%;margin-left:1%;color:black;"><b>Invalid Username or Password</b></p>';
                }
}



?>