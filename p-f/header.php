<?php //session_start(); ?>
<html>
<head>
    <link href="http://localhost/recommender_system/css/main.css" rel="stylesheet" />
    <script src="http://localhost/recommender_system/js/main.js" defer></script>
    <script src="http://localhost/recommender_system/js/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="http://localhost/recommender_system/js/jquery-1.12.4.min.js"></script>
    <script src="http://localhost/recommender_system/js/popper.min.js"></script>
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->
<!--    <link rel="stylesheet" href="http://localhost/recommender_system/css/font-awesome.min.css">-->


    <link rel="stylesheet" href="http://localhost/recommender_system/css/normalize.min.css" />
    <!--    <link rel="stylesheet" href="http://localhost/recommender_system/css/owl.theme.min.css"/>-->
    <link rel="stylesheet" href="http://localhost/recommender_system/css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="http://localhost/recommender_system/css/owl.theme.default.min.css"/>
    <link rel="stylesheet" href="http://localhost/recommender_system/css/animate.min.css"/>

    <!--    <link rel="stylesheet" href="http://localhost/recommender_system/css/bootstrap.min.css"/>-->
    <link rel="stylesheet" href="http://localhost/recommender_system/css/bootstrap.css"/>

    <!--    <script src="http://localhost/recommender_system/js/bootstrap.min.js" defer></script>-->
<!--    <script src="http://localhost/recommender_system/js/bootstrap.js" defer></script>-->

    <script src="http://localhost/recommender_system/js/owl.carousel.js" defer></script>
    <script src="http://localhost/recommender_system/js/owl.autoplay.js" defer></script>
    <script src="http://localhost/recommender_system/js/owl.navigation.js" defer></script>
    <script src="http://localhost/recommender_system/js/owl.support.js" defer></script>
    <!--    <script src="https://petrikor.agency/test/MBM/wp-content/themes/mbm/js/lazysizes.min.js" ></script>-->
    <script src="http://localhost/recommender_system/js/owl.animate.js" defer></script>

<!--    <script src="http://localhost/recommender_system/js/anim.js" defer></script>-->

    <script src="http://localhost/recommender_system/js/main.js"></script>



</head>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery(".latest-carousel").owlCarousel({
            stagePadding: 100,
            loop: false,
            margin: 40,
            nav: false,
            dots: true,
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:false,
            responsiveClass: true,
            responsive: {
                320: {
                    items: 1,
                    stagePadding: 20,
                    margin: 10
                },
                500: {
                    items: 2,
                    stagePadding: 20,
                    margin: 10
                },
                768: {
                    items: 2,
                    stagePadding: 20,
                    margin: 10
                },
                1024: {
                    items: 3
                }
            },
            autoplayHoverPause:true,
            touchDrag: true,
            mouseDrag: true,

        });
        jQuery(".latest-carousel").trigger('owl.play', 2000);
    });
</script>
<!--nermine-->
<?php
$genres = array(
'Action',
'Adventure',
'Animation',
'Children',
'Comedy',
'Crime',
'Documentary',
'Drama',
'Fantasy',
'Film-Noir',
'Horror',
'Musical',
'Mystery',
'Romance',
'Sci-Fi',
'Thriller',
'War',
'Western');
?>
<div class="parent-header">
<div class="menu-header row">
    <div class="col-sm-5 logo-div flex-center"><a href="http://localhost/recommender_system/index.php">
            <img src="<?=SITEURL?>images/cinema.png">
        </a></div>
    <div class="col-sm-7"><ul class="menu-items">
<!--        <li><a href="--><?//=SITEURL?><!--index.php">Home</a></li>-->
            <li><select class="sitemap" name="genres_select">
                    <option selected="" value="" disabled> -- Genres -- </option>
                    <?php for($index=0;$index<count($genres);$index++){?>
            <option value="<?=SITEURL?>genres/?genre=<?php echo $genres[$index];?>"><?= $genres[$index]?></option>
<!--                <a href="--><?//=SITEURL?><!--genres/?genre=--><?php //echo $genres[$index];?><!--">--><?//= $genres[$index]?><!--</a>-->

            </option>
    <?php    }?>






    </select></li>
            <?php
            if(!isset($_COOKIE['user_status'])) { ?>
                <li><a href="<?= SITEURL ?>signup.php">Sign Up</a></li>
                <li><a href="<?= SITEURL ?>login.php">Login</a></li>
                <?php
            }
            if(isset($_COOKIE['user_status'])){ ?>
                <li><a href="<?=SITEURL?>logout.php">Logout</a></li>
           <?php }
            ?>

            <li><a href="<?=SITEURL?>display_savedmovies.php">Wishlist</a></li>
            <li class="search-li">
                <form action="http://localhost/recommender_system/search.php" method="POST">
                    <input type="text" name="search_field" id="search" placeholder="Search" />
                   <input class="submit_search" type="submit" value="" /></i>
                </form>
            </li>
    </ul></div>
</div>
</div>

<!--nermine-->
<body>

</body>

    </header>
</html>



