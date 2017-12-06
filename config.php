<?php
ob_start(); // 

session_start();
$con = mysqli_connect("localhost", "root", "", "beats_social"); // Connection variable

if(mysqli_connect_errno())
{
  echo "failed to connect: " . mysqli_connect_errno();
}

?>