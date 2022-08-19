<?php 
//session_start();
define('SITEURL', 'http://localhost/recommender_system/');
 $db_hostname="localhost";
 $db_username="root";
 $db_password="";
 $db_database = "recommender_system";
 $con = mysqli_connect($db_hostname,$db_username,$db_password,$db_database); 
 if (mysqli_connect_error()) { 
     echo mysqli_connect_error(); } 
 ?>