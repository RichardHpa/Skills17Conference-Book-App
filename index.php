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

	$sql = "SELECT * FROM books INNER JOIN authors ON books.author_id=authors.id;";

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
			<table>
				<thead>
					<tr>
						<td>Title</td>
						<td>Author</td>
						<td>Descriptions</td>
						<td>Year Released</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($rows as $row):?>
						<tr>
							<td><a href="book.php?id=<?= $row['id'] ?>"><?= $row['book_title'] ?></a></td>
							<td><?= $row['author_name'] ?></td>
							<td><?= substr($row['description'], 0, 100) ?>...</td>

							<td><?= $row['year_released'] ?></td>
						</tr>
					
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php else: ?>
			<p>There are currently no books</p>
		<?php endif; ?>
	</div>
</body>
</html>