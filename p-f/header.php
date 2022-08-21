<?php //session_start(); ?>
<html>
<head>
    <link href="http://localhost/recommender_system/css/main.css" rel="stylesheet" />
    <script src="http://localhost/recommender_system/js/main.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="https://petrikor.agency/test/ACG/wp-content/themes/flash/css/normalize.min.css" />
    <!--    <link rel="stylesheet" href="https://petrikor.agency/test/ACG/wp-content/themes/flash/css/owl.theme.min.css"/>-->
    <link rel="stylesheet" href="https://petrikor.agency/test/ACG/wp-content/themes/flash/css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="https://petrikor.agency/test/ACG/wp-content/themes/flash/css/owl.theme.default.min.css"/>
    <link rel="stylesheet" href="https://petrikor.agency/test/ACG/wp-content/themes/flash/css/animate.min.css"/>

    <!--    <link rel="stylesheet" href="https://petrikor.agency/test/ACG/wp-content/themes/flash/css/bootstrap.min.css"/>-->
    <link rel="stylesheet" href="https://petrikor.agency/test/ACG/wp-content/themes/flash/css/bootstrap.css"/>

    <!--    <script src="https://petrikor.agency/test/ACG/wp-content/themes/flash/js/bootstrap.min.js" defer></script>-->
    <script src="https://petrikor.agency/test/ACG/wp-content/themes/flash/js/bootstrap.js" defer></script>

    <script src="https://petrikor.agency/test/ACG/wp-content/themes/flash/js/owl.carousel.js" defer></script>
    <script src="https://petrikor.agency/test/ACG/wp-content/themes/flash/js/owl.autoplay.js" defer></script>
    <script src="https://petrikor.agency/test/ACG/wp-content/themes/flash/js/owl.navigation.js" defer></script>
    <script src="https://petrikor.agency/test/ACG/wp-content/themes/flash/js/owl.support.js" defer></script>
    <!--    <script src="https://petrikor.agency/test/MBM/wp-content/themes/mbm/js/lazysizes.min.js" ></script>-->
    <script src="https://petrikor.agency/test/ACG/wp-content/themes/flash/js/owl.animate.js" defer></script>
    <script src="https://petrikor.agency/test/ACG/wp-content/themes/flash/js/anim.js" defer></script>

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
    <div class="col-sm-6 logo-div flex-center"><a href="http://localhost/recommender_system/index.php">
            <img src="<?=SITEURL?>images/cinema.png">
        </a></div>
    <div class="col-sm-6"><ul class="menu-items">
<!--        <li><a href="--><?//=SITEURL?><!--index.php">Home</a></li>-->
            <li><select class="sitemap" name="genres_select">
                    <option selected="" value="" disabled> -- Genres -- </option>
                    <?php for($index=0;$index<count($genres);$index++){?>
            <option value="<?=SITEURL?>genres/?genre=<?php echo $genres[$index];?>"><?= $genres[$index]?></option>
<!--                <a href="--><?//=SITEURL?><!--genres/?genre=--><?php //echo $genres[$index];?><!--">--><?//= $genres[$index]?><!--</a>-->

            </option>
    <?php    }?>






    </select></li>
        <li><a href="<?=SITEURL?>signup.php">Sign Up</a></li>
        <li><a href="<?=SITEURL?>login.php">Login</a></li>
            <li><a href="<?=SITEURL?>display_savedmovies.php">Watchlist</a></li>
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



