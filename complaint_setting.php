<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['type']) || !isset($_SESSION['hall_code']))
  header('Location: index.php');

$id = $_SESSION['id'];
$type = $_SESSION['type'];
$hall_code = $_SESSION['hall_code'];

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) && isset($_POST['comp_order']) && isset($_POST['comp_type']))
{
  $_SESSION['comp_order'] = $_POST['comp_order'];
  $_SESSION['comp_type'] = $_POST['comp_type'];
}
header('Location: account_home.php');
?>
