<?php

$sql="SELECT * FROM `user profile` WHERE Username = '$user_mail' ";
$res= mysqli_query($conn,$sql);

if($res->num_rows>0){
    
    while($row=mysqli_fetch_assoc($res)){

        $postal=$row['Postal Address'];
        $phone=$row['Phone'];
        $post=$row['Post'];
        $task=$row['Tasks'];
        $school=$row['School Name'];
        $year=$row['Completion year'];
        $special=$row['Specialization'];
        $skills=$row['Skills'];
        $uname=$row['Username'];

    }
    
}

?>