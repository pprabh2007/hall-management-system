<?php

$server_name = 'localhost';
$server_user_name = 'root';
$password = '';
$database_name = 'hms';

try
{
	$connection = mysqli_connect($server_name, $server_user_name, $password, $database_name);

	if($connection)
	{
		echo "database connected!";
	}
}
catch(Exceptiom $e)
{
	echo $e->getMessage();
}

?>