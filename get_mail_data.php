<?php
//Collect the get variable 'view' from the link and declare a variable to use it at any time

$user_mail_data= isset($_GET['view'])? $_GET['view']: "";

// From users look which email corresponds to the get variable and collect the data from it.
$sql="SELECT * FROM `users` WHERE Email = '$user_mail_data' ";

//Store the response or results under the variable after establishing the connection and sql query message
$res= mysqli_query($conn,$sql);

// Check if there is any information under the response that was returned
if($res->num_rows>0){

    // if there was any information under the email loop it through.

    while($row=mysqli_fetch_assoc($res)){
        
      // stored the data in variable from the table and we'll now use it
        $name3=$row['First Name'];
        $surname3=$row['Last Name'];
    }
}
?>

 