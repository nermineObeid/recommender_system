<?php
require_once 'connection.php';

$current_date = date("Y-m-d");
$yesterday = date('Y-m-d', strtotime(' -1 day'));
$yesterday_1 = date('Y-m-d', strtotime(' -2 day'));
$yesterday_2 = date('Y-m-d', strtotime(' -3 day'));
$yesterday_3 = date('Y-m-d', strtotime(' -4 day'));

$q = "SELECT * FROM newratinguser";
$res = mysqli_query($con, $q);
$r = mysqli_fetch_assoc($res);
$counter = 0;
$counter_1 = 0;
$counter_2 = 0;
$counter_3 = 0;
$counter_4 = 0;

$traffic = array(
    "today" => '',
    "yesterday" => '',
    "yesterday_1" => '',
    "yesterday_2" => '',
    "yesterday_3" => ''
);

while ($r = mysqli_fetch_assoc($res)) {
    if (stristr($r['currentdate'], $current_date)) {
        $counter += 1;
    } else if (stristr($r['currentdate'], $yesterday)) {
        $counter_1 += 1;
//        echo var_dump('hi');

    } else if (stristr($r['currentdate'], $yesterday_1)) {
        $counter_2 += 1;
    } else if (stristr($r['currentdate'], $yesterday_2)) {
        $counter_3 += 1;
    } else if (stristr($r['currentdate'], $yesterday_3)) {
        $counter_4 += 1;
    }
//    echo var_dump($r['currentdate']);

}

$traffic['today'] = $counter;
$traffic['yesterday'] = $counter_1;
$traffic['yesterday_1'] = $counter_2;
$traffic['yesterday_2'] = $counter_3;
$traffic['yesterday_3'] = $counter_4;
$traffic_json = json_encode($traffic);
setcookie("traffic", $traffic_json, time() + 2 * 24 * 60 * 60);
if (isset($_POST['submit'])) {
    $title = $_POST['adtitle'];
    $genres = $_POST['adgenres'];
    $tmdb = $_POST['adtmdb'];

    $query_select = "SELECT * FROM `movies` ORDER BY id DESC LIMIT 1";
    $result_select = mysqli_query($con, $query_select);
    $row_select = mysqli_fetch_assoc($result_select);
    $movieid_int = (int)$row_select['movieId'];
//      return var_dump($row_select['movieId']);
    $movieid_int = $movieid_int+1;

    $query = "INSERT INTO movies (movieId,title,genres) VALUES('$movieid_int','$title','$genres')";
    if ( mysqli_query($con, $query)) {

    } else {
        echo "failure:" . mysqli_error($con);
    }
    $query_link = "INSERT INTO links (movieId,tmdbId) VALUES('$movieid_int','$tmdb')";
    if ( mysqli_query($con, $query_link)) {

    } else {
        echo "failure:" . mysqli_error($con);
    }
}


?>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="http://localhost/recommender_system/js/index.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">-->
    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>-->
    <!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>-->
    <script src="http://localhost/recommender_system/js/index.js"></script>
    <link rel="stylesheet" type="text/css" href="http://localhost/recommender_system/css/main_1.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/recommender_system/css/main.css">

    <script type="text/javascript">
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

    <style type="text/css">
        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons that are used to open the tab content */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 4px 16px;
            transition: 0.3s;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
    </style>
    <script type="text/javascript">
        function openCity(evt, cityName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
    <?php  include('p-f/header.php'); ?>
</head>

<body>
<div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins container-login100 signup-page" style="background-image: url('images/depositphotos_5551251-stock-photo-cinema.jpg') !important;">
<!--    nermine-->
    <div class="tab">
        <button class="tablinks active bord-right" onclick="openCity(event, 'add_movie')">Add Movie</button>
        <button class="tablinks bord-right" onclick="openCity(event, 'user_accuracy')">User Accuracy</button>
        <button class="tablinks bord-right" onclick="openCity(event, 'algorithm_accuracy')">Algorithm Accuracy</button>
        <button class="tablinks bord-right" onclick="openCity(event, 'traffic')">Website Traffic</button>
        <button class="tablinks" onclick="openCity(event, 'most_viewed')">Most Viewed Movie Today</button>
    </div>

    <!-- Tab content -->
    <div id="add_movie" class="tabcontent" style="display: block;">
        <div class="wrapper wrapper--w680">
            <div class="card card-4" style="border: 0 !important;">
                <div class="card-body">
                    <h2 class="title">Add a movie</h2>
                    <form action="add_movies.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group">
                                    <label class="label">Title:</label>
                                    <input class="input--style-4" type="text" name="adtitle">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <label class="label">Genres:</label>
                                    <input class="input--style-4" type="text" name="adgenres">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group">
                                    <label class="label">tmdb id:</label>
                                    <input class="input--style-4" type="text" name="adtmdb">
                                </div>
                            </div>


                        </div>


                        <div class="p-t-15 flex-center" style="justify-content: center; margin-top: 20px;">
                            <button class="login100-form-btn" name="submit" type="submit">Add</button>
                        </div>
                    </form>
                    <p class="warning-msg"><b style="color: rgba(160, 5, 5,1);">WARNING: </b>It takes at least  30 minutes to <a href="http://localhost/recommender_system/dataminnungone.php" style="color: black;text-decoration: underline"><b>Rerun</b></a> the Algorithm</p>

                </div>
            </div>
        </div>
    </div>

    <div id="user_accuracy" class="tabcontent" style="display: none;">
        <ul>

<!--                <p>User id = -->
                <?php
                $query = "SELECT *
FROM users
JOIN accuracy ON users.id=accuracy.userId";

                $result = mysqli_query($con, $query);
                $nofrows = mysqli_num_rows($result);
//                $row = mysqli_fetch_assoc($result);
                if ($nofrows >0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <li><div class="row">
                                <div class="col-sm-6">
                <p><b>User id:</b> <?=$row['userId'];?> </br> <b>email: </b><?= $row['email'];?></p>

            </div>
            <div class="col-sm-6">
                <?php $user_acc = (double)$row['accuracy'];
                $user_acc = $user_acc*100;
                ?>
                <p><b>Accuracy: </b><?= round($user_acc).'%'?></p>
            </div> </div>
            </li>
        <?php }
        }
        ?>
        </ul></div>

    <div id="algorithm_accuracy" class="tabcontent" style="display: none;">
        <?php
        $query = "SELECT *
FROM accuracy";

        $result = mysqli_query($con, $query);
        $nofrows = mysqli_num_rows($result);
        //                $row = mysqli_fetch_assoc($result);
        $accuracy_arr = array();
        $accuracy = 0;
        if ($nofrows >0) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($accuracy_arr,(double)$row['accuracy']);
        }
        }
        foreach($accuracy_arr as $accuracy_ar){
           $accuracy+= $accuracy_ar;
        }
        $accuracy = ($accuracy/$nofrows)*100;

        ?>
        <h3>Algorithm Accuracy = <?=round($accuracy).'%'?></h3>
    </div>
    <div id="traffic" class="tabcontent" style="display: none;">
        <!--    chart-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <script>
            google.charts.load('current',{packages:['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            var trafficjson = jQuery.parseJSON(getCookie('traffic'));
            function drawChart() {
// Set Data
                var current_date = new Date().toJSON().slice(0,10);
                var yesterday = new Date((new Date()).valueOf() - 1000*60*60*24).toJSON().slice(0,10);
                var yesterday_1 = new Date((new Date()).valueOf() - 2*1000*60*60*24).toJSON().slice(0,10);
                var yesterday_2 = new Date((new Date()).valueOf() - 3*1000*60*60*24).toJSON().slice(0,10);
                var yesterday_3 = new Date((new Date()).valueOf() - 4*1000*60*60*24).toJSON().slice(0,10);
                // alert(yesterday);
                // alert(yesterday_1);
                // alert(yesterday_2);
                // alert(yesterday_3);
                var data = google.visualization.arrayToDataTable([
                    ['Date', 'Traffic'],
                    [current_date,trafficjson.today],[yesterday,trafficjson.yesterday],[yesterday_1,trafficjson.yesterday_1],[yesterday_2,trafficjson.yesterday_2],[yesterday_3,trafficjson.yesterday_3]
                ]);
// Set Options
                var options = {
                    title: 'Traffic vs. Date',
                    hAxis: {title: 'Date'},
                    vAxis: {title: 'Number of Visitors per day'},
                    legend: 'none'
                };
// Draw
                var chart = new google.visualization.LineChart(document.getElementById('myChart'));
                chart.draw(data, options);
            }
        </script>
        <div id="myChart" style="width:100%; max-width:600px;"></div>

        <!--    chart-->
    </div>
    <div id="most_viewed" class="tabcontent" style="display: none;">
        <?php
//        $query = "SELECT *, COUNT(movies.movieId) FROM movies JOIN newratinguser ON movies.movieId=newratinguser.movieId  GROUP BY movies.movieId HAVING COUNT(newratinguser.id) > 2 ORDER BY COUNT(movies.movieId) DESC LIMIT 1 WHERE currentdate LIKE '%$current_date%'";
        $query = "SELECT *, COUNT(movies.movieId) FROM movies JOIN newratinguser ON movies.movieId=newratinguser.movieId  WHERE currentdate LIKE '%$current_date%' GROUP BY movies.movieId ORDER BY COUNT(movies.movieId) DESC LIMIT 1";

        $result = mysqli_query($con, $query);
        $nofrows = mysqli_num_rows($result);
        if ($nofrows >0) {
            while ($row = mysqli_fetch_assoc($result)) {
//                if (stristr($row['currentdate'], $current_date)) {
                    ?>
                    <h3><?=$row['COUNT(movies.movieId)'];?> Views of '<?=$row['title'];?>' of id <?=$row['movieId'];?></h3>
             <?php
//            }
            }
        }

        ?>
    </div>

<!--    nermine-->

</div>

<!-- Jquery JS-->
<script src="vendor/jquery/jquery.min.js"></script>
<!-- Vendor JS-->
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/datepicker/moment.min.js"></script>
<script src="vendor/datepicker/daterangepicker.js"></script>

<!-- Main JS-->
<script src="js/global.js"></script>


</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->