<!--   --><?php //include('p-f/menustore.php');
?>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>
<body>



<?php
require_once 'connection.php';
$movieid = $_COOKIE['movie_id_clicked'];
$current_user = $_COOKIE['current_user'];

//    $query_select = "SELECT * FROM `saving_movies` WHERE `userId`='$current_user';";
//
//    $result_select = mysqli_query($con, $query_select);
//    $nofrows_select = mysqli_num_rows($result_select);
//    $row_select = mysqli_fetch_assoc($result_select);
//    if ($nofrows_select > 0) {
//        if (stristr($row_select['savedmovieId'], $movieid)) {
////            $remove_movie = str_replace($row_select['savedmovieId'],"",$movieid);
//            $remove_movie = trim($row_select['savedmovieId'], $movieid);
////            $savedmovies_str = $row_select['savedmovieId'] . ',' . $movieid;
//            $result = preg_replace(
//                '/(?:,\s*){2,}/',
//                '',
//                $remove_movie
//            );
//            $result = rtrim($result, ',');
//            $query_update = "UPDATE `saving_movies` SET `savedmovieId`='$result' WHERE `userId`='$current_user';";
//            if (mysqli_query($con, $query_update)) {
//            } else {
//                echo "failure:" . mysqli_error($con);
//            }
//        }
//        }
$query_remove = "DELETE FROM `saving_movies` WHERE `userId`='$current_user' AND `savedmovieId` ='$movieid'";
if (mysqli_query($con, $query_remove)) {
            } else {
                echo "failure:" . mysqli_error($con);
            }
?>
<div class="clearfix"></div>

<!--       --><?php //include('p-f/footer.php') ?>




</body>
</html>

