<?php
require_once 'connection.php';
if(isset($_POST['wemail']) && isset($_POST['wpassword'])) {
    $email = $_POST['wemail'];
    $pass = $_POST['wpassword'];

    $query = "SELECT * FROM `users` WHERE email='$email'and password='$pass'";
    $result = mysqli_query($con, $query);
    $nofrows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    if ($nofrows >0) {
        if($row['role_id']==2){
        setcookie("current_user", $row['id'], time() + 2 * 24 * 60 * 60);
        setcookie("user_status", 'loggedin', time() + 2 * 24 * 60 * 60);
        header('Location: http://localhost/recommender_system/display_movies.php');
        }
        else{
            header('Location: http://localhost/recommender_system/add_movies.php');
        }
    }
}
    else{
       
        echo "<script>";
//        echo "alert('Email and Password incorrect please try again!')";
        echo "</script>";
           
    }
    
    


?><!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V3</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main_1.css">
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
<!--===============================================================================================-->
    <?php  include('p-f/header.php'); ?>
</head>
<body onload = "getLocation();">
	  
	<div class="limiter">
<!--		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">-->
		<div class="container-login100" style="background-image: url('images/depositphotos_5551251-stock-photo-cinema.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form myForm" action="login.php"  method ="POST">
					<span class="login100-form-logo">
						<span class="iconify" data-icon="ic:sharp-movie-filter"></span>

					</span>
       <input type="hidden" name="latitude" value="" >
                      <input type="hidden" name="longitude" value="">
					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="email" name="wemail" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="wpassword" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

<!--					<div class="contact100-form-checkbox">-->
<!--						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">-->
<!--                                                 -->
<!--                                             -->
<!--						<label class="label-checkbox100" for="ckb1">-->
<!--							Remember me-->
<!--						</label>-->
<!--					</div>-->

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-50">
                                            <a class="txt1" href="signup.php">
							create a new account?
						</a>
					</div>
                      <br><!-- comment -->
					<div class="text-center p-t-50">
                                            <a class="txt1" href="login.php?ji=1">
							forget your password?
						</a>
					</div>
                                </form>
                         
                           
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
   
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
         
                  
                <script>
      function getLocation(){
        if(navigator.geolocation){
          navigator.geolocation.getCurrentPosition(showPosition,showError);
        }
      }
      function showPosition(position){
        document.querySelector('.myForm input[name="latitude"]').value = position.coords.latitude;
        document.querySelector('.myForm input[name="longitude"]').value = position.coords.longitude;
      }
      function showError(error){
        switch(error.code){
          case error.PERMISSION_DENIED:
         // alert("You Must Allow The Request For Geolocation To Fill Out The Form");
         // location.reload();
          break;
        }
      }
      function createCookie(name, value, days) {
          var expires;
          if (days) {
              var date = new Date();
              date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
              expires = "; expires=" + date.toGMTString();
          }
          else {
              expires = "";
          }
          document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
      }
      function getCookie(cname) {
          let name = cname + "=";
          let decodedCookie = decodeURIComponent(document.cookie);
          let ca = decodedCookie.split(';');
          for(let i = 0; i <ca.length; i++) {
              let c = ca[i];
              while (c.charAt(0) == ' ') {
                  c = c.substring(1);
              }
              if (c.indexOf(name) == 0) {
                  return c.substring(name.length, c.length);
              }
          }
          return "";
      }
    </script>  
</body>
</html>