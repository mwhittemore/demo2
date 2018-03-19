<?php	
    include("configuration.php");
    $query = "SELECT * FROM films WHERE film_id NOT IN (SELECT film_id FROM film_genres)";
    if($resource=mysqli_query($link,$query)){
		$num=1;
		while($rowData=mysqli_fetch_assoc($resource)) {
   
            $id = $rowData['film_id'];
            $url = "http://api.themoviedb.org/3/movie/";
            $url .= $id . "?api_key=f0060a08bbd35f8312d0c4cc87b05595";

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
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
                $resObj = json_decode($response);
                $genres = $resObj->{"genres"};
                for($i = 0; $i < count($genres); $i++) {
                    $gid = $genres[$i]->{"id"};
                    
                    // 2. INSERT INTO FILM_KEYWORDS TABLE
                    $insQry = "INSERT INTO film_genres (film_id, genre_id) VALUES ($id, $gid);";
                    $msg="Insert successful";
     
                    $result=mysqli_query($link,$insQry);
                    if($result){
                        header("Location:index.php?msg=".$msg);
                    } else {
                            echo mysqli_error($link);?><br><?php
                            echo($insQry);?><br><br><?php
                    }
              }
            }
            $num++;
        }
    }
?>