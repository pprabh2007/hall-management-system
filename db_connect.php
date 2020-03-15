<?php
  if(!defined('CONN_C'))
  	die('<h1>Direct Access Denied.</h1>');
  $mysql_host = 'localhost';
  $mysql_user = 'root';
  $mysql_pword = '';
  $mysql_db = 'hall_management_db';
  $conn = null;
  $query = '';
  $query_run = null;
  $data = null;
  try
  {
  	$conn = new PDO('mysql:host='.$mysql_host.';dbname='.$mysql_db, $mysql_user,$mysql_pword);
  	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e)
  {
  	die('<h1>Connection failed!</h1>');
  }
?>
