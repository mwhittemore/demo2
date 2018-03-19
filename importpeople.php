 <?php 
	include("configuration.php");
    $query = "SELECT * FROM films WHERE film_id NOT IN (SELECT film_id FROM cast_crew)";
    if($resource=mysqli_query($link,$query)){
		$num=1;
		while($rowData=mysqli_fetch_assoc($resource)) {
   
            $id = $rowData['film_id'];
           
            $url = "http://api.themoviedb.org/3/movie/";
            $url .= $id . "/credits?api_key=f0060a08bbd35f8312d0c4cc87b05595";
            
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "$url",
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
              // do stuff
              // echo $response;
              $ccObj = json_decode($response);
              $fid = $ccObj->{"id"};
              $castArr = $ccObj->{"cast"};
              $crewArr = $ccObj->{"crew"};
              
               //var_dump($ccObj);
               //echo $ccObj->{"id"};
               //var_dump($ccObj->{"cast"});
               
              // cast
              for($i = 0; $i < count($castArr); $i++) {
                $pid = $castArr[$i]->{"id"};
                $pname = $castArr[$i]->{"name"};
                $pname = str_replace("'","\'",$pname);
                  
                $insQry = "INSERT INTO people (person_id, name) VALUES ($pid, '$pname');";
                // 1. INSERT INTO KEYWORDS TABLE
                $msg="Insert successful";
 
                $result=mysqli_query($link,$insQry);
                if($result){
                    header("Location:index.php?msg=".$msg);
                } else {
                    $msg="Problem with Insert";
                    header("Location:index.php?msg=".$msg);
                }
                
                // 2. INSERT INTO FILM_KEYWORDS TABLE
                $insQry = "INSERT INTO cast_crew (film_id, person_id, job_id) VALUES ($fid, $pid, 1);";
                $msg="Insert successful";
 
                $result=mysqli_query($link,$insQry);
                if($result){
                    header("Location:index.php?msg=".$msg);
                } else {
                        echo mysqli_error($link);?><br><?php
                        echo($insQry)?><br><br><?php
                }
              }
            }
            
            // crew              
            for($i = 0; $i < count($crewArr); $i++) {
                if($crewArr[$i]->{"job"} == "Director") {
                    $pid = $crewArr[$i]->{"id"};
                    $pname = $crewArr[$i]->{"name"};
                      
                    $insQry = "INSERT INTO people (person_id, name) VALUES ($pid, '$pname');";
                    // 1. INSERT INTO PEOPLE TABLE
                    $msg="Insert successful";
     
                    $result=mysqli_query($link,$insQry);
                    if($result){
                        header("Location:index.php?msg=".$msg);
                    } else {
                        $msg="Problem with Insert";
                        header("Location:index.php?msg=".$msg);
                    }
                    
                    // 2. INSERT INTO CAST_CREW TABLE
                    $insQry = "INSERT INTO cast_crew (film_id, person_id, job_id) VALUES ($fid, $pid, 2);";
                    $msg="Insert successful";
     
                    $result=mysqli_query($link,$insQry);
                    if($result){
                        header("Location:index.php?msg=".$msg);
                    } else {
                        echo mysqli_error($link);?><br><?php
                        echo($insQry)?><br><br><?php
                    }
                }
            }
            $num ++;
        }   
	}
?>