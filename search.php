<?php
require_once 'connection.php'; ?>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">-->
    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>-->
    <!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>-->
    <script src="https://liuthesis.000webhostapp.com/js/index.js"></script>
    <link rel="stylesheet" type="text/css" href="https://liuthesis.000webhostapp.com/css/main_1.css">
    <link rel="stylesheet" type="text/css" href="https://liuthesis.000webhostapp.com/css/main.css">
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
</head>
<?php include('p-f/header.php'); ?>
<body>



<?php
require_once 'connection.php';
$search_input = $_POST['search_field'];
$query = "SELECT * FROM movies WHERE title LIKE '%$search_input%' OR genres LIKE '%$search_input%' ";


$result = mysqli_query($con, $query);

$count = mysqli_num_rows($result);
if($count>0){ ?>
<div class="row list-genres">
 <?php   while($row = mysqli_fetch_assoc($result)){ ?>

            <div class="col-sm-4 item-genre" id="<?=$row['movieId']?>" name="<?=$row['title']?>">
                <a class="movie_title" href="<?= SITEURL; ?>movies.php/?movie_id=<?=$row['movieId']?>"><?= $row['title']?></a>
<!--                <h1 class="movie_title" style="cursor:pointer;">--><?//= $row['title']?><!--</h1>-->
            </div>


        <?php
    }?>
     </div>

<?php }
?>
<div class="clearfix"></div>





</body>
</html>

