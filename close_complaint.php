<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['type']) || !isset($_SESSION['hall_code']))
  header('Location: index.php');

$id = $_SESSION['id'];
$type = $_SESSION['type'];
$hall_code = $_SESSION['hall_code'];

if($type != "Boarder" && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comp_no']))
{
  require('db_connect.php');
  $complaint_no = $_POST['comp_no'];
  $query = "UPDATE complaints SET status='closed' WHERE complaint_no = $complaint_no;";

  $run_query = mysqli_query($connection, $query);

  if(!$run_query)
  {
    echo '<script>alert("Error!")</script>';
  }
  mysqli_close($connection);
}
?>
