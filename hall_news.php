<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['type']) || !isset($_SESSION['hall_code']))
  header('Location: index.php');

$id = $_SESSION['id'];
$type = $_SESSION['type'];
$hall_code = $_SESSION['hall_code'];

if ($type == 'Warden')
{
  require('db_connect.php');
  $query = "SELECT position FROM hall_authorities WHERE employee_id = '$id';";
  $run_query = mysqli_query($connection, $query);
  $result = mysqli_fetch_assoc($run_query);
  $issuing_authority = $result['position'].' Warden';
  mysqli_free_result($run_query);
  mysqli_close($connection);
}
else if ($type == 'Hall Council Member')
{
  require('db_connect.php');
  $query = "SELECT portfolio FROM hall_council WHERE roll_no = '$id';";
  $run_query = mysqli_query($connection, $query);
  $result = mysqli_fetch_assoc($run_query);
  $issuing_authority = $result['portfolio'];
  mysqli_free_result($run_query);
  mysqli_close($connection);
}

if($type != 'Boarder' && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) )
{
  require('db_connect.php');
  $title = $_POST['news_title'];
  $content = $_POST['news_content'];

  $query = "INSERT into hall_news (hall_code, date,	title, content,	issuing_auth) VALUES".
  " ('$hall_code', CURDATE(), '$title', '$content', '$issuing_authority')";

  $run_query = mysqli_query($connection, $query);

  if(!$run_query)
  {
    echo '<script>alert("Error!")</script>';
  }
  mysqli_close($connection);
}
header('Location: account_home.php');
?>
