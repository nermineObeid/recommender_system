<?php require_once 'connection.php';


// get cURL resource
//$ch = curl_init();
//
//// set url
//curl_setopt($ch, CURLOPT_URL, 'https://app.scrapingbee.com/api/v1/?api_key=P3LZUW3D8NW1ZWQ129BVHVS5BXVL3HI92JHXW1WMCR8CND6Q6TA8X1XIVXA6G9YVNFD7LH4LKANFGAVF&url=https://www.netflix.com/browse');
//
//// set method
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
//
//// return the transfer as a string
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//
//
//// send the request and save response to $response
//$response = curl_exec($ch);
//
//// stop if fails
//if (!$response) {
//    die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
//}
//
//echo 'HTTP Status Code: ' . curl_getinfo($ch, CURLINFO_HTTP_CODE) . PHP_EOL;
//echo 'Response Body: ' . $response . PHP_EOL;
//
//// close curl resource to free up system resources
//curl_close($ch);
?>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="http://localhost/recommender_system/js/main.js"></script>
    <script type="text/javascript">
            jQuery( document ).ready(
                function () {
                    var current_url = window.location.href;
                    var current_user_increment = 0;

                    if(current_url.indexOf("/display_movies") > -1){
                        // alert(current_url);
                        current_user_increment+=1;
                       // createCookie('current_user',current_user_increment,0.5)

                    }

            jQuery('.movie_title').click(function () {
                createCookie("movie_id_clicked", jQuery(this).parent().attr('id'), "10");
                createCookie("movie_name_clicked", jQuery(this).parent().attr('name'), "10");
            });
                    jQuery('.movieitem_carousel').click(function () {
                        createCookie("movie_id_clicked", jQuery(this).attr('id'), "10");
                        createCookie("movie_name_clicked", jQuery(this).attr('name'), "10");
                    });


        });
            // Get the video
            var video = document.getElementById("myVideo");

            // Get the button
            var btn = document.getElementById("myBtn");

            // Pause and play the video, and change the button text
            function myFunction() {
                if (video.paused) {
                    video.play();
                    btn.innerHTML = "Pause";
                } else {
                    video.pause();
                    btn.innerHTML = "Play";
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
    <?php
    include('p-f/header.php');?>
</head>
<body>

<?php
//  $dest = "nermine.obeid.1999@gmail.com";
//  $subjetc = "Test Email";
//  $body = "Hi this is a test email send by a php script";
//  $headers = "From: YourGmailId@gmail.com";
//  if (mail($dest, $subjetc, $body, $headers)) {
//    echo "Email successfully sent to $dest ...";
//  } else {
//    echo "Failed to send email...";
//  }

?>
<div class="video-section">
<video autoplay muted loop id="myVideo">
    <source src="http://localhost/recommender_system/images/home_hero_background.mp4" type="video/mp4">
</video>

<!-- Optional: some overlay text to describe the video -->
<div class="content">
    <?php
    if(isset($_COOKIE['current_user'])) {
        $current_user = $_COOKIE['current_user'];

        $query_acc = "SELECT * FROM `accuracy` WHERE userId = '$current_user'";
        $result_acc = mysqli_query($con, $query_acc);
        while ($row_acc = mysqli_fetch_assoc($result_acc)) {
            $accuracy_percentage_double = (double)$row_acc['accuracy'] * 100;
            $accuracy_percentage_int = (int)$accuracy_percentage_double; ?>
            <h2><?= round($accuracy_percentage_int); ?>% Match</h2>
        <?php }
    }
    ?>
    <!-- Use a button to pause/play the video with JavaScript -->
    <button id="myBtn" onclick="window.location.href='http://localhost/recommender_system/display_movies.php'">Watch More!</button>
</div>
</div>

<!--most viewed-->
<h2 class="recommended_title">Most Viewed</h2>
<div class="owl-carousel owl-theme latest-carousel">
<?php
$q_most = "SELECT *, COUNT(movies.movieId) FROM movies JOIN newratinguser ON movies.movieId=newratinguser.movieId  GROUP BY movies.movieId HAVING COUNT(newratinguser.id) > 3";
$result_most = mysqli_query($con, $q_most);
while ($row_most = mysqli_fetch_assoc($result_most)) { ?>
    <div class="item">
        <!--                    <img src="--><?//= SITEURL; ?><!--images/film-svgrepo-com.svg"> -->
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
<path style="fill:#876E6E;" d="M502.857,105.143c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143  c5.049,0,9.143-4.094,9.143-9.143s-4.094-9.143-9.143-9.143H9.143C4.094,50.286,0,54.379,0,59.429s4.094,9.143,9.143,9.143  s9.143,4.094,9.143,9.143V96c0,5.049-4.094,9.143-9.143,9.143S0,109.237,0,114.286v283.429c0,5.049,4.094,9.143,9.143,9.143  s9.143,4.094,9.143,9.143v18.286c0,5.049-4.094,9.143-9.143,9.143S0,447.522,0,452.571c0,5.049,4.094,9.143,9.143,9.143h493.714  c5.049,0,9.143-4.094,9.143-9.143c0-5.049-4.094-9.143-9.143-9.143c-5.049,0-9.143-4.094-9.143-9.143V416  c0-5.049,4.094-9.143,9.143-9.143c5.049,0,9.143-4.094,9.143-9.143V114.286C512,109.237,507.906,105.143,502.857,105.143z   M64,434.286c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143  c5.049,0,9.143,4.094,9.143,9.143V434.286z M64,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V77.714  c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M109.714,434.286c0,5.049-4.094,9.143-9.143,9.143  h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V434.286z   M109.714,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143  h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M155.429,434.286c0,5.049-4.094,9.143-9.143,9.143h-9.143  c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V434.286z   M155.429,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143  h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M201.143,434.286c0,5.049-4.094,9.143-9.143,9.143h-9.143  c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143H192c5.049,0,9.143,4.094,9.143,9.143V434.286z M201.143,96  c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143H192  c5.049,0,9.143,4.094,9.143,9.143V96z M246.857,434.286c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143  V416c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V434.286z M246.857,96c0,5.049-4.094,9.143-9.143,9.143  h-9.143c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z   M292.571,434.286c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143  h9.143c5.049,0,9.143,4.094,9.143,9.143V434.286z M292.571,96c0,5.049-4.094,9.143-9.143,9.143h-9.143  c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z   M338.286,434.286c0,5.049-4.094,9.143-9.143,9.143H320c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143  h9.143c5.049,0,9.143,4.094,9.143,9.143V434.286z M338.286,96c0,5.049-4.094,9.143-9.143,9.143H320  c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M384,434.286  c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143  c5.049,0,9.143,4.094,9.143,9.143V434.286z M384,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143  V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M429.714,434.286  c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143  c5.049,0,9.143,4.094,9.143,9.143V434.286z M429.714,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143  V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M475.429,434.286  c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143  c5.049,0,9.143,4.094,9.143,9.143V434.286z M475.429,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143  V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z"/>
            <g>
                <path style="fill:#C9BEBE;" d="M420.571,388.571H91.429c-5.049,0-9.143-4.094-9.143-9.143V132.571c0-5.049,4.094-9.143,9.143-9.143   h329.143c5.049,0,9.143,4.094,9.143,9.143v246.857C429.714,384.478,425.621,388.571,420.571,388.571z"/>
                <path style="fill:#C9BEBE;" d="M512,388.571h-54.857c-5.049,0-9.143-4.094-9.143-9.143V132.571c0-5.049,4.094-9.143,9.143-9.143   H512V388.571z"/>
                <path style="fill:#C9BEBE;" d="M0,123.429h54.857c5.049,0,9.143,4.094,9.143,9.143v246.857c0,5.049-4.094,9.143-9.143,9.143H0   V123.429z"/>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
</svg>
        <a class="movieitem_carousel" id="<?=$row_most['movieId'];?>" name="<?=$row_most['title'];?>" href="http://localhost/recommender_system/movies/?movie_id=<?=$row_most['movieId']?>"><?= $row_most['title']; ?></a>
    </div>
<?php
}
?>


</div>
<!--most viewed-->
<?php

//$query_latest = "SELECT *
//FROM movies
//JOIN ratings ON movies.movieId=ratings.movieId
//WHERE rating >= 3 ORDER BY timestamp DESC LIMIT 20";
//        $result_latest = mysqli_query($con, $query_latest);
////        echo var_dump($row_latest = mysqli_fetch_assoc($result_latest));
//        ?>
<!--<div class="owl-carousel owl-theme latest-carousel">-->
<!--       --><?php //while($row_latest = mysqli_fetch_assoc($result_latest)){ ?>
<!--           <div class="item">-->
<!--               <img src="--><?//=SITEURL; ?><!--/images/maxresdefault.jpg">  <a href="http://localhost/recommender_system/movies/?movie_id=--><?//=$row_latest['movieId']?><!--">--><?//=$row_latest['title'];?><!--</a></div>-->
<!-- --><?php //      } ?>
<!--</div>-->
<?php
////    $query = "select * from user_rating WHERE userId=1";
////$query = "SELECT * FROM movies";
////
////$interested_genres = array();
////
////$result = mysqli_query($con, $query);
////
////$count = mysqli_num_rows($result);
////$c=0;
////if($count>0){
////
////    while($row = mysqli_fetch_assoc($result)){ ?>
<!--        <div class="row">-->
<!--            <a href="http://localhost/recommender_system/movies/?movie_id=--><?//=$row['movieId']?><!--">-->
<!--            <div class="col-sm-4" id="--><?//=$row['movieId']?><!--" name="--><?//=$row['title']?><!--">-->
<!--                <h1 class="movie_title" style="cursor:pointer;">--><?//= $row['title']?><!--</h1>-->
<!--            </div>-->
<!--            </a>-->
<!--        </div>-->
<!---->
<!--        --><?php
////    }
////
////}
////<!--ratings-->

if(isset($_COOKIE['current_user'])) {
$current_user = $_COOKIE['current_user'];

$query_acc = "SELECT * FROM `accuracy` WHERE userId = '$current_user'";
$result_acc = mysqli_query($con, $query_acc);
while($row_acc = mysqli_fetch_assoc($result_acc)) {
    $accuracy_percentage_double = (double)$row_acc['accuracy'] *100;
    $accuracy_percentage_int = (int)$accuracy_percentage_double; ?>
<h2><?=round($accuracy_percentage_int);?>% Match</h2>
<?php }

    $query = "SELECT *
FROM movies
JOIN newratinguser ON movies.movieId=newratinguser.movieId
WHERE userId=" . $current_user . " AND rating >= 3.5";


    $genres = array(
        "Action" => 0,
        "Adventure" => 0,
        "Animation" => 0,
        "Children" => 0,
        "Comedy" => 0,
        "Crime" => 0,
        "Documentary" => 0,
        "Drama" => 0,
        "Fantasy" => 0,
        "Film-Noir" => 0,
        "Horror" => 0,
        "IMAX" => 0,
        "Musical" => 0,
        "Mystery" => 0,
        "Romance" => 0,
        "Sci-Fi" => 0,
        "Thriller" => 0,
        "War" => 0,
        "Western" => 0
    );
    $genres_latest = array(
        "Action" => 0,
        "Adventure" => 0,
        "Animation" => 0,
        "Children" => 0,
        "Comedy" => 0,
        "Crime" => 0,
        "Documentary" => 0,
        "Drama" => 0,
        "Fantasy" => 0,
        "Film-Noir" => 0,
        "Horror" => 0,
        "IMAX" => 0,
        "Musical" => 0,
        "Mystery" => 0,
        "Romance" => 0,
        "Sci-Fi" => 0,
        "Thriller" => 0,
        "War" => 0,
        "Western" => 0
    );
    $interested_genres = array();
    $watched_movies = array();
    $most_interested = array();
    $latest_movies = array();

    $result = mysqli_query($con, $query);

    $count = mysqli_num_rows($result);
    $c = 0;

if ($count > 9) {
//        if ($count > 0) {
////            return var_dump($count);
            while ($row = mysqli_fetch_assoc($result)) {
                $watched_movies[$row['movieId']] = $row['title'];
                if (stristr($row['genres'], '|')) {
                    $genres_array = explode("|", $row['genres']);
                    for ($index = 0; $index < count($genres_array); $index++) {
////                                 $genres[$genres_array[$index]] += 1;
                        $genres[$genres_array[$index]] += 1 / $count * 100;
                        array_push($interested_genres, $genres_array[$index]);

                    }
                } else {
////                              echo var_dump('not contained |'.$row['genres']);
                    $genres[$row['genres']] += 1 / $count * 100;
////                              $genres[$row['genres']] += 1;
                    array_push($interested_genres, $row['genres']);
                }


                ?>
                <?php
            }
//
////               echo var_dump($watched_movies);
////               echo var_dump($genres);
            foreach ($genres as $genre) {

                if ($genre > 18) {
                    $key = array_search($genre, $genres);
                    $most_interested[$key] = $genre;
//
////                          echo var_dump($key);
////                          echo var_dump($genre);
////                          array_push($most_interested,$genre);
                }

            }
//    return var_dump($most_interested);

//            echo 'Watched Movies by this user';
//            echo var_dump($watched_movies);
//            echo 'Interested Genres';
//            echo var_dump(array_unique($interested_genres));
//            echo var_dump($genres);
//            echo 'Most Interested Genres >25%';
//            echo var_dump($most_interested);
//            echo var_dump(array_keys($most_interested));

//        }
        $query_latest = "SELECT *
FROM movies
JOIN newratinguser ON movies.movieId=newratinguser.movieId
WHERE userId=" . $current_user . " AND rating >= 3.5 ORDER BY newratinguser.id DESC LIMIT 5";
        $result_latest = mysqli_query($con, $query_latest);
        $interested_genres_latest = array();
        $most_interested_latest = array();
//    return var_dump($result_latest);

        while ($row_latest = mysqli_fetch_assoc($result_latest)) {
            array_push($latest_movies, $row_latest['title']);
//////            nermine
//            echo var_dump($row_latest);
//
            if (stristr($row_latest['genres'], '|')) {
                $genres_array_latest = explode("|", $row_latest['genres']);

                for ($index_latest = 0; $index_latest < count($genres_array_latest); $index_latest++) {
////                                 $genres[$genres_array[$index]] += 1;
////                    $genres[$genres_array_latest[$index_latest]] += 1/$count * 100;
                    $genres_latest[$genres_array_latest[$index_latest]] += 1;
                    array_push($interested_genres_latest, $genres_array_latest[$index_latest]);

                }
            } else {
////                              echo var_dump('not contained |'.$row['genres']);
////                $genres[$row['genres']] += 1/$count * 100;
                $genres_latest[$row_latest['genres']] += 1;
////                              $genres[$row['genres']] += 1;
                array_push($interested_genres_latest, $row_latest['genres']);
            }
        }
////
//////            nermine
//        echo var_dump('5 movies');
//
//        echo var_dump($genres);

////
////
//
//        echo var_dump('latest_movies');
//        echo var_dump($latest_movies);

        $total = array_unique($interested_genres_latest);
        foreach ($genres_latest as $key => $val) {
//            echo var_dump($val);
            if ($val != 0) {
                $genres_latest[$key] = ($val / count($total)) * 100;
////                echo var_dump($genres_latest);
////                echo var_dump($genres_latest);
            }
        }

        foreach ($genres_latest as $genre_latest) {
//////
            if ($genre_latest > 25) {
                $key_latest = array_search($genre_latest, $genres_latest);
                $most_interested_latest[$key_latest] = $genre_latest;
            }
        }

////
        $all_interested_genres = array();
        $all_interested_genres = array_unique(array_merge(array_keys($most_interested), array_keys($most_interested_latest)), SORT_REGULAR);
//        echo var_dump('all_interested_genres');
//        echo var_dump($all_interested_genres);
//        echo var_dump('latest_movies');
//        echo var_dump($latest_movies);
        $datamining_result = array();

        $query_datamining_first = "SELECT filmget FROM `dataminning` WHERE film LIKE '%" . $latest_movies[0] . "%' AND type LIKE '%" . $all_interested_genres[0] . "%' AND support >=2";
        $result_datamining = mysqli_query($con, $query_datamining_first);
        while ($row_datamining = mysqli_fetch_assoc($result_datamining)) {
            array_push($datamining_result, $row_datamining['filmget']);

////            }

        }

//        return var_dump($latest_movies);
        for ($i = 1; $i < count($latest_movies); $i++) {

////            if($i==0) {

            foreach ($all_interested_genres as $all_interested_genre) {
////            else{

                $query_datamining_second = $query_datamining_first . " OR film LIKE '%" . $latest_movies[$i] . "%' AND type LIKE '%" . $all_interested_genre . "%' AND support >=2";
                $result_datamining_second = mysqli_query($con, $query_datamining_second);
                while ($row_datamining_second = mysqli_fetch_assoc($result_datamining_second)) {
////                    echo var_dump($row_datamining);
                    array_push($datamining_result, $row_datamining_second['filmget']);

                }
////        }
            }
        }

        $datamining_result_unique = array_values(array_unique($datamining_result));

        ?>
    <h2 class="recommended_title">Recommended Movies</h2>
        <div class="owl-carousel owl-theme latest-carousel">

            <?php
            $datamining_result_string = '';

            for ($index_data = 0; $index_data < count($datamining_result_unique); $index_data++) {
//                $query_getid = "SELECT * FROM movies
//JOIN ratings ON movies.movieId = ratings.movieId  WHERE movies.title LIKE '%$datamining_result_unique[$index_data]%'";
                $query_getid = "SELECT * FROM movies WHERE title LIKE '%$datamining_result_unique[$index_data]%'";

//                $query_getid = "SELECT * FROM movies WHERE title LIKE '%$datamining_result_unique[$index_data]%'";
                $result_getid = mysqli_query($con, $query_getid);
            $row_getid = mysqli_fetch_assoc($result_getid);
//                return var_dump($row_getid);

                ?>
                <div class="item">
<!--                    <img src="--><?//= SITEURL; ?><!--images/film-svgrepo-com.svg"> -->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
<path style="fill:#876E6E;" d="M502.857,105.143c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143  c5.049,0,9.143-4.094,9.143-9.143s-4.094-9.143-9.143-9.143H9.143C4.094,50.286,0,54.379,0,59.429s4.094,9.143,9.143,9.143  s9.143,4.094,9.143,9.143V96c0,5.049-4.094,9.143-9.143,9.143S0,109.237,0,114.286v283.429c0,5.049,4.094,9.143,9.143,9.143  s9.143,4.094,9.143,9.143v18.286c0,5.049-4.094,9.143-9.143,9.143S0,447.522,0,452.571c0,5.049,4.094,9.143,9.143,9.143h493.714  c5.049,0,9.143-4.094,9.143-9.143c0-5.049-4.094-9.143-9.143-9.143c-5.049,0-9.143-4.094-9.143-9.143V416  c0-5.049,4.094-9.143,9.143-9.143c5.049,0,9.143-4.094,9.143-9.143V114.286C512,109.237,507.906,105.143,502.857,105.143z   M64,434.286c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143  c5.049,0,9.143,4.094,9.143,9.143V434.286z M64,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V77.714  c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M109.714,434.286c0,5.049-4.094,9.143-9.143,9.143  h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V434.286z   M109.714,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143  h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M155.429,434.286c0,5.049-4.094,9.143-9.143,9.143h-9.143  c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V434.286z   M155.429,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143  h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M201.143,434.286c0,5.049-4.094,9.143-9.143,9.143h-9.143  c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143H192c5.049,0,9.143,4.094,9.143,9.143V434.286z M201.143,96  c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143H192  c5.049,0,9.143,4.094,9.143,9.143V96z M246.857,434.286c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143  V416c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V434.286z M246.857,96c0,5.049-4.094,9.143-9.143,9.143  h-9.143c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z   M292.571,434.286c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143  h9.143c5.049,0,9.143,4.094,9.143,9.143V434.286z M292.571,96c0,5.049-4.094,9.143-9.143,9.143h-9.143  c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z   M338.286,434.286c0,5.049-4.094,9.143-9.143,9.143H320c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143  h9.143c5.049,0,9.143,4.094,9.143,9.143V434.286z M338.286,96c0,5.049-4.094,9.143-9.143,9.143H320  c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M384,434.286  c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143  c5.049,0,9.143,4.094,9.143,9.143V434.286z M384,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143  V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M429.714,434.286  c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143  c5.049,0,9.143,4.094,9.143,9.143V434.286z M429.714,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143  V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M475.429,434.286  c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143  c5.049,0,9.143,4.094,9.143,9.143V434.286z M475.429,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143  V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z"/>
                        <g>
                            <path style="fill:#C9BEBE;" d="M420.571,388.571H91.429c-5.049,0-9.143-4.094-9.143-9.143V132.571c0-5.049,4.094-9.143,9.143-9.143   h329.143c5.049,0,9.143,4.094,9.143,9.143v246.857C429.714,384.478,425.621,388.571,420.571,388.571z"/>
                            <path style="fill:#C9BEBE;" d="M512,388.571h-54.857c-5.049,0-9.143-4.094-9.143-9.143V132.571c0-5.049,4.094-9.143,9.143-9.143   H512V388.571z"/>
                            <path style="fill:#C9BEBE;" d="M0,123.429h54.857c5.049,0,9.143,4.094,9.143,9.143v246.857c0,5.049-4.094,9.143-9.143,9.143H0   V123.429z"/>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
</svg>
                    <a class="movieitem_carousel" id="<?=$row_getid['movieId'];?>" name="<?=$row_getid['title'];?>"
                            href="http://localhost/recommender_system/movies/?movie_id=<?=$row_getid['movieId']?>&recommended=true"><?= $datamining_result_unique[$index_data]; ?></a>
                </div>
                <?php
                $datamining_result_string .= $datamining_result_unique[$index_data] . '|';

            }
//            return var_dump($datamining_result_string);
            ?>
        </div>

        <?php
        $datamining_result_string = rtrim($datamining_result_string, '|');

////        showed_movies Insert + Update
        $query_check_showed = "SELECT * FROM `showed_movies` WHERE userId=" . $current_user;
        $result_check_showed = mysqli_query($con, $query_check_showed);
        $nofrows_check_showed = mysqli_num_rows($result_check_showed);
        $row_check_showed = mysqli_fetch_assoc($result_check_showed);
        if ($nofrows_check_showed > 0) {
            $arr = explode('|', $row_check_showed['showing_movies']);
            $arr_merge_unique = array_unique(array_merge($arr, $datamining_result_unique));
////        nermine

            $datamining_result_string_show = '';
            $arr_merge_unique = array_values($arr_merge_unique);
//            return var_dump($arr_merge_unique);
            for ($index_data_show = 0; $index_data_show < count($arr_merge_unique); $index_data_show++) {
                $datamining_result_string_show .= $arr_merge_unique[$index_data_show] . '|';
            }
//            return var_dump($arr_merge_unique);
            $datamining_result_string_show = rtrim($datamining_result_string_show, '|');
////            return var_dump($datamining_result_string_show);
////            $query_update = "UPDATE showed_movies SET showing_movies = ".$datamining_result_string_show.", counter = ".count($arr_merge_unique)." WHERE userId=".$current_user;
            $counter_update = count($arr_merge_unique);
            $query_update = "UPDATE `showed_movies` SET `showing_movies`='$datamining_result_string_show',`counter`='$counter_update' WHERE `userId`='$current_user';";
            if (mysqli_query($con, $query_update)) {
            } else {
                echo "failure:" . mysqli_error($con);
            }
            //            return var_dump($datamining_result_string_show);

        } else {

            $datamining_result_unique_count = count($datamining_result_unique);
            $query_datamining_result = "INSERT INTO showed_movies (userId,showing_movies,counter) VALUES('$current_user','$datamining_result_string','$datamining_result_unique_count')";
            if (mysqli_query($con, $query_datamining_result)) {
            } else {
                echo "failure:" . mysqli_error($con);
            }
//            return var_dump($query_datamining_result);
        }
////        showed_movies Insert + Update
//
//
//        ?>
        <!--        <div class="owl-carousel owl-theme latest-carousel">-->
        <!--            --><?php
//            foreach ($arr_merge_unique as $arr_merge_unique_item) {
//                $query_movieId = "SELECT movieId
//FROM movies
//WHERE title LIKE '%$arr_merge_unique_item%'";
//                $result_movieId = mysqli_query($con, $query_movieId);
//                while ($row_movieId = mysqli_fetch_assoc($result_movieId)) {
////                return var_dump($row_movieId);
//                    ?>
        <!--                    <div class="item">-->
        <!--                        <img src="--><?//= SITEURL; ?><!--/images/maxresdefault.jpg"> <a class="movie_id_name"-->
        <!--                                                                                id="--><?//= $row_movieId['movieId'] ?><!--"-->
        <!--                                                                                name="--><?//= $arr_merge_unique_item ?><!--"-->
        <!--                                                                                href="http://localhost/recommender_system/movies/?movie_id=--><?//= $row_movieId['movieId'] ?><!--&recommended=true">--><?//= $arr_merge_unique_item; ?><!--</a>-->
        <!--                    </div>-->
        <!--                --><?php // }
//            } ?>
        <!--        </div>-->
        <!--              nermine-->
        <!---->
        <!--        datamining-->
        <!---->
        <!--        <div class="clearfix"></div>-->
        <!---->
        <!--ratings-->
        <!--    --><?php


    }

    else {

//return var_dump('<9');

//$query_random = "SELECT * FROM movies
//JOIN ratings ON movies.movieId = ratings.movieId ORDER BY RAND()
//LIMIT 10";
//generate random numbers
function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}
$random_numbers=UniqueRandomNumbersWithinRange(1,3100,10);
$rnd='';
foreach ($random_numbers as $r){
    $rnd .=$r.',';
}
$numbers=rtrim($rnd, ",");
//generate random numbers

$query_random = "SELECT DISTINCT movies.movieId, movies.title FROM movies, ratings where movies.movieId = ratings.movieId and movies.id IN ($numbers)";
$result_random = mysqli_query($con, $query_random);
?>
<h2 class="recommended_title">Recommended Movies</h2>
<div class="owl-carousel owl-theme latest-carousel">
    <?php
    while ($row_random = mysqli_fetch_assoc($result_random)) {
//        return var_dump($count);
        ?>
        <div class="item" >
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
<path style="fill:#876E6E;" d="M502.857,105.143c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143  c5.049,0,9.143-4.094,9.143-9.143s-4.094-9.143-9.143-9.143H9.143C4.094,50.286,0,54.379,0,59.429s4.094,9.143,9.143,9.143  s9.143,4.094,9.143,9.143V96c0,5.049-4.094,9.143-9.143,9.143S0,109.237,0,114.286v283.429c0,5.049,4.094,9.143,9.143,9.143  s9.143,4.094,9.143,9.143v18.286c0,5.049-4.094,9.143-9.143,9.143S0,447.522,0,452.571c0,5.049,4.094,9.143,9.143,9.143h493.714  c5.049,0,9.143-4.094,9.143-9.143c0-5.049-4.094-9.143-9.143-9.143c-5.049,0-9.143-4.094-9.143-9.143V416  c0-5.049,4.094-9.143,9.143-9.143c5.049,0,9.143-4.094,9.143-9.143V114.286C512,109.237,507.906,105.143,502.857,105.143z   M64,434.286c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143  c5.049,0,9.143,4.094,9.143,9.143V434.286z M64,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V77.714  c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M109.714,434.286c0,5.049-4.094,9.143-9.143,9.143  h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V434.286z   M109.714,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143  h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M155.429,434.286c0,5.049-4.094,9.143-9.143,9.143h-9.143  c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V434.286z   M155.429,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143  h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M201.143,434.286c0,5.049-4.094,9.143-9.143,9.143h-9.143  c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143H192c5.049,0,9.143,4.094,9.143,9.143V434.286z M201.143,96  c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143H192  c5.049,0,9.143,4.094,9.143,9.143V96z M246.857,434.286c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143  V416c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V434.286z M246.857,96c0,5.049-4.094,9.143-9.143,9.143  h-9.143c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z   M292.571,434.286c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143  h9.143c5.049,0,9.143,4.094,9.143,9.143V434.286z M292.571,96c0,5.049-4.094,9.143-9.143,9.143h-9.143  c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z   M338.286,434.286c0,5.049-4.094,9.143-9.143,9.143H320c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143  h9.143c5.049,0,9.143,4.094,9.143,9.143V434.286z M338.286,96c0,5.049-4.094,9.143-9.143,9.143H320  c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M384,434.286  c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143  c5.049,0,9.143,4.094,9.143,9.143V434.286z M384,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143  V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M429.714,434.286  c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143  c5.049,0,9.143,4.094,9.143,9.143V434.286z M429.714,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143  V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M475.429,434.286  c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143  c5.049,0,9.143,4.094,9.143,9.143V434.286z M475.429,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143  V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z"/>
                <g>
                    <path style="fill:#C9BEBE;" d="M420.571,388.571H91.429c-5.049,0-9.143-4.094-9.143-9.143V132.571c0-5.049,4.094-9.143,9.143-9.143   h329.143c5.049,0,9.143,4.094,9.143,9.143v246.857C429.714,384.478,425.621,388.571,420.571,388.571z"/>
                    <path style="fill:#C9BEBE;" d="M512,388.571h-54.857c-5.049,0-9.143-4.094-9.143-9.143V132.571c0-5.049,4.094-9.143,9.143-9.143   H512V388.571z"/>
                    <path style="fill:#C9BEBE;" d="M0,123.429h54.857c5.049,0,9.143,4.094,9.143,9.143v246.857c0,5.049-4.094,9.143-9.143,9.143H0   V123.429z"/>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
</svg>
            <a class="movieitem_carousel" id="<?=$row_random['movieId'];?>" name="<?=$row_random['title'];?>"
                    href="http://localhost/recommender_system/movies/?movie_id=<?=$row_random['movieId']?>&recommended=true"><?= $row_random['title']; ?></a>
        </div>
    <?php     }
    }
}
else{
    $query_random = "SELECT * FROM movies ORDER BY RAND()
LIMIT 10";
    $result_random = mysqli_query($con, $query_random);
    ?>
    <h2 class="recommended_title">Recommended Movies</h2>
<div class="owl-carousel owl-theme latest-carousel">
    <?php
    while ($row_random = mysqli_fetch_assoc($result_random)) { ?>
    <div class="item">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
<path style="fill:#876E6E;" d="M502.857,105.143c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143  c5.049,0,9.143-4.094,9.143-9.143s-4.094-9.143-9.143-9.143H9.143C4.094,50.286,0,54.379,0,59.429s4.094,9.143,9.143,9.143  s9.143,4.094,9.143,9.143V96c0,5.049-4.094,9.143-9.143,9.143S0,109.237,0,114.286v283.429c0,5.049,4.094,9.143,9.143,9.143  s9.143,4.094,9.143,9.143v18.286c0,5.049-4.094,9.143-9.143,9.143S0,447.522,0,452.571c0,5.049,4.094,9.143,9.143,9.143h493.714  c5.049,0,9.143-4.094,9.143-9.143c0-5.049-4.094-9.143-9.143-9.143c-5.049,0-9.143-4.094-9.143-9.143V416  c0-5.049,4.094-9.143,9.143-9.143c5.049,0,9.143-4.094,9.143-9.143V114.286C512,109.237,507.906,105.143,502.857,105.143z   M64,434.286c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143  c5.049,0,9.143,4.094,9.143,9.143V434.286z M64,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V77.714  c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M109.714,434.286c0,5.049-4.094,9.143-9.143,9.143  h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V434.286z   M109.714,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143  h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M155.429,434.286c0,5.049-4.094,9.143-9.143,9.143h-9.143  c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V434.286z   M155.429,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143  h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M201.143,434.286c0,5.049-4.094,9.143-9.143,9.143h-9.143  c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143H192c5.049,0,9.143,4.094,9.143,9.143V434.286z M201.143,96  c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143H192  c5.049,0,9.143,4.094,9.143,9.143V96z M246.857,434.286c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143  V416c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V434.286z M246.857,96c0,5.049-4.094,9.143-9.143,9.143  h-9.143c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z   M292.571,434.286c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143  h9.143c5.049,0,9.143,4.094,9.143,9.143V434.286z M292.571,96c0,5.049-4.094,9.143-9.143,9.143h-9.143  c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z   M338.286,434.286c0,5.049-4.094,9.143-9.143,9.143H320c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143  h9.143c5.049,0,9.143,4.094,9.143,9.143V434.286z M338.286,96c0,5.049-4.094,9.143-9.143,9.143H320  c-5.049,0-9.143-4.094-9.143-9.143V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M384,434.286  c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143  c5.049,0,9.143,4.094,9.143,9.143V434.286z M384,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143  V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M429.714,434.286  c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143  c5.049,0,9.143,4.094,9.143,9.143V434.286z M429.714,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143  V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z M475.429,434.286  c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143V416c0-5.049,4.094-9.143,9.143-9.143h9.143  c5.049,0,9.143,4.094,9.143,9.143V434.286z M475.429,96c0,5.049-4.094,9.143-9.143,9.143h-9.143c-5.049,0-9.143-4.094-9.143-9.143  V77.714c0-5.049,4.094-9.143,9.143-9.143h9.143c5.049,0,9.143,4.094,9.143,9.143V96z"/>
            <g>
                <path style="fill:#C9BEBE;" d="M420.571,388.571H91.429c-5.049,0-9.143-4.094-9.143-9.143V132.571c0-5.049,4.094-9.143,9.143-9.143   h329.143c5.049,0,9.143,4.094,9.143,9.143v246.857C429.714,384.478,425.621,388.571,420.571,388.571z"/>
                <path style="fill:#C9BEBE;" d="M512,388.571h-54.857c-5.049,0-9.143-4.094-9.143-9.143V132.571c0-5.049,4.094-9.143,9.143-9.143   H512V388.571z"/>
                <path style="fill:#C9BEBE;" d="M0,123.429h54.857c5.049,0,9.143,4.094,9.143,9.143v246.857c0,5.049-4.094,9.143-9.143,9.143H0   V123.429z"/>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
</svg>
        <a class="movieitem_carousel" id="<?=$row_random['movieId'];?>" name="<?=$row_random['title'];?>"
                href="http://localhost/recommender_system/movies/?movie_id=<?=$row_random['movieId']?>&recommended=true"><?= $row_random['title']; ?></a>
    </div>
        <?php     }
}

?>


</body>
</html>

