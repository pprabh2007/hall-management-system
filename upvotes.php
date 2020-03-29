<?php
session_start();
if (isset($_SESSION['id']) && isset($_POST['status']) && isset($_POST['c_no']))
{
  require('db_connect.php');
  if ($_POST['status'] == 'add')
  {
    $sql = "INSERT INTO upvotes(complaint_no, login_id) VALUES($_POST['c_no'], '$_SESSION['id']');"
  }
  else
  {
    $sql = "DELETE FROM upvotes WHERE complaint_no = $_POST['c_no'] AND login_id = '$_SESSION['id']';"
  }
  if(!mysqli_query($connection,$sql))
  {
    echo '<span id="error">An Error Occured!</span>';
  }
}


?>
