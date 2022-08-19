<!--   --><?php //include('p-f/menustore.php');
?>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        jQuery( document ).ready(function (){
            jQuery('.latest-carousel a').click(function () {
                createCookie("movie_id_clicked", jQuery(this).attr('id'));
                createCookie("movie_name_clicked", jQuery(this).attr('name'));
            });
        });
</script>
</head>
<body>



<?php
require_once 'connection.php';
//    $query = "select * from user_rating WHERE userId=1";

$movieid = $_POST['movie_id'];
$userid = $_POST['user_id'];
$recommended = $_POST['recommended'];
$moviename = $_POST['moviename'];
//echo var_dump($moviename);
$ratingNum = $_COOKIE['ratingNum'];


    $query = "INSERT INTO `newratinguser`
	VALUES ($userid,$movieid,$ratingNum)";
    if(mysqli_query($con, $query)){
        echo json_encode(array("statusCode"=>200));

    }
    else{
        echo json_encode(array("statusCode"=>201));

    }
    if($recommended !='') {
        $query_watched = "INSERT INTO `watched_movies` (userId,watching_movies,counter) VALUES (1,'$moviename',1)";
        if (mysqli_query($con, $query_watched)) {
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
            $arr_watched = explode('|',$row_check_watched['watching_movies']);
            $arr_merge_unique_watched = array_unique(array_push($arr_watched,$moviename));
//        nermine
            $datamining_result_string_watch ='';
            for($index_data_watch = 0;$index_data_watch<count($arr_merge_unique_watched);$index_data_watch++){
                $datamining_result_string_watch.=$arr_merge_unique_watched[$index_data_watch].'|';
            }
            $datamining_result_string_watch = rtrim($datamining_result_string_watch,'|');
//            return var_dump($datamining_result_string_show);
//            $query_update = "UPDATE showed_movies SET showing_movies = ".$datamining_result_string_show.", counter = ".count($arr_merge_unique)." WHERE userId=".$current_user;
            $counter_update_watch = count($arr_merge_unique_watched);
            $query_update = "UPDATE `watched_movies` SET `watching_movies`='$datamining_result_string_watch',`counter`='$counter_update_watch' WHERE `userId`='$current_user';";
            if(mysqli_query($con, $query_update)){} else {echo "failure:".mysqli_error($con);}
            //            return var_dump($datamining_result_string_show);

        }
        else{
            $moviename_pipeline = $moviename.'|';
//            $datamining_result_unique_count = count($datamining_result_unique);
            $query_watched = "INSERT INTO watched_movies (userId,watching_movies,counter) VALUES('1','$moviename_pipeline',1)";
            if(mysqli_query($con, $query_watched)){} else {echo "failure:".mysqli_error($con);}
        }
//        watched_movies Insert + Update
    }


?>
<div class="clearfix"></div>

<!--       --><?php //include('p-f/footer.php') ?>




</body>
</html>

