<?php
  session_start();
  if (isset($_POST['tab_name']))
    $_SESSION['tab'] = $_POST['tab_name'];
?>
