<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['type']) || !isset($_SESSION['hall_code']))
  header('Location: index.php');

	$id = $_SESSION['id'];
	$type = $_SESSION['type'];
	$hall_code = $_SESSION['hall_code'];
	$temp = $_POST['comp_no'];


	require('db_connect.php');
	$query = "SELECT * FROM upvotes WHERE roll_no='$id' and complaint_id=$temp";
	$run = mysqli_query($connection, $query);
	$row_cnt = mysqli_num_rows($run);

	if($row_cnt == 0)
	{
		$query = "INSERT INTO upvotes(roll_no, complaint_id) VALUES ('$id', $temp)";
		$run = mysqli_query($connection, $query);
		$query = "UPDATE complaints set no_of_upvotes = no_of_upvotes + 1 where complaint_no=$temp";
		$run = mysqli_query($connection, $query);
		echo "1";
	}
	else
	{
		$query = "DELETE FROM upvotes WHERE roll_no='$id' and complaint_id=$temp";
		$run = mysqli_query($connection, $query);
		$query = "UPDATE complaints set no_of_upvotes = no_of_upvotes - 1 where complaint_no=$temp";
		$run = mysqli_query($connection, $query);
		echo "0";
	}

	mysqli_close($connection);

?>