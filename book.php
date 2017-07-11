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
	$id = $_GET['id'];

	$sql = "SELECT * FROM books, authors WHERE authors.id = books.author_id AND books.author_id = $id";

	$result = mysqli_query($dbc, $sql);

	if($result -> num_rows > 0){
		$book = mysqli_fetch_array($result, MYSQLI_ASSOC);
	} else{
		var_dump("something went wrong");
		die();
	}

	 ?>

	<div id="main">
		<h1>Book</h1>
		<hr>
		<nav>
			<?php require("nav.php") ?>				
		</nav>
		<hr>
		<h2><?= $book['book_title']  ?></h2>
		<h4><?= $book['author_name'] ?></h4>
		<p><?= $book['description'] ?></p>
		<a href="edit.php?id=<?= $book['id']?>">Edit Book</a>
		<a href="delete.php?id=<?= $book['id']?>">Delete Book</a>
	</div>
</body>
</html>