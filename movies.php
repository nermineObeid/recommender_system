<?php require_once 'connection.php';
$cookiePath = "/";
//setcookie("ratingNum","", time()-3600, $cookiePath);
//unset ($_COOKIE['ratingNum']);
?>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://localhost/recommender_system/css/style.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/recommender_system/css/main_1.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/recommender_system/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">-->
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>-->
<!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>-->

    <script src="http://localhost/recommender_system/js/index.js"></script>
<!--    <script src="http://localhost/recommender_system/js/jquery.cookie.js"></script>-->
    <script type="text/javascript">
            jQuery( document ).ready(
                function () {


                    jQuery('.saved_msg').hide();
                    jQuery('.saved_msg').toggle();
                    var user_id = getCookie('current_user');
                    var moviename = getCookie('movie_name_clicked');
                    var movieID = getCookie('movie_id_clicked');

                    jQuery('.rate input').on('click', function(){

                        createCookie("ratingNum", jQuery(this).val(), "10");
                        var ratingNum = jQuery(this).val();
                        $.ajax({
                                type: 'POST',
                                url: '/recommender_system/update_rating.php',
                                data: 'movieID='+movieID+'&ratingNum='+ratingNum,
                                dataType: 'json',
                                success : function(resp) {
                                    alert('success');
                                    if(resp.status == 1){
                                        jQuery('#avgrat').text(resp.data.average_rating);
                                        jQuery('#totalrat').text(resp.data.rating_num);

                                    }else if(resp.status == 2){
                                    }

                                    jQuery( ".rate input" ).each(function() {
                                        if(jQuery(this).val() <= parseInt(resp.data.average_rating)){
                                            jQuery(this).attr('checked', 'checked');
                                        }else{
                                            jQuery(this).prop( "checked", false );
                                        }
                                    });
                                }
                            });
                        // nermine
                        // $.ajax({
                        //     url: "/recommender_system/insert_rating.php",
                        //     type: "POST",
                        //     data: {
                        //         ratingNum: ratingNum,
                        //
                        //     },
                        //
                        //     success: function (response) {
                        //         console.log(response);
                        //     },
                        //     error: function (response) {
                        //         console.log(response);
                        //
                        //     },
                        // });
                        // nermine
                    });


                jQuery('.imdb_movie').click(function (e) {
                    e.preventDefault();
                var movie_id = jQuery(this).parent().parent().attr('id');
                var user_id = getCookie('current_user');
                var imdb_link = jQuery(this).attr('href');
                    createCookie('avgRating',jQuery('.overall-rating #avgrat').text(),10);


                    let searchParams = new URLSearchParams(window.location.search);
                    searchParams.has('name');
                    let recommended_check = searchParams.get('recommended');
                    if(recommended_check=='true'){
                        var recommended = 'true';
                    }
                    createCookie('avgRating',jQuery('.overall-rating #avgrat').text(),10);



                    $.ajax({
                        url: "/recommender_system/insert_rating.php",
                        type: "POST",
                        data: {
                            movie_id: movie_id,
                            user_id: user_id,
                            recommended: recommended,
                            moviename: moviename,

                        },

                        success: function (response) {
                            console.log(response);
                        },
                        error: function (response) {
                            console.log(response);

                        },
                    });
                    // window.location.href = imdb_link;
                });

                    jQuery('.tmdb_movie').click(function (e) {
                        e.preventDefault();
                        var movie_id = jQuery(this).parent().parent().attr('id');
                        var tmdb_link = jQuery(this).attr('href');
                        var user_id = getCookie('current_user');
                        createCookie('avgRating',jQuery('.overall-rating #avgrat').text(),10);
                        jQuery('.iframe_section').show();

                        let searchParams = new URLSearchParams(window.location.search);
                        searchParams.has('name');
                        let recommended_check = searchParams.get('recommended');
                        if(recommended_check=='true'){
                            var recommended = 'true';
                        }
                        else{
                            var recommended = 'false';
                        }
                        // alert(movie_id);

                        $.ajax({
                            url: "/recommender_system/insert_rating.php",
                            type: "POST",
                            data: {
                                movie_id: movie_id,
                                user_id: user_id,
                                recommended: recommended,
                                moviename: moviename,

                            },

                            success: function (response) {
                                console.log(response);
                            },
                            error: function (response) {
                                console.log(response);

                            },
                        });
                        // window.location.href = tmdb_link;
                    });
                    jQuery('.watchlist').click(function(){
                        var movie_id = getCookie('movie_name_clicked');
                        jQuery(this).find('i').toggleClass('saved');
                        if(jQuery(this).find('i').hasClass('saved')){
                            $.ajax({
                                url: "/recommender_system/watchlist.php",
                                type: "POST",
                                data: {
                                    movie_id: movie_id,
                                    user_id: user_id,
                                },

                                success: function (response) {
                                    console.log(response);
                                },
                                error: function (response) {
                                    console.log(response);

                                },
                            });
                        }
                        else{
                            var saved = 'false';
                            $.ajax({
                                url: "/recommender_system/watchlist_remove.php",
                                type: "POST",
                                data: {
                                    movie_id: movie_id,
                                    user_id: user_id,
                                },

                                success: function (response) {
                                    console.log(response);
                                },
                                error: function (response) {
                                    console.log(response);

                                },
                            });
                        }


                    });
                    var current_url = window.location.href;
                    var current_user_increment = 0;
                    if(current_url.indexOf("/display_movies") > -1){
                        current_user_increment+=1;
                       // createCookie('current_user',current_user_increment,0.5)

                    }

            jQuery('.movie_title').click(function () {
                createCookie("movie_id_clicked", jQuery(this).parent().attr('id'), "10");
                createCookie("movie_name_clicked", jQuery(this).parent().attr('name'), "10");
            });
                    // jQuery('.nermine-stars').click(function () {
                        // alert(jQuery(this).parent().parent().find('.ratingHolder').text());
                        // $.ajax({
                        //     url: "/recommender_system/starrating.php",
                        //     type: "POST",
                        //     data: {
                        //         movie_id: movie_id,
                        //         user_id: user_id,
                        //
                        //     },
                        //
                        //     success: function (response) {
                        //         console.log(response);
                        //     },
                        //     error: function (response) {
                        //         console.log(response);
                        //
                        //     },
                        // });
                    // });

        });
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

            function deleteCookie(name) {
                document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;' + " path=/";
            }
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
require_once 'connection.php';

//    $query = "select * from user_rating WHERE userId=1";
?>
<div>  <div class="starRatingContainer"> <div class="className"> </div> </div>  <div class="ratingHolder"> </div> </div>

<div> <div class="starRatingContainer"> <div class="ratingSystem"> </div> </div>  <div class="ratingHolder"> </div> </div>

<!--<div>  <div class="starRatingContainer"> <div class="className"> </div> </div>  <div class="ratingHolder"> </div> </div>-->

<div> <div class="starRatingContainer"> <div class="ratingSystem"> </div> </div>  <div class="ratingHolder"> </div> </div>

<div>  <div class="starRatingContainer"> <div class="className nermine-stars"> </div> </div>  <div class="ratingHolder"> </div> </div>

<div> <div class="starRatingContainer"><div class="update1.2"></div></div> <div class="ratingHolder"></div> </div>

<div id="customTooltip" style="background-color:slategrey; color:white; padding: 5px 20px; border-radius: 25px; position:fixed; display:none;"></div>
<div class="parent-int-movies">
<?php
$current_movie = $_GET['movie_id'];
$query = "SELECT * FROM movies 
JOIN links ON movies.movieId = links.movieId WHERE movies.movieId=".$current_movie;

$interested_genres = array();

$result = mysqli_query($con, $query);
$count = mysqli_num_rows($result);
$c=0;
if($count>0){

    while($row = mysqli_fetch_assoc($result)){?>
        <div class="row internal-movies">
            <div class="" id="<?=$row['movieId']?>" name="<?=$row['title']?>">
                <h1 class="movie_title"><?= $row['title']?></h1>
                <?php

                if(stristr($row['genres'], '|')){
                    $genres_arr = explode('|',$row['genres']);
                    $numItems = count($genres_arr);
                    $i = 0;
                    foreach($genres_arr as $genre_arr){
                        if(++$i === $numItems) { ?>
                        <span><a class="movie_genres" href="http://localhost/recommender_system/genres/?genre=<?=$genre_arr;?>"><?=$genre_arr;?></a></span>

                <?php }
                        else{ ?>
                            <span><a class="movie_genres" href="http://localhost/recommender_system/genres/?genre=<?=$genre_arr;?>"><?=$genre_arr.',';?></a></span>

                        <?php   }?>


                    <?php }
 }
                else{ ?>
                 <span><a class="movie_genres" href="http://localhost/recommender_system/genres/?genre=<?=$row['genres'];?>"><?=$row['genres'];?></a></span>

         <?php       } ?>
<div><span>Share Link on:</span><a href="https://api.whatsapp.com/send?text=https://www.themoviedb.org/movie/<?= $row['tmdbId'];?>" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a>
                        <a name="fb_share" type="button" href="https://www.facebook.com/sharer.php?u=https://www.themoviedb.org/movie/<?= $row['tmdbId'];?>&t=TEst"><i class="fa fa-facebook"></i></a>
                    </div>

                    <?php

                    if (isset($_COOKIE['current_user'])) {
                        $movie_id = $_COOKIE['movie_id_clicked'];
                        $current_user = $_COOKIE['current_user'];
     $query_select = "SELECT * FROM `saving_movies` WHERE `userId`='$current_user' AND savedmovieId='$movie_id'";
    $result_select = mysqli_query($con, $query_select);
    $nofrows_select = mysqli_num_rows($result_select);
    $row_select = mysqli_fetch_assoc($result_select);
    if ($nofrows_select > 0) { ?>
        <div class="watchlist"><i class="fa fa-bookmark saved" aria-hidden="true"></i></div>
    <?php }
    else{ ?>
        <div class="watchlist"><i class="fa fa-bookmark" aria-hidden="true"></i></div>
 <?php   }



                    }
                $movie_withoutparentheses = explode('(' , rtrim($row['title'], ')'));
                $lowercase_movie = str_replace(" ","-", strtolower(trim($movie_withoutparentheses[0])));
//                return var_dump($lowercase_movie);
                    $tmdb_id = $row['tmdbId'];
                ?>
<!--                <h2 style="display: flex;align-items: center;    padding-top: 45px;">You can watch it on tmdb      <a class="tmdb_movie" href="https://www.themoviedb.org/movie/--><?//= $row['tmdbId']?><!-----><?//=$lowercase_movie?><!--">Watch ></a></h2>-->
                <h2 style="display: flex;align-items: center;    padding-top: 45px;">You can watch it on tmdb      <p class="tmdb_movie">Watch ></p></h2>
<!--                <h2>imdb link: <a class="imdb_movie" href="https://www.imdb.com/title/tt0--><?//= $row['imdbId']?><!--">--><?//= $row['imdbId']?><!--</a></h2>-->


            </div>
        </div>

        <?php
    }

}
//rating
// Fetch the post and rating info from database
$query_rating = "SELECT movieId, COUNT(rating) as rating_num, FORMAT((SUM(rating) / COUNT(rating)),1) as average_rating FROM ratings WHERE movieId = ".$_GET['movie_id']." GROUP BY (movieId)";
$result_rating = mysqli_query($con, $query_rating);
$nofrows_rating= mysqli_num_rows($result_rating);
if($nofrows_rating >0){
while($row_rating = mysqli_fetch_assoc($result_rating)) {
//    setcookie("avg_rating", $row_rating['average_rating'], time() + 2 * 24 * 60 * 60);

//    echo var_dump($row_rating['average_rating']);
    if (isset($_COOKIE['current_user'])) {

        ?>
        <div class="flex-1200">
            <div class="rate">
                <input type="radio" id="star5" name="rating"
                       value="5" <?php echo ($row_rating['average_rating'] >= 5) ? 'checked="checked"' : ''; ?>>
                <label for="star5"></label>
                <input type="radio" id="star4" name="rating"
                       value="4" <?php echo ($row_rating['average_rating'] >= 4) ? 'checked="checked"' : ''; ?>>
                <label for="star4"></label>
                <input type="radio" id="star3" name="rating"
                       value="3" <?php echo ($row_rating['average_rating'] >= 3) ? 'checked="checked"' : ''; ?>>
                <label for="star3"></label>
                <input type="radio" id="star2" name="rating"
                       value="2" <?php echo ($row_rating['average_rating'] >= 2) ? 'checked="checked"' : ''; ?>>
                <label for="star2"></label>
                <input type="radio" id="star1" name="rating"
                       value="1" <?php echo ($row_rating['average_rating'] >= 1) ? 'checked="checked"' : ''; ?>>
                <label for="star1"></label>
            </div>
            <div class="overall-rating">
                (Average Rating <span id="avgrat"><?php echo $row_rating['average_rating'];
                    ?></span>
                Based on <span id="totalrat"><?php echo $row_rating['rating_num']; ?></span> rating)</span>
            </div>

        </div>
    <?php }
}
}
else{?>
    <div class="flex-1200">
        <div class="rate">
            <input type="radio" id="star5" name="rating"
                   value="5">
            <label for="star5"></label>
            <input type="radio" id="star4" name="rating"
                   value="4">
            <label for="star4"></label>
            <input type="radio" id="star3" name="rating"
                   value="3">
            <label for="star3"></label>
            <input type="radio" id="star2" name="rating"
                   value="2">
            <label for="star2"></label>
            <input type="radio" id="star1" name="rating"
                   value="1">
            <label for="star1"></label>
        </div>


    </div>
<?php }

?>
<div class="clearfix"></div>
</div>

<?php
// get cURL resource
//$ch = curl_init();
//
//// set url
//curl_setopt($ch, CURLOPT_URL, 'https://app.scrapingbee.com/api/v1/?api_key=P3LZUW3D8NW1ZWQ129BVHVS5BXVL3HI92JHXW1WMCR8CND6Q6TA8X1XIVXA6G9YVNFD7LH4LKANFGAVF&url=https://www.themoviedb.org/movie/40061-joyeuses-p-ques');
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

<iframe class="iframe_section" src="https://www.themoviedb.org/movie/<?= $tmdb_id?>-<?=$lowercase_movie?>" height="500" width="100%" >

</iframe>

</body>
</html>

