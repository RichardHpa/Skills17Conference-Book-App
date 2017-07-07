<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Skills17 Conference</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

	<?php
		$valid = false;
		if($_POST){
			extract($_POST);
			// var_dump($title);
			// var_dump($director);
			// var_dump($year);

			$errors=array();

			if(!$title){
				$errors[] = 'Please enter a first name';
			}
			if(!$director){
				array_push($errors, "please entire a Director");
			}
			if(!$year){
				array_push($errors, "please entire a Year");
			}

			if(empty($errors)){
				var_dump("everyhing is valid");
			}

		}



	 ?>
	<div id="main">
		<h1>Add Movies</h1>
		<hr>
		<nav>
			<ul>
				<li><a href="index.php">View Movies</a></li>
				<li><a href="add.php">Add Movies</a></li>
			</ul>			
		</nav>
		<hr>
		<?php if($_POST): ?>
		<div class="errors">
			<ul>
				<?php foreach ($errors as $error):?>
					<li><?= $error ?></li>
				<?php endforeach; ?>		
			</ul>
		</div>
		<?php endif; ?>
		<form action="add.php" method="post">
			
			<div>
				<label for="title">Movie Title</label>
				<input type="text" name="title" class="inputForm" value="<?php if(isset($_POST['title'])) { echo $_POST['title'];}?>">
			</div>
			<div>
				<label for="director">Director</label>
				<input type="text" name="director" class="inputForm" value="<?php if(isset($_POST['director'])) { echo $_POST['director'];}?>">
			</div>
			<div>
				<label for="year">Year</label>
				<input type="number" name="year" class="inputForm" value="<?php if(isset($_POST['year'])) { echo $_POST['year'];}?>">
			</div>
			<div>
				<input type="submit">
			</div>

		</form>
	</div>
</body>
</html>