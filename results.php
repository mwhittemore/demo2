<head>
  <link rel="stylesheet" href="styles.css">
  <link href='https://fonts.googleapis.com/css?family=Abril Fatface' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Pompiere' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Alegreya Sans' rel='stylesheet'>
</head>
<table border="1">
<tr>
<td>No.</td>
<td>Title</td>
<td>Synopsis</td>
<td>Released</td>
<td>Rating</td>
</tr>
<?php
	include("configuration.php");
    $query = "SELECT * FROM films WHERE ";
    $whereCount = 0;
    
    if(isset($_POST["ftitle"]) && !empty($_POST["ftitle"])) {
        $title = $_POST["ftitle"];
        $query .= "title = '$title' ";
        $whereCount++;
    }
    
    if(isset($_POST["fqualityRating"]) && !empty($_POST["fqualityRating"])) {        
        $quality = $_POST["fqualityRating"];
        if($whereCount > 0)
            $query .= "AND ";
        
        $query .= "quality_rating >= $quality ";
        $whereCount++;
    }
    
    if(isset($_POST["fyear"]) && !empty($_POST["fyear"])) { 
        $year = $_POST["fyear"];        
        
        if($whereCount > 0)
            $query .= "AND ";
        
        if(isset($_POST["when"]) && !empty($_POST["when"])) {
            $when = $_POST["when"];        
            if($when == "before") {
                $year .= "-01-01";
                $query .= "release_date < '$year' ";
            }
            else if($when == "after") {
                $year .= "-12-31";
                $query .= "release_date > '$year' ";
            }
        }
        else
            $query .= "release_date = '$year' ";
            
        $whereCount++;
    }
    
    if(isset($_POST["fgenres"]) && !empty($_POST["fgenres"])) {        
        $genres = $_POST["fgenres"];
        if($whereCount > 0)
            $query .= "AND ";
        
        $query .= "film_id IN (SELECT film_id FROM film_genres WHERE ";
        
        for ($i = 0; $i < count($genres); $i++) {
            if($i < count($genres) - 1)
                $query .= "genre_id = $genres[$i] OR ";
            else
                $query .= "genre_id = $genres[$i]) ";
        }
        $whereCount++;
    }
    
    if(isset($_POST["kw1"]) && !empty($_POST["kw1"])) {        
        $keyword1 = $_POST["kw1"];
        if($whereCount > 0)
            $query .= "AND ";
        
        $query .= "film_id IN (SELECT film_id FROM film_keywords WHERE keyword_id = (SELECT keyword_id FROM keywords WHERE keyword = '$keyword1') ";
        
        if(isset($_POST["kw2"]) && !empty($_POST["kw2"])) {
            $keyword2 = $_POST["kw2"];
            $query .= "OR keyword_id = (SELECT keyword_id FROM keywords WHERE keyword = '$keyword2') ";
            
            if(isset($_POST["kw3"]) && !empty($_POST["kw3"])) {
                $keyword3 = $_POST["kw3"];
                $query .= "OR keyword_id = (SELECT keyword_id FROM keywords WHERE keyword = '$keyword3') ";
                
                if(isset($_POST["kw4"]) && !empty($_POST["kw4"])) {
                    $keyword4 = $_POST["kw4"];
                    $query .= "OR keyword_id = (SELECT keyword_id FROM keywords WHERE keyword = '$keyword4') ";
                    
                    if(isset($_POST["kw5"]) && !empty($_POST["kw5"])) {
                        $keyword5 = $_POST["kw5"];
                        $query .= "OR keyword_id = (SELECT keyword_id FROM keywords WHERE keyword = '$keyword5') ";
                    }
                }
            }
        }
        
        $query .= ")";
        $whereCount++;
    }
    
    if(isset($_POST["act1"]) && !empty($_POST["act1"])) {        
        $actor1 = $_POST["act1"];
        if($whereCount > 0)
            $query .= "AND ";
        
        $query .= "film_id IN (SELECT film_id FROM cast_crew WHERE (person_id = (SELECT person_id FROM people WHERE name = '$actor1') ";
        
        if(isset($_POST["act2"]) && !empty($_POST["act2"])) {
            $actor2 = $_POST["act2"];
            $query .= "OR person_id = (SELECT person_id FROM people WHERE name = '$actor2') ";
            
            if(isset($_POST["act3"]) && !empty($_POST["act3"])) {
                $actor3 = $_POST["act3"];
                $query .= "OR person_id = (SELECT person_id FROM people WHERE name = '$actor3') ";
                
                if(isset($_POST["act4"]) && !empty($_POST["act4"])) {
                    $actor4 = $_POST["act4"];
                    $query .= "OR person_id = (SELECT person_id FROM people WHERE name = '$actor4') ";
                    
                    if(isset($_POST["act5"]) && !empty($_POST["act5"])) {
                        $actor5 = $_POST["act5"];
                        $query .= "OR person_id = (SELECT person_id FROM people WHERE name = '$actor5') ";
                    }
                }
            }
        }
        
        $query .= ") AND job_id = 1)";
        $whereCount++;
    }
    
    if(isset($_POST["dir1"]) && !empty($_POST["dir1"])) {        
        $director1 = $_POST["dir1"];
        if($whereCount > 0)
            $query .= "AND ";
        
        $query .= "film_id IN (SELECT film_id FROM cast_crew WHERE (person_id = (SELECT person_id FROM people WHERE name = '$director1') ";
        
        if(isset($_POST["dir2"]) && !empty($_POST["dir2"])) {
            $director2 = $_POST["dir2"];
            $query .= "OR person_id = (SELECT person_id FROM people WHERE name = '$director2') ";
            
            if(isset($_POST["dir3"]) && !empty($_POST["dir3"])) {
                $director3 = $_POST["dir3"];
                $query .= "OR person_id = (SELECT person_id FROM people WHERE name = '$director3') ";
                
                if(isset($_POST["dir4"]) && !empty($_POST["dir4"])) {
                    $director4 = $_POST["dir4"];
                    $query .= "OR person_id = (SELECT person_id FROM people WHERE name = '$director4') ";
                    
                    if(isset($_POST["dir5"]) && !empty($_POST["dir5"])) {
                        $director5 = $_POST["dir5"];
                        $query .= "OR person_id = (SELECT person_id FROM people WHERE name = '$director5') ";
                    }
                }
            }
        }
        
        $query .= ") AND job_id = 2) ";
        $whereCount++;
    }
    
    $query .="AND tmdb_poster_path IS NOT NULL;";

	if($resource=mysqli_query($link,$query)){
		$num=1;
		while($rowData=mysqli_fetch_assoc($resource)) {
            /*$img = "http://image.tmdb.org/t/p/w154";
            $img .= $rowData['tmdb_poster_path'];
            $handle = curl_init($img);
            curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

            /* Get the HTML or whatever is linked in $url. */
            //$response = curl_exec($handle);

            /* Check for 404 (file not found). */
            /*$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
            if($httpCode != 404)
                $imageData = base64_encode(file_get_contents($response));

            curl_close($handle);*/
?>
<tr>
<td><?php echo $num; ?></td>
<td><?php echo $rowData['title'];?>
<td><?php echo $rowData['synopsis'];?></td>
<td><?php echo date("Y", strtotime($rowData['release_date']));?></td>
<td><?php echo $rowData['quality_rating'];?></td>
</tr>
<?php
		$num ++;
		}
	}
?>
<tr>
</table>