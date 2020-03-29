<?php
	if(isset($_POST['submit']) && !empty($_POST['id']) && !empty($_POST['password']))
	{
		require('db_connect.php');
		$sql = 'SELECT * FROM login_credentials WHERE login_id="'.$_POST['id'].'" AND login_category="'.$_POST['category'].'";';
    if(!($run = mysqli_query($connection,$sql)))
    {
      echo 'query error: '.mysqli_error($connection);
    }


		if ($result = mysqli_fetch_assoc($run))
    {
      if (password_verify($_POST['password'], $result['login_password']))
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
				$_SESSION['tab'] = 'about';
        mysqli_free_result($run);
  			mysqli_close($connection);
  			header('Location: account_home.php');
      }
      else
      {
        echo '<script>alert("Invalid Login Credentials!")</script>';
        mysqli_free_result($run);
  			mysqli_close($connection);
      }
    }
    else
    {
      echo '<script>alert("Invalid Login Credentials!")</script>';
      mysqli_free_result($run);
      mysqli_close($connection);
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
    <?php include('navbar.php'); ?>
    <br>
    <div class = "container">
      <form action="sign_in.php" method="POST">
        <div class="form-group">
        	<label for="id">Roll Number or Employee ID</label>
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
        	<small class="btn" style="padding-left: 1.5rem">
        	  Don't have an account? <a href="register.php" >Register</a>
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
