<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['type']) || !isset($_SESSION['hall_code']))
  header('Location: index.php');

$id = $_SESSION['id'];
$type = $_SESSION['type'];
$hall_code = $_SESSION['hall_code'];

if($type == "Warden" && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) )
{
  require('db_connect.php');
  $roll_no = $_POST['roll_no'];
  $portfolio = $_POST['portfolio'];

  if ($_POST['submit'] == 'promote')
  {
    $query = "INSERT into hall_council (roll_no, portfolio, hall_code) VALUES".
    " ('$roll_no', '$portfolio', '$hall_code')";
  }
  else
  {
    $query = "DELETE from hall_council WHERE roll_no='$roll_no' AND portfolio='$portfolio';";
  }

  $run_query = mysqli_query($connection, $query);

  if(!$run_query)
  {
    echo '<script>alert("Error!")</script>';
  }
  mysqli_close($connection);
}
header('Location: account_home.php');
?>
