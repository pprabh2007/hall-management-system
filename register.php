 <?php
	if(isset($_POST['submit']))
	{
		require('db_connect.php');
		if($_POST['reg-password'] === $_POST['reg-confirm-password'])
		{
			$login_id = $_POST['reg-roll-no'];
			$login_cat = $_POST['reg-category'];
			$login_pword = $_POST['reg-password'];
			$sql = "INSERT INTO login_credentials(login_id,login_category,login_password) VALUES('$login_id','$login_cat','$login_pword')";
			if(mysqli_query($connection,$sql))
			{
			}
			else{
				echo 'query error: '.mysqli_error($connection);
			}
			$name=$_POST['reg-name'];
			$hall=$_POST['reg-hall'];
			$email=$_POST['reg-email'];
			if($_POST['reg-category']==='Boarder')
			{
				$dob=$_POST['reg-dob'];
				$dept=$_POST['reg-branch'];
				$sql="INSERT INTO student_data(roll_no,name,branch_code,date_of_birth,email_id,hall_code) VALUES('$login_id','$name','$dept','$dob','$email','$hall')";
				if(mysqli_query($connection,$sql))
				{
				}
				else{
					echo 'query error: '.mysqli_error($connection);
				}
			}
			else if($_POST['reg-category']==='Warden')
			{
				$pos=$_POST['reg-position'];
				$doa=$_POST['reg-doa'];
				$sql="INSERT INTO hall_authorities(employee_id,name,position,date_of_appointment,email_id,hall_code) VALUES('$login_id','$name','$pos','$doa','$email','$hall')";

				if(mysqli_query($connection,$sql)){
				}
				else{
					echo 'query error: '.mysqli_error($connection);
				}
			}
			else if($_POST['reg-category']==='Hall Council Member')
			{
				$dob=$_POST['reg-dob'];
				$dept=$_POST['reg-branch'];
				$post=$_POST['reg-portfolio'];

				$sql="INSERT INTO student_data(roll_no,name,branch_code,date_of_birth,email_id,hall_code) VALUES('$login_id','$name','$dept','$dob','$email','$hall')";

				if(mysqli_query($connection,$sql)){
				}
				else{
					echo 'query error: '.mysqli_error($connection);
				}

				$sql="INSERT INTO hall_council(roll_no,portfolio,hall_code) VALUES('$login_id','$post','$hall')";

				if(mysqli_query($connection,$sql)){
				}
				else{
					echo 'query error: '.mysqli_error($connection);
				}

			}

			$i = 0;
			while(isset($_POST[strval($i)]))
			{
				$number_i=$_POST[strval($i)];
				$sql = "INSERT INTO contact_details(login_id, phone_number) VALUES('$login_id', '$number_i')";
				mysqli_query($connection,$sql);
				$i = $i + 1;
			}

    		mysqli_close($connection);
		}
		else {
				echo '<script>alert("Passwords donot match !!")</script>';
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

	<script>
		var today = new Date();
		var i = 0;
		window.onload = function()
		{
			var dd = today.getDate();
			var mm = today.getMonth()+1;
			var yyyy = today.getFullYear();
			if(dd < 10)
				dd = '0'+dd;
			if(mm<10)
				mm = '0'+mm;
			today = yyyy+'-'+mm+'-'+dd;
			document.getElementById('reg-category').selectedIndex = "0";
		}
		function getOptions()
		{
			var cat = document.getElementById('reg-category').value;
			if(cat=='Boarder')
			{
				document.getElementById('reg-portfolio-div').style.display = 'none';
				document.getElementById('reg-position-div').style.display = 'none';
				document.getElementById('reg-doa-div').style.display = 'none';
				document.getElementById('reg-branch-div').style.display = 'block';
				document.getElementById('reg-dob-div').style.display = 'block';
			}
			else if(cat=='Warden')
			{
				document.getElementById('reg-portfolio-div').style.display = 'none';
				document.getElementById('reg-branch-div').style.display = 'none';
				document.getElementById('reg-dob-div').style.display = 'none';
				document.getElementById('reg-position-div').style.display = 'block';
				document.getElementById('reg-doa-div').style.display = 'block';
				document.getElementById("reg-doa").setAttribute("max", today);
			}
			else
			{
				document.getElementById('reg-position-div').style.display = 'none';
				document.getElementById('reg-doa-div').style.display = 'none';
				document.getElementById('reg-portfolio-div').style.display = 'block';
				document.getElementById('reg-branch-div').style.display = 'block';
				document.getElementById('reg-dob-div').style.display = 'block';
			}
		}
		function val_change()
		{
			add_elem = document.getElementById('add');
			if(document.getElementById(i).value.length==0)
			{
				add_elem.disabled=true;
			}
			else
			{
				add_elem.disabled=false;
			}
		}
		function addAnother()
		{
			i++;
			var temp = document.getElementsByClassName('phone-number')[0].cloneNode();
			temp.id = i;
			temp.name = i;
			temp.value='';
			document.getElementById('phone-number-fields').appendChild(temp);
			document.getElementById('add').disabled=true;
			if(i>0)
			{
				document.getElementById('minus').disabled = false;
				document.getElementById('minus').style.display = 'block';
			}
		}

		function deleteLast()
		{
			document.getElementById(i).remove();
			i--;

			if(i==0)
			{
				document.getElementById('minus').disabled = true;
				document.getElementById('minus').style.display='none';
			}
		}

		function checkPass()
		{
			
			var p1 = document.getElementById('reg-password').value;
			var p2 = document.getElementById('reg-confirm-password').value;

			if(p1.length==0 || p2.length==0)
			{
			}
			else if (p1===p2)
			{
				document.getElementById('form-submit').disabled=false;
			}
			else
			{
				document.getElementById('form-submit').disabled=true;
				document.getElementById('form-submit').title="Passwords do not match!";
			}
		}
		

	</script>
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
	        <a class="nav-link" href="login.php"> <i class="fa fa-sign-in" aria-hidden="true"></i> Sign In </a>
	      </li>
	    </ul>
	  </div>
	</div>
</nav>
<br>
<div class = "container">
<form action="register.php" method="POST">
  <div class="form-group">
    <label for="reg-name">Name</label>
    <input type="text" class="form-control" id="reg-name" name="reg-name" required="required">
  </div>
  <div class="form-group">
    <label for="reg-email">Email address</label>
    <input type="email" class="form-control" id="reg-email" name="reg-email" required="required">
  </div>
  <div class="form-group">
    <label for="reg-password">Password</label>
    <input type="password" class="form-control" id="reg-password" onblur="checkPass()" name="reg-password" required="required">
  </div>
  <div class="form-group">
    <label for="reg-confirm-password">Confirm Password</label>
    <input type="password" class="form-control" id="reg-confirm-password" onblur="checkPass()" name="reg-confirm-password" required="required">
  </div>
  <div class="form-group">
    <label for="reg-hall">Hall of Residence</label>
    <select class="form-control" id="reg-hall" name="reg-hall">
    <option>RP</option>
    <option>RK</option>
		<option>LBS</option>
    <option>AZ</option>
		<option>NH</option>
    <option>BRH</option>
    </select>
  </div>
  <div class="form-group">
  	<label for="reg-roll-no">Roll Number or Employment ID</label>
  	<input type="text" class="form-control" id="reg-roll-no" name="reg-roll-no" required="required">
  </div>
  
  <div class="form-group" id="phone-numbers">
  	<label for="0">Phone Number(s)</label>
  	<div class="row align-items-end">
  		<div class="col-10" id="phone-number-fields">
  			<input type="text" class="form-control phone-number" value="" onkeypress="val_change()" onblur="val_change()" id="0" name="0" required="required">
  		</div>
  		<div class="col-2">
  			<button type="button" class="btn btn-link" id="minus" onclick="deleteLast()"><i class="fa fa-minus fa-lg"></i></button>
  		</div>
  	</div>
  	<button type="button" class="btn btn-success" disabled id="add" onclick="addAnother()">Add Another</button>
  </div>

  <div class="form-group">
	  <label for="reg-category">Category</label>
	  <select class="form-control" id="reg-category" name="reg-category" onchange="getOptions()" >
	  <option>Boarder</option>
	  <option>Hall Council Member</option>
	  <option>Warden</option>
	  </select>
  </div>
	<!-- HCM -->
  <div class="form-group" id="reg-portfolio-div" style="display: none">
	  <label for="reg-portfolio">Portfolio</label>
	  <select class="form-control" id="reg-portfolio" name="reg-portfolio">
	  <option>Maintenance</option>
	  <option>President</option>
	  <option>Welfare</option>
	  </select>
  </div>
	<!-- Border and HCM -->
  <div class="form-group" id="reg-dob-div">
    <label for="reg-dob">Date of Birth</label>
    <input type="date" class="form-control" id="reg-dob" name="reg-dob" min="1990-01-01" max="2010-12-31" value="1990-01-01">
  </div>
  <div  class="form-group" id="reg-branch-div">
	  <label for="reg-branch">Branch</label>
	  <select class="form-control" id="reg-branch" name="reg-branch">
	  <option value="AE">Aerospace Engineering</option>
	  <option value="AG">Agricultural and Food Engineering</option>
	  <option value="AH">Architecture and Regional Planning</option>
	  <option value="BS">Bio Science</option>
	  <option value="BT">Biotechnology</option>
	  <option value="CH">Chemical Engineering</option>
	  <option value="CY">Chemistry</option>
	  <option value="CE">Civil Engineering</option>
	  <option value="CS">Computer Science and Engineering</option>
	  <option value="EE">Electrical Engineering</option>
	  <option value="EC">Electronics and Electrical Communication Engineering</option>
	  <option value="GG">Geology and Geophysics</option>
	  <option value="HS">Humanities and Social Sciences</option>
	  <option value="IM">Industrial and Systems Engineering</option>
	  <option value="MA">Mathematics</option>
	  <option value="ME">Mechanical Engineering</option>
	  <option value="MT">Metallurgical and Materials Engineering</option>
	  <option value="MI">Mining Engineering</option>
	  <option value="NA">Ocean Engineering and Naval Architecture</option>
	  <option value="PH">Physics</option>
	  </select>
  </div>
	<!-- Warden -->
	<div class="form-group" id="reg-position-div" style="display: none">
	  <label for="reg-position-div">Position</label>
	  <select class="form-control" id="reg-position" name="reg-position">
	  <option>Chief</option>
	  <option>Deputy</option>
	  <option>Assistant</option>
	  </select>
    </div>
	<div class="form-group" id="reg-doa-div" style="display: none">
	    <label for="reg-doa">Date of Appointment</label>
	    <input type="date" class="form-control" id="reg-doa" name="reg-doa" min="1990-01-01" value="1990-01-01">
    </div>
  	<br>
    <div>
		<input class="btn btn-primary" title="" id="form-submit" type="submit" name="submit" value="Register">
		<small class="btn" style="padding-left: 1.5rem">Already have an account? <a href="login.php" >Log In</a>
	</div>
  
  </small>
  <br>
  <br>
  <br>
  <br>
</form>
</div>
</body>
</html>
