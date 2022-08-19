<!--   --><?php //include('p-f/menustore.php');
?>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>
<body>



<?php
require_once 'connection.php';
//    $query = "select * from user_rating WHERE userId=1";
$movieid = $_COOKIE['movie_id_clicked'];
$moviename = $_COOKIE['movie_name_clicked'];
$current_user = $_COOKIE['current_user'];
$ratingNum = $_COOKIE['ratingNum'];;
//if(isset($_COOKIE['ratingNum'])){
//    $ratingNum = $_COOKIE['ratingNum'];
//}
//else{
//    $ratingNum = $_COOKIE['avgRating'];
//}
$query_update = "UPDATE `newratinguser` SET `rating`='$ratingNum' WHERE `userId`='$current_user' AND `movieId`='$movieid';";
if(mysqli_query($con, $query_update)){} else {echo "failure:".mysqli_error($con);}
        //            return var_dump($datamining_result_string_show);


?>
<div class="clearfix"></div>

<!--       --><?php //include('p-f/footer.php') ?>




</body>
</html>

