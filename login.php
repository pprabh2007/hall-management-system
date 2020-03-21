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
		<option>Boarder</option>
		<option>Hall Council Member</option>
		<option>Warden</option>
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
					$run = mysqli_query($connection, $sql);

					//fetch the resulting rows as an associated array
					$result = mysqli_fetch_all($run,MYSQLI_ASSOC);

					//free result from memory
					mysqli_free_result($run);


					if(count($result)==0)
					{
						echo 'Invalid ID/password';
						//close connection
						mysqli_close($connection);
					}
					else
					{
						if ($_POST['category'] == 'Warden')
						{
							$sql = 'SELECT hall_code from hall_authorities WHERE employee_id = "'.$_POST['id'].'";';
						}
						else
						{
							$sql = 'SELECT * FROM student_data WHERE student_data.roll_no = "'.$_POST['id'].'";';
						}
						$run = mysqli_query($connection, $sql);
						$result = mysqli_fetch_assoc($run);
						session_start();
						$_SESSION['id'] = $_POST['id'];
						$_SESSION['type'] = $_POST['category'];
						$_SESSION['hall_code'] = $result['hall_code'];
						mysqli_close($connection);
						header('Location: complaints.php');
					}
				}
			}
		?>
	</div>
	<div>
		<input type="submit" name="submit" value="Login">
	</div>
</form>

<small>
<br/>Don't have an account? <a href="register.php" class="fLink">Sign up</a>
</small>
</body>
</html>
