<?php

$server_name = 'localhost';
$server_user_name = 'root';
$password = '';
$database_name = 'hms_db';

try
{
	$connection = mysqli_connect($server_name, $server_user_name, $password, $database_name);
}
catch(Exceptiom $e)
{
	echo $e->getMessage();
}

?>
