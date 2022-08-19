<?php require_once 'connection.php';
?>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">-->
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>-->
<!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>-->
    <script src="http://localhost/recommender_system/js/index.js"></script>
    <link rel="stylesheet" type="text/css" href="http://localhost/recommender_system/css/main_1.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/recommender_system/css/main.css">
    <?php
    include('p-f/header.php');?>
</head>
<script type="text/javascript">
    jQuery( document ).ready(
        function () {
            jQuery('.movie_title').click(function () {
                createCookie("movie_id_clicked", jQuery(this).parent().attr('id'), "10");
                createCookie("movie_name_clicked", jQuery(this).parent().attr('name'), "10");
            });
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
<body>



<?php
//    $query = "select * from user_rating WHERE userId=1";
?>
<?php
$current_genre = $_GET['genre'];
//$query = "SELECT * FROM movies WHERE genres LIKE '$current_genre'";
$query = "SELECT * FROM movies 
JOIN ratings ON movies.movieId = ratings.movieId WHERE movies.genres LIKE '$current_genre'";


$result = mysqli_query($con, $query);
$c=0;
?>
<div class="row list-genres">
  <?php  while($row = mysqli_fetch_assoc($result)){
//        return var_dump($row);
        ?>


            <div class="col-sm-4 item-genre" id="<?=$row['movieId']?>" name="<?=$row['title']?>">
                <a class="movie_title" href="<?=SITEURL?>movies/?movie_id=<?=$row['movieId']?>"><?= $row['title']?></a>


            </div>


        <?php


} ?>
</div>

<div class="clearfix"></div>

<!-- rating-->
<!-- rating-->

</body>
</html>

