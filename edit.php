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
		//you want to check to see if the connection was created and add in failsafe if it doesnt
		if(!$dbc){
			//die kills the php from running
			die('Could not connect to the database');
		}

		if($_POST){
			//turns all of the entires into variables
			extract($_POST);

			//create an array for the errors
			$errors=array();

			if(empty($errors)){
				$title = mysql_escape_string($title);
				$year = mysql_escape_string($year);
				$author = mysql_escape_string($author);
				$description = mysql_escape_string($description);

				$sql ="UPDATE books SET book_title='$title', year_released='$year',author='$author',description='$description' WHERE id = $id";
				$result = mysqli_query($dbc, $sql);
				if($result && mysqli_affected_rows($dbc) > 0){
					header("Location: book.php?id=" . $id);
				} else {
					var_dump("error");
				}				
			}

		} else {
			$id = $_GET['id'];

			$sql = "SELECT * FROM `books1` WHERE id = $id";

			$result = mysqli_query($dbc, $sql);

			if($result -> num_rows > 0){
				$book = mysqli_fetch_array($result, MYSQLI_ASSOC);
			} else{
				var_dump("something went wrong");
				die();
			}
		}

	?>
	<div id="main">
		<h1>Edit Book</h1>
		<hr>
		<nav>
			<?php require("nav.php") ?>		
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
		<form action="edit.php" method="post">
			<input type="hidden" name="id" value="<?= $book['id'] ?>">
			
			<div>
				<label for="title">Book Title</label>
				<input type="text" name="title" class="inputForm" value="<?= $book['book_title'] ?>">
			</div>
			<div>
				<label for="Author">author</label>
				<input type="text" name="author" class="inputForm" value="<?= $book['author'] ?>">
			</div>
			<div>
				<label for="year">Year</label>
				<input type="number" name="year" class="inputForm" value="<?= $book['year_released'] ?>">
			</div>
			<div>
				<label for="description">Description</label>
				<textarea name="description" id="description" cols="30" rows="10"><?= $book['description'] ?></textarea>
			</div>
			<div>
				<input type="submit">
			</div>

		</form>
	</div>
</body>
</html>