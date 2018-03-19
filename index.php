<head>
  <link rel="stylesheet" href="styles.css">
<link href='https://fonts.googleapis.com/css?family=Bungee Shade' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Pompiere' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Alegreya Sans' rel='stylesheet'>
</head>
<h1> FilmScout </h1>
<form action="results.php" method="POST">
	<div class="row">
		<div class="cols">Title</div>
		<div class="cols">
			<input type="text" name="ftitle" id="ftitle" value="<?php if(isset($row['ftitle'])){echo $row['ftitle'];}?>">
		</div>
	</div>
	<div class="row">
		<div class="cols">Genres</div>
		<div class="cols">
            <select name="fgenres[]" size=10 multiple>
                <option value = 28>Action</option>
                <option value = 12>Adventure</option>
                <option value = 16>Animation</option>
                <option value = 35>Comedy</option>
                <option value = 80>Crime</option>
                <option value = 99>Documentary</option>
                <option value = 18>Drama</option>
                <option value = 10751>Family</option>
                <option value = 14>Fantasy</option>
                <option value = 36>History</option>
                <option value = 27>Horror</option>
                <option value = 10402>Music</option>
                <option value = 9648>Mystery</option>
                <option value = 10749>Romance</option>
                <option value = 878>Science Fiction</option>
                <option value = 53>Thriller</option>
                <option value = 10770>TV Movie</option>
                <option value = 10752>War</option>
                <option value = 37>Western</option>
            </select>
			</div>
	</div>
    <div class="row">
		<div class="cols">About...</div>
		<div class="cols">
            <input type="text" name="kw1" value="<?php if(isset($row['kw1'])){echo $row['kw1'];}?>">
            <input type="text" name="kw2" value="<?php if(isset($row['kw2'])){echo $row['kw2'];}?>">
            <input type="text" name="kw3" value="<?php if(isset($row['kw3'])){echo $row['kw3'];}?>">
            <input type="text" name="kw4" value="<?php if(isset($row['kw4'])){echo $row['kw4'];}?>">
            <input type="text" name="kw5" value="<?php if(isset($row['kw5'])){echo $row['kw5'];}?>">
			</div>
	</div>
    <div class="row">
		<div class="cols">Starring...</div>
		<div class="cols">
            <input type="text" name="act1" value="<?php if(isset($row['act1'])){echo $row['act1'];}?>">
            <input type="text" name="act2" value="<?php if(isset($row['act2'])){echo $row['act2'];}?>">
            <input type="text" name="act3" value="<?php if(isset($row['act3'])){echo $row['act3'];}?>">
            <input type="text" name="act4" value="<?php if(isset($row['act4'])){echo $row['act4'];}?>">
            <input type="text" name="act5" value="<?php if(isset($row['act5'])){echo $row['act5'];}?>">
			</div>
	</div>
        <div class="row">
		<div class="cols">Directed By...</div>
		<div class="cols">
            <input type="text" name="dir1" value="<?php if(isset($row['dir1'])){echo $row['dir1'];}?>">
            <input type="text" name="dir2" value="<?php if(isset($row['dir2'])){echo $row['dir2'];}?>">
            <input type="text" name="dir3" value="<?php if(isset($row['dir3'])){echo $row['dir3'];}?>">
            <input type="text" name="dir4" value="<?php if(isset($row['dir4'])){echo $row['dir4'];}?>">
            <input type="text" name="dir5" value="<?php if(isset($row['dir5'])){echo $row['dir5'];}?>">
			</div>
	</div>
    <div class="row">
		<div class="cols">Made...</div>
		<div class="cols">
            <input type="radio" name="when" value="before">Before
            <input type="radio" name="when" value="after">After
            <i><br>Enter Year</i>
			<input type="text" name="fyear" id="fyear" value="<?php if(isset($row['fyear'])){echo $row['fyear'];}?>">
			</div>
	</div>
    <div class="row">
		<div class="cols">Rated at least...</div>
		<div class="cols">
			<input type="text" name="fqualityRating" id="fqualityRating" value="<?php if(isset($row['fqualityRating'])){echo $row['fqualityRating'];}?>">
			</div>
	</div>
	<div class="row">
		<div class="cols">
			<input type="submit" name="submit" value="search">
		</div>
		<div class="cols">
			<input type="hidden" name="cid" value="">
		</div>
	</div>
</form>