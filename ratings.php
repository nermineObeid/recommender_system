   <?php
require_once 'connection.php';
?>


<html>
    <head>
        <title>title</title>
        <?php include('p-f/header.php');?>
    </head>

    <body>



        <?php
           require_once 'connection.php';
//    $query = "select * from user_rating WHERE userId=1";
        $current_user = $_COOKIE['current_user'];
    $query = "SELECT *
FROM movies
JOIN ratings ON movies.movieId=ratings.movieId
WHERE userId=".$current_user." AND rating >= 4;";


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
        $c=0;
           if($count>0){

                  while($row = mysqli_fetch_assoc($result)){
                      $watched_movies[$row['movieId']] = $row['title'];
                          if(stristr($row['genres'],'|')){
                              $genres_array = explode("|",$row['genres']);
                              for($index=0;$index<count($genres_array);$index++){
//                                 $genres[$genres_array[$index]] += 1;
                                 $genres[$genres_array[$index]] += 1/$count * 100;
                                  array_push($interested_genres,$genres_array[$index]);

                              }
                          }
                          else {
//                              echo var_dump('not contained |'.$row['genres']);
                              $genres[$row['genres']] += 1/$count * 100;
//                              $genres[$row['genres']] += 1;
                              array_push($interested_genres,$row['genres']);
                          }



                        ?>
                        <?php
                  }

//               echo var_dump($watched_movies);
//               echo var_dump($genres);

                  foreach ($genres as $genre){

                      if($genre > 25){
                          $key = array_search ($genre, $genres);
                          $most_interested[$key] = $genre;

//                          echo var_dump($key);
//                          echo var_dump($genre);
//                          array_push($most_interested,$genre);
                      }

                  }
              echo 'Watched Movies by this user';
              echo var_dump($watched_movies);
               echo 'Interested Genres';
               echo var_dump(array_unique($interested_genres));
               echo var_dump($genres);
               echo 'Most Interested Genres >25%';
               echo var_dump($most_interested);
               echo var_dump(array_keys($most_interested));

           }
        $query_latest = "SELECT *
FROM movies
JOIN ratings ON movies.movieId=ratings.movieId
WHERE userId=".$current_user." AND rating >= 3.5 ORDER BY timestamp DESC LIMIT 5";
        $result_latest = mysqli_query($con, $query_latest);
        $interested_genres_latest = array();
        $most_interested_latest= array();
        while($row_latest = mysqli_fetch_assoc($result_latest)) {
            array_push($latest_movies, $row_latest['title']);
////            nermine
            echo var_dump($row_latest);

            if (stristr($row_latest['genres'], '|')) {
                $genres_array_latest = explode("|", $row_latest['genres']);

                for ($index_latest = 0; $index_latest < count($genres_array_latest); $index_latest++) {
//                                 $genres[$genres_array[$index]] += 1;
//                    $genres[$genres_array_latest[$index_latest]] += 1/$count * 100;
                    $genres_latest[$genres_array_latest[$index_latest]] += 1;
                    array_push($interested_genres_latest, $genres_array_latest[$index_latest]);

                }
            } else {
//                              echo var_dump('not contained |'.$row['genres']);
//                $genres[$row['genres']] += 1/$count * 100;
                $genres_latest[$row_latest['genres']] += 1;
//                              $genres[$row['genres']] += 1;
                array_push($interested_genres_latest, $row_latest['genres']);
            }
        }
//
////            nermine
            echo var_dump('5 movies');

            echo var_dump($genres);

//
//

        echo var_dump('latest_movies');
        echo var_dump($latest_movies);

        $total = array_unique($interested_genres_latest);
        foreach($genres_latest as $key=>$val){
            echo var_dump($val);
            if($val !=0){
                $genres_latest[$key] = ($val/count($total))*100;
//                echo var_dump($genres_latest);
//                echo var_dump($genres_latest);
            }
        }

        foreach ($genres_latest as $genre_latest) {
////
            if ($genre_latest > 25) {
                $key_latest = array_search($genre_latest, $genres_latest);
                $most_interested_latest[$key_latest] = $genre_latest;
            }
        }

//
        $all_interested_genres = array();
        $all_interested_genres = array_unique(array_merge(array_keys($most_interested),array_keys($most_interested_latest)), SORT_REGULAR);
        echo var_dump('all_interested_genres');
        echo var_dump($all_interested_genres);
        echo var_dump('latest_movies');
        echo var_dump($latest_movies);
        $datamining_result = array();

//        $query_datamining_first = "SELECT filmget FROM `dataminning` WHERE film LIKE '%".$latest_movies[0]."%' AND type LIKE '%" . $all_interested_genres[0] . "%' AND support >=2";
        $query_datamining_first = "SELECT filmget FROM `dataminnungone` WHERE film LIKE '%".$latest_movies[0]."%' AND type LIKE '%" . $all_interested_genres[0] . "%' AND support >=2";
        $result_datamining = mysqli_query($con, $query_datamining_first);
        while($row_datamining = mysqli_fetch_assoc($result_datamining)){
//                    echo var_dump($row_datamining);
            array_push($datamining_result,$row_datamining['filmget']);

//            }
        }
        for($i=1;$i<count($latest_movies);$i++){

//            if($i==0) {

            foreach($all_interested_genres as $all_interested_genre){
//            else{
////                echo var_dump($all_interested_genres[$i]);
                $query_datamining_second=$query_datamining_first." OR film LIKE '%".$latest_movies[$i]."%' AND type LIKE '%".$all_interested_genre."%' AND support >=2";
                $result_datamining_second = mysqli_query($con, $query_datamining_second);
                while($row_datamining_second = mysqli_fetch_assoc($result_datamining_second)){
//                    echo var_dump($row_datamining);
                    array_push($datamining_result,$row_datamining_second['filmget']);

                }
//        }
        }
        }

        $datamining_result_unique = array_values(array_unique($datamining_result));
        echo var_dump($datamining_result_unique);
        $datamining_result_string ='';
        for($index_data = 0;$index_data<count($datamining_result_unique);$index_data++){
            $datamining_result_string.=$datamining_result_unique[$index_data].'|';
        }
        $datamining_result_string = rtrim($datamining_result_string,'|');

//        showed_movies Insert + Update
        $query_check_showed = "SELECT * FROM `showed_movies` WHERE userId=".$current_user;
        $result_check_showed = mysqli_query($con, $query_check_showed);
        $nofrows_check_showed = mysqli_num_rows($result_check_showed);
        $row_check_showed = mysqli_fetch_assoc($result_check_showed);
        if ($nofrows_check_showed >0) {
            return var_dump($row_check_showed);
        $arr = explode('|',$row_check_showed['showing_movies']);
        $arr_merge_unique = array_unique(array_merge($arr,$datamining_result_unique));
//        nermine
            $datamining_result_string_show ='';
            for($index_data_show = 0;$index_data_show<count($arr_merge_unique);$index_data_show++){
                $datamining_result_string_show.=$arr_merge_unique[$index_data_show].'|';
            }
            $datamining_result_string_show = rtrim($datamining_result_string_show,'|');
//            return var_dump($datamining_result_string_show);
//            $query_update = "UPDATE showed_movies SET showing_movies = ".$datamining_result_string_show.", counter = ".count($arr_merge_unique)." WHERE userId=".$current_user;
            $counter_update = count($arr_merge_unique);
            $query_update = "UPDATE `showed_movies` SET `showing_movies`='$datamining_result_string_show',`counter`='$counter_update' WHERE `userId`='$current_user';";
            if(mysqli_query($con, $query_update)){} else {echo "failure:".mysqli_error($con);}
            //            return var_dump($datamining_result_string_show);

        }
        else{

        $datamining_result_unique_count = count($datamining_result_unique);
        $query_datamining_result = "INSERT INTO showed_movies (userId,showing_movies,counter) VALUES('1','$datamining_result_string','$datamining_result_unique_count')";
        if(mysqli_query($con, $query_datamining_result)){} else {echo "failure:".mysqli_error($con);}
}
//        showed_movies Insert + Update


?>
        <div class="owl-carousel owl-theme latest-carousel">
            <?php
            foreach($arr_merge_unique as $arr_merge_unique_item){
                $query_movieId = "SELECT movieId
FROM movies
WHERE title LIKE '%$arr_merge_unique_item%'";
                $result_movieId = mysqli_query($con, $query_movieId);
            while($row_movieId = mysqli_fetch_assoc($result_movieId)){
//                return var_dump($row_movieId);
            ?>
                <div class="item">
                    <img src="<?=SITEURL; ?>/images/maxresdefault.jpg">  <a class="movie_id_name" id="<?=$row_movieId['movieId']?>" name="<?=$arr_merge_unique_item?>" href="http://localhost/recommender_system/movies/?movie_id=<?=$row_movieId['movieId']?>&recommended=true"><?=$arr_merge_unique_item;?></a></div>
            <?php       }
            }?>
        </div>
<!--              nermine-->

<!--        datamining-->

        <div class="clearfix"></div>

<!--       --><?php //include('p-f/footer.php') ?>




    </body>
</html>
