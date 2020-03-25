<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['type']) || !isset($_SESSION['hall_code']))
  header('Location: index.php');

$id = $_SESSION['id'];
$type = $_SESSION['type'];
$hall_code = $_SESSION['hall_code'];

if($type != "Warden" && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) )
{
  require('db_connect.php');
  $category = $_POST['complaint_category'];
  $title = $_POST['complaint_title'];
  $content = $_POST['complaint_content'];

  $query = "INSERT into complaints (complaint_title, category, content, date, roll_no, hall_code) VALUES".
  " ('$title', '$category', '$content', CURDATE(), '$id', '$hall_code')";

  $run_query = mysqli_query($connection, $query);

  if(!$run_query)
  {
    echo '<script>alert("Error!")</script>';
  }
  mysqli_close($connection);
}
header('Location: student_page.php');
?>
