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
$recommended = $_POST['recommended'];
$movieid = $_COOKIE['movie_id_clicked'];
$moviename = $_COOKIE['movie_name_clicked'];
$current_user = $_COOKIE['current_user'];
if(isset($_COOKIE['ratingNum'])){
    $ratingNum = $_COOKIE['ratingNum'];
}
else{
    $ratingNum = $_COOKIE['avgRating'];
}
//recommended
if($recommended=='true'){
    $query = "INSERT INTO `newratinguser` (userId,movieId,rating,currentdate)
	VALUES ($current_user,$movieid,$ratingNum,now())";
    if (mysqli_query($con, $query)) {
        echo json_encode(array("statusCode" => 200));

    } else {
        echo json_encode(array("statusCode" => 201));

    }
    //                watched_movies Insert + Update
    $query_check_watched= "SELECT * FROM `watched_movies` WHERE userId=".$current_user;
    $result_check_watched = mysqli_query($con, $query_check_watched);
    $nofrows_check_watched = mysqli_num_rows($result_check_watched);
    $row_check_watched = mysqli_fetch_assoc($result_check_watched);
    if ($nofrows_check_watched >0) {
//        if(stristr($row_check_watched['watching_movies'], '|')){
//
//        }
        $arr_watched = explode('|',$row_check_watched['watching_movies']);
//        $arr_merge_unique_watched = array_unique(array_push($arr_watched,$moviename));
        array_push($arr_watched,$moviename);
//        return var_dump($arr_watched);
//        nermine
        $datamining_result_string_watch ='';
//        for($index_data_watch = 0;$index_data_watch<count($arr_merge_unique_watched);$index_data_watch++){
        for($index_data_watch = 0;$index_data_watch<count(array_unique($arr_watched));$index_data_watch++){
//            $datamining_result_string_watch.=$arr_merge_unique_watched[$index_data_watch].'|';
//            if(stristr($actual_link, '/ar/'))
            $datamining_result_string_watch.=$arr_watched[$index_data_watch].'|';
        }
        $datamining_result_string_watch = rtrim($datamining_result_string_watch,'|');
//            return var_dump($datamining_result_string_show);
//            $query_update = "UPDATE showed_movies SET showing_movies = ".$datamining_result_string_show.", counter = ".count($arr_merge_unique)." WHERE userId=".$current_user;
        $counter_update_watch = count(array_unique($arr_watched));
//        nermine
        $query_check_showed_acc = "SELECT * FROM `showed_movies` WHERE userId=" . $current_user;
        $result_check_showed_acc = mysqli_query($con, $query_check_showed_acc);
        $nofrows_check_showed_acc= mysqli_num_rows($result_check_showed_acc);
        $row_check_showed_acc = mysqli_fetch_assoc($result_check_showed_acc);
        if ($nofrows_check_showed_acc > 0) {
            $counter_showed = $row_check_showed_acc['counter'];
            $accuracy = $counter_update_watch/$counter_showed;
       $query_update = "UPDATE `watched_movies` SET `watching_movies`='$datamining_result_string_watch',`counter`='$counter_update_watch',`accuracy`='$accuracy' WHERE `userId`='$current_user';";
        if(mysqli_query($con, $query_update)){} else {echo "failure:".mysqli_error($con);}
        //            return var_dump($datamining_result_string_show);


            $query_acc = "UPDATE `accuracy` SET `userId` = '$current_user', `accuracy` = '$accuracy' WHERE `userId`='$current_user'";
            if (mysqli_query($con, $query_acc)) {
                echo json_encode(array("statusCode" => 200));

            } else {
                echo json_encode(array("statusCode" => 201));

            }
        }
//        nermine
    }
    else{
        $query_check_showed_acc = "SELECT * FROM `showed_movies` WHERE userId=" . $current_user;
        $result_check_showed_acc = mysqli_query($con, $query_check_showed_acc);
        $nofrows_check_showed_acc= mysqli_num_rows($result_check_showed_acc);
        $row_check_showed_acc = mysqli_fetch_assoc($result_check_showed_acc);
        if ($nofrows_check_showed_acc > 0) {
            $counter_showed = $row_check_showed_acc['counter'];
            $accuracy = 1/$counter_showed;
        }
//        $moviename_pipeline = $moviename.'|';
        $moviename_pipeline = $moviename;
//            $datamining_result_unique_count = count($datamining_result_unique);
        $query_watched = "INSERT INTO `watched_movies` (userId,watching_movies,counter,accuracy) VALUES('$current_user','$moviename_pipeline',1,'$accuracy')";
        if(mysqli_query($con, $query_watched)){} else {echo "failure:".mysqli_error($con);}
        $query_acc = "INSERT INTO `accuracy` (userId,accuracy)
	VALUES ($current_user,$accuracy)";
        if (mysqli_query($con, $query_acc)) {
            echo json_encode(array("statusCode" => 200));

        } else {
            echo json_encode(array("statusCode" => 201));

        }
    }
//        watched_movies Insert + Update
}else {


    $query = "INSERT INTO `newratinguser` (userId,movieId,rating,currentdate)
	VALUES ($current_user,$movieid,$ratingNum,now())";
    if (mysqli_query($con, $query)) {
        echo json_encode(array("statusCode" => 200));

    } else {
        echo json_encode(array("statusCode" => 201));

    }
//    $query_acc = "INSERT INTO `accuracy` (userId,accuracy)
//	VALUES ($current_user,0)";
//    if (mysqli_query($con, $query_acc)) {
//        echo json_encode(array("statusCode" => 200));
//
//    } else {
//        echo json_encode(array("statusCode" => 201));
//
//    }

}
//recommended


?>
<div class="clearfix"></div>

<!--       --><?php //include('p-f/footer.php') ?>




</body>
</html>

