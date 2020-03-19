<!DOCTYPE html>
<html>
<head>
<title> Log in
</title>
</head>
<body>


<h1>Login Credentials</h1>
<form class="white" action="login.php" method="POST">
	<label>Login ID:</label><br/>
	<input type="text" name="id"/><br/><br/>
	<label>Type:</label><br/>
	<select type="text" name="category"/>
		<option value="STUDENT">Student</option>
		<option value="HCM">Hall Council Member</option>
		<option value="WARDEN">Warden</option>
	</select>
	<br/><br/>
	<label>Password:</label><br/>
	<input type="password" name="password"/><br/><br/>
	<div>
		<?php
			if(isset($_POST['submit']))
			{
				if(!empty($_POST['id']) && !empty($_POST['password']))
				{
					require('db_connect.php');

					//write query for all students
					$sql = 'SELECT * FROM login_credentials WHERE login_id=\''.$_POST['id'].'\' AND login_password=\''.$_POST['password'].
					'\' AND login_category=\''.$_POST['category'].'\'';

					//make query and post result
					$result = mysqli_query($connection, $sql);

					//fetch the resulting rows as an associated array
					$records = mysqli_fetch_all($result,MYSQLI_ASSOC);

					//free result from memory
					mysqli_free_result($result);

					//close connection
					mysqli_close($connection);

					if(count($records)==0)
					{
						echo 'Invalid ID/password';
					}
					else
					{
						echo 'Success';
					}
				}
				else
				{
					echo 'All fields are mandatory.';
				}
			}
		?>
	</div>
	<div>
		<input type="submit" name="submit" value="Login">
	</div>
</form>

<small>
<br/>Don't have an account? <a href="signup.php" class="fLink">Sign up</a>
</small>
</body>
</html>
