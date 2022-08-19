<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet"text="text/css">
    <script src="bootstrap-3.3.7-dist/js/jquery.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</head>
<body>
<title>Assosication Rule Familly Collection</title>

<?php
include_once("connection.php");
ini_set('max_execution_time', 0);
?>
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <?php
            echo "<pre><br><h2> Item </h2>";
            echo "<table class=table border=\2\>";
            echo " <tr><td>Daftar Item</td></tr>";
            if ($result = $con->query("select title,genres from movies", MYSQLI_USE_RESULT)) {
                //$item = $result->fetch_all();

                while ($i = $result->fetch_row()) {
                    $item[] = $i[0];
                    //$mouvietag[]=
                    $moviestype[$i[0]]=$i[1];
                    //	echo " <tr><td> ". $i[0] ."</td><td> ". $i[1] ."</td></tr>";

                }
                $result->close();
            }

            echo"</table>";
            echo"</pre>";
            ?>
        </div>


        <div class="col-sm-5">
            <?php
            $myarray = array();
            echo"<pre><br><h2>Transaksi</h2>";
            echo "<table class=table border=\2\>";
            echo " <tr><td>Item id</td><td>Item Set</td></tr>";

//            if ($result = $con->query("select userID,group_concat(movies.title separator '|')
//    from views left join movies
//	 on (views.movieID = movies.movieID)
//	 group by views.userID", MYSQLI_USE_RESULT)){
            if ($result = $con->query("select userId,group_concat(movies.title separator '|')
    from ratings left join movies
	 on (ratings.movieId = movies.movieId)
	 group by ratings.userId", MYSQLI_USE_RESULT)){
                //$belian = $result->fetch_all();
                $z = 0;
                $belian1=array();
                $belian2=array();
                while ($b = $result->fetch_row()) {
                    $belian[] = $b[1];


                    //echo " <tr><td> ". $b[0] ."</td><td> ". $b[1] ."</td></tr>";
                    /* $myarray[$z][0] =$b[0];
                     $myarray[$z][1] =$b[1];*/
                    $z++;
                }

                $result->close();
            }

            //$countmm=count($myarray);
            /*for($i=0;$i<$z;$i++){
                 $tr=$myarray[$i][1];
                        $idget=$myarray[$i][0];

            $query1 = "INSERT INTO transaction VALUES('null','$tr','$idget')";

                         if(mysqli_query($con, $query1)){} else {echo "failure:".mysqli_error($con);}
            }
            */
            echo"</table>";
            echo"</pre>";
            ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-5">
            <?php


            //$item = file('item.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
            //$belian = file('belian.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );


            $counter=0;
            $counter1=0;
            $comp='v';

            echo "<pre>";
            echo "\r\n<h3>Step 1: Gabungan 1 Item</h3>\r\n";
            // MENDAPATKAN JUMLAH BARANG
            echo "<table class=table border=\2\>";
            echo " <tr> <td>Nama Barang</td><td> Support Count</td><td>Support</td></tr>";
            foreach ($item as $value) {
                $total_per_item[$value] = 0;
                $support[$value] = 0;
                foreach($belian as $item_belian) {
                    if(strpos($item_belian, $value) !== false) {
                        $total_per_item[$value]++;
                        $support[$value]++;
                    }
                }

                $spr[$value] = round($support[$value] / $z * 100,2);
                if($total_per_item[$value]>50&&(strpos($comp, $value) == false)){
                    $comp=$comp.'|'.$value;

                    $belian1[$counter]=$value;


                    $counter++;
                    echo " <tr> <td>$value </td><td> ". $total_per_item[$value] ."</td><td> ". $spr[$value] ."%</td><td>".'//'.$counter."</td></tr>";

                }
            }
            echo"</table>";
            ?>
        </div>
        <div class="col-sm-7">
            <?php
            $item1 = $counter-2; // minus 1 from count
            $item2 = $counter-1;

            // MENDAPAT JUMLAH GABUNGAN
            echo "<pre>";
            echo "\r\n<h3>Step 2: Gabungan 2 Item</h3>\r\n";
            echo"<table class=table border=\2\>";
            echo"<tr> <td>Item Set</td><td> Support Count</td><td>Support</td></tr>";
            $comp='v';
            $rr=0;
            for($i = 0; $i < $item1; $i++) {
                for($j = $i+1; $j < $item2; $j++) {
                    $item_pair = $belian1[$i].'|'.$belian1[$j];
                    $item_array[$item_pair] = 0;
                    $sprt[$item_pair] = 0;
                    foreach($belian as $item_belian) {
                        if((strpos($item_belian, $item_pair) !== false) ) {
                            $item_array[$item_pair]++;
                            $sprt[$item_pair]++;

                        }
                        $spr[$item_pair] = round($sprt[$item_pair] / $z * 100, 2);
                    }
                    if($item_array[$item_pair]>0&&(strpos($comp, $item_pair) == false))
                    {
                        $comp=$comp.'|'.$item_pair;
                        $belian2[$counter1]=$item_pair;
                        $counter1++;
                        $rr++;
                        echo " <tr> <td>$item_pair </td><td> ". $item_array[$item_pair] ."</td><td> ". $spr[$item_pair] ."%</td><td>".'//'.$rr."</td></tr>";
                    }
                }
            }
            echo"</table>";
            ?>

        </div>
        <div>

            <?php

            $tot=count($belian);
            $comp='v';
            $rr=0;
            $item3 = $counter1;
            $counter2=0;
            $belian3=array();
            // MENDAPAT JUMLAH GABUNGAN
            echo "<pre>";
            echo "\r\n<h3>Step 3: Jumlah Gabungan 3 Item</h3>\r\n";
            echo"<table class=table border=\2\>";
            echo"<tr> <td>Item Set</td><td> Support Count</td><td>Support</td></tr>";
            /* for($i = 0; $i < $item3; $i++) {
                   for($j = $i+1; $j < $item1; $j++) {
                       $checkk='baker '.$belian2[$i];
                     if(strpos($checkk, $belian1[$j]) !== false){

                     }
                     else{
                       $item_pair33 = $belian2[$i].'|'.$belian1[$j];

                     $supcount[$item_pair33]=0;
                     $supcountpercentt[$item_pair33]=0;


                       foreach($belian as $item_belian33) {
                           if(strpos($item_belian33, $item_pair33) !== false ){
                               $supcount[$item_pair33]++;
                               $supcountpercentt[$item_pair33]++;

                           }

                           $supcountpercent[$item_pair33] = round( $supcountpercentt[$item_pair33] /$z  * 100, 2);
                       }

                     if($supcount[$item_pair33]>0&&(strpos($comp, $item_pair33) == false))
                     {

                         $belian3[$counter2]= $item_pair33;
                          $counter2++;
                          $comp=$comp.'|'.$item_pair33;$rr++;
                     echo " <tr> <td>$item_pair33 </td><td> ". $supcount[$item_pair33] ."</td><td> ". $supcountpercent[$item_pair33] ."%</td><td>".'//'.$rr."</td></tr>";
                     }
                   }}
                 }*/

            echo"</table>";
            ?>
        </div>
    </div>
</div>

<?php
$myarray1 = array();
echo"<pre>";
echo "\r\n<h1 style=text-align:center>Step 4: Association Rule 2 Item</h1>\r\n";
// MENDAPATKAN KIRAAN UNTUK ASSOCIATION RULES
echo"<br>Hasil untuk Confidence > 50%";
echo "<table class=table border=\2\>";
echo "<tr><td>Item Set</td><td>Confidence</td><td>Lift Ratio</td></tr>";
/*    $f1=0;
foreach ($item_array as $ia_key => $ia_value) {
   $theitems = explode('|',$ia_key);
   for($x = 0; $x < count($theitems); $x++) {
       $item_name = $theitems[$x];
       $item_total = $total_per_item[$item_name];

       if($item_total>0){
       $in_float = $ia_value / $item_total;
       $in_percent = round($in_float * 100, 2);
       $alt_item = $theitems[ ($x + 1) % count($theitems)];
        $benc_marc = round(($total_per_item[$theitems[0]]+$total_per_item[$theitems[1]])/$z*100,2);
   $lift_ratio =  round($in_percent/$spr[$theitems[0]], 2);
 if($lift_ratio<5&&$in_percent>50&&$in_percent!=100){
         $key0 = array_search($item_name, $theitems );
             $oneitemset='l';
             if($key0==0){
                 $oneitemset=$theitems[1];
             }
 else if($key0==1){
      $oneitemset=$theitems[0];
 }
     echo "<tr><td>$oneitemset($ia_value) --> $item_name($item_total)</td> <td> ". $in_percent ."%</td> <td>".$lift_ratio."</td></tr>";
        $myarray1[$f1][0] =$ia_key;
        $myarray1[$f1][1] =$ia_value;
        $myarray1[$f1][2] =$item_name;
         $myarray1[$f1][3] =$item_total;
          $myarray1[$f1][4] =$in_percent;
          $f1++;


 }

   }
   }
}

$countmm1=count($myarray1);

for($i=0;$i<$countmm1;$i++){
$productbuy=$myarray1[$i][0];
       $productnumber=$myarray1[$i][1];
        $prop=$myarray1[$i][2];
         $propnumber=$myarray1[$i][3];
          $Confidence=$myarray1[$i][4];

$query2 = "INSERT INTO dataminning1 VALUES('null','$productbuy','$productnumber','$prop','$propnumber','$Confidence')";

        if(mysqli_query($con, $query2)){} else {echo "failure:".mysqli_error($con);}
}*/
echo"</table>";
echo "</pre>";
?>
<?php
$f2=0;
$rr=0;
$myarray2 = array();
echo"<pre>";
echo "\r\n<h1 style=text-align:center>Step 5: Association Rule 3 Item</h1>\r\n";
// MENDAPATKAN KIRAAN UNTUK ASSOCIATION RULES
echo"<br>Hasil untuk Confidence > 50%";
echo "<table class=table border=\2\>";
echo "<tr><td>Item Set</td><td>Confidence</td><td>Lift Ratio</td></tr>";
$query01= "DROP TABLE dataminning";
if(mysqli_query($con, $query01)){
    echo '';
}
else {
    echo "failure:".mysqli_error($con);
}
$query01= "CREATE TABLE dataminning (
    id int(50) AUTO_INCREMENT PRIMARY KEY,
    film VARCHAR(150) NOT NULL,
    filmget VARCHAR(150) NOT NULL,
    support int(50) NOT NULL,
    type VARCHAR(150) NOT NULL)";

if(mysqli_query($con, $query01)){
    echo '';
}
else {
    echo "failure:".mysqli_error($con);
}
$countbelian3=count($belian2);
for($f=0;$f<$countbelian3;$f++){
    $theitems33 = explode('|',$belian2[$f]);
    $ser=$belian2[$f];
    $supt=$item_array[$ser];
    for($x = 0; $x < 2; $x++) {

        $item_name33 = $theitems33[$x];

        //    $item_total33 = $belian1[$item_name33][0];
        $sup1=$total_per_item[$item_name33];

        $confid=round(($supt/$sup1)*100,2);



        $key = array_search($item_name33,  $theitems33 );
        $oneitemset='l';
        if($key==0){
            $oneitemset=$theitems33[1];
        }
        else if($key==1){
            $oneitemset=$theitems33[0];
        }

        $rr++;

//        $query2 = "INSERT INTO dataminning VALUES('null','$oneitemset','$item_name33','$supt','$moviestype[$item_name33]')";
        $query2 = "INSERT INTO dataminning ('film', 'filmget','support','type') VALUES('$oneitemset','$item_name33','$supt','$moviestype[$item_name33]')";

        if(mysqli_query($con, $query2)){} else {echo "failure:".mysqli_error($con);}
        echo "<tr><td>$oneitemset($supt) --> $item_name33($sup1)</td> <td> ". $confid ."%</td> <td>".'//'.$rr."</td></tr>";

    }
}




/* $countmm2=count($myarray2);

for($i=0;$i<$countmm2;$i++){
 $productbuy2=$myarray2[$i][0];
        $productnumber2=$myarray2[$i][1];
         $prop2=$myarray2[$i][2];
          $propnumber2=$myarray2[$i][3];
           $Confidence2=$myarray2[$i][4];

$query2 = "INSERT INTO dataminnin2 VALUES('null','$productbuy2','$productnumber2','$prop2','$propnumber2','$Confidence2')";

         if(mysqli_query($con, $query2)){} else {echo "failure:".mysqli_error($con);}
}*/
echo"</table>";
echo "</pre>";
?>


</body>
</html>