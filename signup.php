<?php
require_once 'connection.php';

  if (isset($_POST['submit'])) {
      $name = $_POST['adname'];
      $email = $_POST['ademail'];
      $password = $_POST['adpassword'];
      $phone = $_POST['adphone'];
      $password = password_hash($password, PASSWORD_DEFAULT);

      $sql = "select * from users where (email='$email')";

      $res_sql = mysqli_query($con, $sql);

      if (mysqli_num_rows($res_sql) > 0) {

    $row_sql = mysqli_fetch_assoc($res_sql);
    if ($email == isset($row_sql['email'])) {
        $check_msg =  "email already exists";
    }
      } else {
          $query = "INSERT INTO users (role_id,name,email,password,phone_number) VALUES(2,'$name','$email','$password','$phone')";
          if (mysqli_query($con, $query)) {
              $q = 'SELECT * from users ORDER BY id DESC LIMIT 1';
              $res = mysqli_query($con, $q);
              $row = mysqli_fetch_assoc($res);

              setcookie("current_user", $row['id'], time() + 2 * 24 * 60 * 60);
              header('Location: http://localhost/recommender_system/display_movies.php');

          } else {
              echo "failure:" . mysqli_error($con);
          }
      }
  }


?>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/addproduct.css" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="http://localhost/recommender_system/css/main_1.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/recommender_system/css/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <style type="text/css">





   #img_div{
   	width: 80%;
   	padding: 5px;
   	margin: 15px auto;
   	border: 1px solid #cbcbcb;
   }
   #img_div:after{
   	content: "";
   	display: block;
   	clear: both;
   }
   img{
   	
   	margin: 15px;
   	width: 14 #img_div{
   	width: 80%;
   	padding: 5px;
   	margin: 15px auto;
   	border: 1px solid #cbcbcb;
   	height: 160px;
   }}
   
       
</style>
    <?php  include('p-f/header.php'); ?>
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins container-login100 signup-page" style="background-image: url('images/depositphotos_5551251-stock-photo-cinema.jpg') !important;">
        <div class="wrapper wrapper--w680">
            <div class="card card-4" style="border: 0 !important;">
                <div class="card-body">
                    <h2 class="title">create account</h2>
                    <form action="signup.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group">
                                    <label class="label">name:</label>
                                    <input class="input--style-4" type="text" name="adname">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <label class="label">phone number:</label>
                                    <input class="input--style-4" type="text" name="adphone">
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                              <div class="col-6">
                                <div class="input-group">
                                    <label class="label">email:</label>
                                    <input class="input--style-4" type="email" name="ademail">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <label class="label">password:</label>
                                    <div class="input-group-icon" style="width: 100%">
                                        <input class="input--style-4 " type="password" name="adpassword">
                                     
                                    </div>
                                </div>
                            </div>

                        </div>
                           <div class="input-group">
                         
                    
                        </div>
                      
                        <div class="p-t-15 flex-center" style="justify-content: center;">
                            <button class="login100-form-btn" name="submit" type="submit">Submit</button>
                        </div>
                    </form>
                    <span style="color: rgba(160, 5, 5,1);"><?php if(isset($check_msg)) echo '*'.$check_msg;?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->