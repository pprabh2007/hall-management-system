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

		function getOptions()
		{
			var cat = document.getElementById('reg-category').value;
			if(cat=='Boarder')
			{
				document.getElementById('reg-portfolio-div').style.display = 'none';
				document.getElementById('reg-branch-div').style.display = 'block';
				document.getElementById('reg-dob-div').style.display = 'block';
			}
			else if(cat=='Warden')
			{
				document.getElementById('reg-portfolio-div').style.display = 'none';
				document.getElementById('reg-branch-div').style.display = 'none';
				document.getElementById('reg-dob-div').style.display = 'none';
			}
			else
			{
				document.getElementById('reg-portfolio-div').style.display = 'block';
				document.getElementById('reg-branch-div').style.display = 'block';
				document.getElementById('reg-dob-div').style.display = 'block';
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

<form method="get">
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
    <input type="password" class="form-control" id="reg-password" name="reg-password" required="required">
  </div>
  <div class="form-group">
    <label for="reg-confirm-password">Confirm Password</label>
    <input type="password" class="form-control" id="reg-confirm-password" name="reg-confirm-password" required="required">
  </div>
  <div class="form-group">
    <label for="reg-hall">Hall of Residence</label>
    <select class="form-control" id="reg-hall" name="reg-hall">
    <option>RP</option>
    <option>RK</option>
    </select>
  </div>

 
  <div class="form-group">
  <label for="reg-roll-no">Roll Number or Employment ID</label>
  <input type="text" class="form-control" id="reg-roll-no" name="reg-roll-no" required="required">
  </div>

  <div class="form-group">
	  <label for="reg-category">Category</label>
	  <select class="form-control" id="reg-category" name="reg-category" onchange="getOptions()" >
	  <option>Boarder</option>
	  <option>Council</option>
	  <option>Warden</option>
	  </select>
  </div>

  <div class="form-group" id="reg-portfolio-div" style="display: none">
	  <label for="reg-portfolio">Portfolio</label>
	  <select class="form-control" id="reg-portfolio" name="reg-portfolio">
	  <option>Maintenance</option>
	  <option>President</option>
	  <option>Welfare</option>
	  </select>
  </div>
  
  <div class="form-group" id="reg-dob-div">
    <label for="reg-dob">Date of Birth</label>
    <input type="date" class="form-control" id="reg-dob" name="reg-dob" min="1990-01-01" max="2010-12-31" >
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
  <br>
  <button type="submit" class="btn btn-primary">Register</button>
  <small style="padding-left: 20px">
	Already have an account? <a href="login.php" >Log In</a>
  </small>
  <br>
  <br>
  <br>
  <br>
  
</form>

</div>


</body>

</html>