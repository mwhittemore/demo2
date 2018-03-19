<form action="form_back.php" method="POST">
	<div class="row">
		<div class="cols">Title</div>
		<div class="cols">
			<input type="text" name="ftitle" id="ftitle" value="<?php if(isset($row['title'])){echo $row['country_code'];}?>">
		</div>
	</div>
	<div class="row">
		<div class="cols">Synopsis</div>
		<div class="cols">
			<input type="text" name="fsynop" id="fsynop" value="<?php if(isset($row['synopsis'])){echo $row['country_name'];}?>">
			</div>
	</div>
	<div class="row">
		<div class="cols">
			<input type="submit" name="submit" value="submit">
		</div>
		<div class="cols">
			<input type="hidden" name="cid" value="">
		</div>
	</div>
</form>