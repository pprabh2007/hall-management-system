<?php
	if(isset($_POST['submit']) && !empty($_POST['id']) && !empty($_POST['password']))
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
			echo '<script>alert("Invalid Login Credentials!")</script>';
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
			header('Location: student_page.php');
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome!</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/custom-styles-home.css">
	<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/popper.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
	<div class="container">
	  <a class="navbar-brand" href="#"><i class="fa fa-university" aria-hidden="true"></i></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item">
	        <a class="nav-link" href="home.php"> Home <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#"> About </a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#"> Contact </a>
	      </li>
	    </ul>
	    <ul class="navbar-nav ml-auto">
	      <li class="nav-item">
	        <a class="nav-link" href="register.php"> <i class="fa fa-user-plus" aria-hidden="true"></i> Register </a>
	      </li>
	    </ul>
	  </div>
	</div>
</nav>
<br>
<div class = "container">
<form action="login.php" method="POST">
  <div class="form-group">
  	<label for="id">Roll Number or Employmen ID</label>
  	<input type="text" class="form-control" id="id" name="id" required="required">
  </div>
  <div class="form-group">
	  <label for="category">Category</label>
	  <select class="form-control" id="category" name="category">
	  <option>Boarder</option>
	  <option>Hall Council Member</option>
	  <option>Warden</option>
	  </select>
  </div>
	<div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" required="required">
  </div>
  <br>
  <div >
		<input class="btn btn-primary" type="submit" name="submit" value="Sign in">
	
	<small style="padding-left: 20px">
	Already have an account? <a href="login.php" >Log In</a>
  	</small>	
  </div>
  <br>
  <br>
  <br>
  <br>
</form>
</div>
</body>
</html>
