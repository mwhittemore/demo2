 <?php 
	include("configuration.php");
    
    for($i = 461; $i < 500; $i++) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.themoviedb.org/3/movie/popular?page=$i" . "&language=en-US&api_key=f0060a08bbd35f8312d0c4cc87b05595",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $page = json_decode($response);
            $filmArr = $page->{"results"};
            
            for($j = 0; $j < count($filmArr); $j++) {
                $film_id = $filmArr[$j]->{"id"};
                $poster_path = $filmArr[$j]->{"poster_path"};
                $vote_avg = $filmArr[$j]->{"vote_average"};
                $title = $filmArr[$j]->{"title"};
                $genres = $filmArr[$j]->{"genre_ids"};
                $overview = $filmArr[$j]->{"overview"};
                $release_date = $filmArr[$j]->{"release_date"};
                
                $title = str_replace("'", "\'", $title);
                $overview = str_replace("'", "\'", $overview);
                
                $insQry = "INSERT INTO films (film_id, title, release_date, synopsis, quality_rating, tmdb_poster_path) VALUES ($film_id, '$title', '$release_date', '$overview', $vote_avg, '$poster_path');";
                $msg="Insert successful";
 
                $result=mysqli_query($link,$insQry);
                echo "Page $i #" . $j . " " . mysqli_error($link);?><br><?php
                echo($insQry)?><br><br><?php
                
            }
        }
    }
?>