<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Skills17 Conference</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

	<?php
		if($_POST){
			//turns all of the entires into variables
			extract($_POST);

			//create an array for the errors
			$errors=array();

			if(!$author){
				array_push($errors, "Please enter a author");
			}

			//once all the fields have been filled out
			if(empty($errors)){
				//connect to the database
				$dbc = mysqli_connect('localhost', 'root', '', 'bookLibrary');
				//you want to check to see if the connection was created and add in failsafe if it doesnt
				if(!$dbc){
					//die kills the php from running
					die('Could not connect to the database');
				}

				$author = mysql_escape_string($author);
				//This is a simple Insert query using the data we have got from the form
				$sql = "INSERT INTO authors VALUES(NULL, '$author')";
				//Run the connection
				$result = mysqli_query($dbc, $sql);
				//Was it successful? if it was then result will = true, othewise false
				if($result && mysqli_affected_rows($dbc) > 0){
					header("Location: authors.php");
				}
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
		<form action="addAuthor.php" method="post">
			<div>
				<label for="Author">Author</label>
				<input type="text" name="author" class="inputForm" value="<?php if(isset($_POST['author'])) { echo $_POST['author'];}?>">
			</div>
			<div>
				<input type="submit">
			</div>

		</form>
	</div>
</body>
</html>