<?php
	//$_GET is a global associated array which contains the values that have been passed from the client to the server using the GET method
	//POST is more secure since the entered data does not show up in the URL

	//connect to database
	if(isset($_GET['submit'])){
		if(!empty($_GET['rollNo']) && !empty($_GET['pword'])){
			$conn=mysqli_connect('localhost','raj','pochai@123','student');
			
			//check connection
			if(!$conn){
				echo 'Connection error: '.mysqli_connect_error();
			}

			//write query for all students
			$sql='SELECT * FROM student WHERE roll_no=\''.$_GET['rollNo'].'\' AND pword=\''.$_GET['pword'].'\'';
			//echo $sql.'<br/>';
			
			//make query and get result
			$result=mysqli_query($conn,$sql);

				//fetch the resulting rows as an associated array
				$students=mysqli_fetch_all($result,MYSQLI_ASSOC);
				
				//free result from memory
				mysqli_free_result($result);

				//print_r($students);
			
			//close connection
			mysqli_close($conn);
		}
		else{
			echo 'Invalid Roll Number/password';
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
<title> Log in
</title>
</head>
<body>


<h1>Login Credentials</h1>
<form class="white" action="login.php" method="GET">
	<label> Your Roll Number:</label><br/>
	<input type="text" name="rollNo"/><br/><br/>
	<label>Password:</label><br/>
	<input type="password" name="pword"/><br/><br/>
	<div>
		<input type="submit" name="submit" value="Login">
	</div>
</form>

<small>
<br/>Don't have an account? <a href="signup.php" class="fLink">Sign up</a>
</small>
	
	<?php 
		if(isset($_GET['submit']) && !empty($_GET['rollNo']) && !empty($_GET['pword'])){ 
			if(count($students)==0){
				echo '<br/><br/>'.'Invalid Roll number/password'.'<br/>';
			}
			else{ ?>
				<h4>Student Records</h4>
				<?php
					foreach($students as $student){
						echo $student['roll_no'].' '.$student['name'].' '.$student['dept_name'].' '.$student['dob'].' '.$student['phone_no'].' '.$student['email_id'].'<br/>';
	      				}
				}
		} 
	?>

</body>
</html>
