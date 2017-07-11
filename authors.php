<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Skills17 Conference</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php 

	$dbc = mysqli_connect('localhost', 'root', '', 'bookLibrary');

	$sql = "SELECT * FROM `authors`";

	$result = mysqli_query($dbc, $sql);

	if(!$result){
		var_dump("something went wrong");
	} else {
		// $rows = mysqli_fetch_al($result, MYSQLI_ASSOC);
		$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	}

	 ?>
	<div id="main">
		<h1>Book Library</h1>
		<hr>
		<nav>
			<?php require("nav.php") ?>				
		</nav>
		<hr>
		<?php if($rows): ?>
		<ul>
			<?php foreach ($rows as $row):?>
				<li><?= $row['author_name'] ?></li>
			<?php endforeach; ?>
		</ul>
		<?php else: ?>
			<p>There are currently no Authors</p>
		<?php endif; ?>
	</div>
</body>
</html>