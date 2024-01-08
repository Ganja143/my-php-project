<?php

$server="localhost";
$uname="root";
$password="";
$database="post-app";

$conn= new mysqli($server,$uname,$password,$database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
?>

