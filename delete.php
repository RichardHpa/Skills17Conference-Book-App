<?php 
$id = $_GET['id'];

$dbc = mysqli_connect('localhost', 'root', '', 'bookLibrary');
//you want to check to see if the connection was created and add in failsafe if it doesnt
if(!$dbc){
	//die kills the php from running
	die('Could not connect to the database');
}

$sql = "DELETE FROM books WHERE id = $id";

$result = mysqli_query($dbc, $sql);

header("Location: index.php");



 ?>