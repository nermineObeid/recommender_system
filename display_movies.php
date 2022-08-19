<?php
require_once 'connection.php'; ?>
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

        });
            //function go2Page()
            //{
            //    var page = document.getElementById("page").value;
            //    page = ((page><?php //echo $total_pages; ?>//)?<?php //echo $total_pages; ?>//:((page<1)?1:page));
            //    window.location.href = 'display_movies.php?page='+page;
            //}
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
</head>
<?php include('p-f/header.php'); ?>
<body>



<?php
require_once 'connection.php';
//    $query = "select * from user_rating WHERE userId=1";
//$query = "SELECT * FROM movies ORDER BY id LIMIT 100";
$per_page_record = 100; // Number of entries to show in a page.
// Look for a GET variable page if not found default is 1.
if (isset($_GET["page"])) {
    $page  = $_GET["page"];
}
else {
    $page=1;
}

$start_from = ($page-1) * $per_page_record;
//$query = "SELECT * FROM movies  LIMIT $start_from, $per_page_record";
$query = "SELECT * FROM movies 
JOIN ratings ON movies.movieId = ratings.movieId LIMIT $start_from, $per_page_record";

$interested_genres = array();

$result = mysqli_query($con, $query);

$count = mysqli_num_rows($result);

if($count>0){ ?>
<div class="row list-genres">
 <?php   while($row = mysqli_fetch_assoc($result)){ ?>

            <div class="col-sm-4 item-genre" id="<?=$row['movieId']?>" name="<?=$row['title']?>">
                <a class="movie_title" href="http://localhost/recommender_system/movies/?movie_id=<?=$row['movieId']?>"><?= $row['title']?></a>
<!--                <h1 class="movie_title" style="cursor:pointer;">--><?//= $row['title']?><!--</h1>-->
            </div>


        <?php
    }?>
     </div>

<?php }
?>
<div class="pagination">
    <?php
    $query = "SELECT COUNT(*) FROM movies";
    $rs_result = mysqli_query($con, $query);
    $row = mysqli_fetch_row($rs_result);
    $total_records = $row[0];

    echo "</br>";
    // Number of pages required.
    $total_pages = ceil($total_records / $per_page_record);
    $pagLink = "";

    if($page>=2){
        echo "<a href='display_movies.php?page=".($page-1)."'>  Prev </a>";
    }

    for ($i=1; $i<=$total_pages; $i++) {
        if ($i == $page) {
            $pagLink .= "<a class = 'active' href='display_movies.php?page="
                .$i."'>".$i." </a>";
        }
        else  {
            $pagLink .= "<a href='display_movies.php?page=".$i."'>   
                                                ".$i." </a>";
        }
    };
    echo $pagLink;

    if($page<$total_pages){
        echo "<a href='display_movies.php?page=".($page+1)."'>  Next </a>";
    }

    ?>
</div>


<div class="inline">
    <input id="page" type="number" min="1" max="<?php echo $total_pages?>"
           placeholder="<?php echo $page."/".$total_pages; ?>" required>
    <button onClick="go2Page();">Go</button>
</div>
<div class="clearfix"></div>





</body>
</html>

