<?php
function kn(){
   $host ="localhost";
   $user ="root";
   $pass ="";
   $db="doan2";
   $con = mysqli_connect($host,$user,$pass);
   mysqli_select_db($con,$db);
   return $con;
}
?>