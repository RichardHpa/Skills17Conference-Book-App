<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Skills17 Conference</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

	<?php

		//connect to the database
		$dbc = mysqli_connect('localhost', 'root', '', 'bookLibrary');
		//you want to check to see if the connection was created and add in failsafe if it doesnt
		if(!$dbc){
			//die kills the php from running
			die('Could not connect to the database');
		}

		$valid = false;
		if($_POST){
			//turns all of the entires into variables
			extract($_POST);

			//create an array for the errors
			$errors=array();

			if(!$title){
				$errors[] = 'Please enter a book title';
			} else if(strlen($title) < 10){
				$errors[] = 'Title must be more than 10 characters';
			}

			if(!$author){
				array_push($errors, "Please enter a author");
			}
			if(!$year){
				array_push($errors, "Please enter a year of release");
			}
			if(!$description){
				array_push($errors, "Please enter description of book");
			}

			//once all the fields have been filled out
			if(empty($errors)){
	
				$title = mysql_escape_string($title);
				$year = mysql_escape_string($year);
				$author = mysql_escape_string($author);
				$description = mysql_escape_string($description);
				//This is a simple Insert query using the data we have got from the form
				$sql = "INSERT INTO books VALUES(NULL, '$title', '$year', '$description', '$author')";

				//Run the connection
				$result = mysqli_query($dbc, $sql);
				//Was it successful? if it was then result will = true, othewise false
				if($result && mysqli_affected_rows($dbc) > 0){
					var_dump("success");
					$last_id = $dbc->insert_id;
					header("Location: book.php?id=" . $last_id);
				} else {
					var_dump("error");
				}
			}

		} else {
			$sql = "SELECT * FROM `authors`";

			$result = mysqli_query($dbc, $sql);

			if(!$result){
				var_dump("something went wrong");
			} else {
				// $rows = mysqli_fetch_al($result, MYSQLI_ASSOC);
				$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
			}
		}



	 ?>
	<div id="main">
		<h1>Add Book</h1>
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
		<form action="add.php" method="post">
			
			<div>
				<label for="title">Book Title</label>
				<input type="text" name="title" class="inputForm" value="<?php if(isset($_POST['title'])) { echo $_POST['title'];}?>">
			</div>
			<div>
				<label for="Author">Author</label>
				<select name="author">
					<option value="">Please choose an Author</option>
					<?php foreach ($rows as $row): ?>
						<option value="<?= $row['id']?>"><?= $row['author_name']?></option>
					<?php endforeach ?>
				</select>
			</div>
			<div>
				<label for="year">Year</label>
				<input type="number" name="year" class="inputForm" value="<?php if(isset($_POST['year'])) { echo $_POST['year'];}?>">
			</div>
			<div>
				<label for="description">Description</label>
				<textarea name="description" id="description" cols="30" rows="10"><?php if(isset($_POST['description'])) { echo $_POST['description'];}?></textarea>
			</div>
			<div>
				<input type="submit">
			</div>

		</form>
	</div>
</body>
</html>