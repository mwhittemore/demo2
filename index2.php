<?php
	include("configuration.php");
	$query="select * from films";
	if(isset($_GET['msg'])){
		echo $_GET['msg'];
	}
?>
<table border="1">
<tr>
<td>No.</td>
<td>Title</td>
<td>Synopsis</td>
</tr>
<?php
	if($resource=mysqli_query($link,$query)){
		$num=1;
		while($rowData=mysqli_fetch_assoc($resource)) {
?>
<tr>
<td><?php echo $num; ?></td>
<td><?php echo $rowData['title'];?></td>
<td><?php echo $rowData['synopsis'];?></td>
<td><a href="form.php?cid=<?php echo $rowData['film_id']; ?>">EDIT</a></td>
<td><a href="delete.php?cid=<?php echo $rowData['film_id']; ?>">DELETE</a></td>
</tr>
<?php
		$num ++;
		}
	}
?>
<tr>
<td colspan="5"><a href="form.php">Search</a></td>
</tr>
</table>