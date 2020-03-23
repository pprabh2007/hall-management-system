<!DOCTYPE html>
<html style="height: 100%">
<head>
	<title>Welcome!</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/custom-styles-account-page.css">
	<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/popper.js"></script>

	<script type="text/javascript">
		
		function loadHallNews()
		{
			document.getElementById('page-body').src = 'hall_news.php';
		}
		function loadHallAbout()
		{
			document.getElementById('page-body').src = 'about_hall.php';
		}

	</script>

</head>

<body style="height: 100%">


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
	        <a class="nav-link" href="logout.php"> <i class="fa fa-user" aria-hidden="true"></i> Logout </a>
	      </li>
	    </ul>


	  </div>
	</div>
</nav>

<div class="row" style="height: 100%" id="main-div">
<div class="col-lg-2 col-sm-3 justify-content-center" >

	<div id="option-bar">
		<ul class="option-bar-list list-unstyled">
			<button class="btn btn-link" onclick="loadHallAbout()">
				About the Hall
			</button>	
			<button class="btn btn-link" onclick="loadHallNews()">
				Hall News
			</button>	
			<li>
				<a href="complaints.php">View Complaints</a>
			</li>
			<li>
				<a href="complaints.php">Check Status</a>
			</li>
			<li>
				<a href="complaints.php">Useful Contacts</a>
			</li>	
		</ul>
	</div>

</div>

<div class="col-lg-10 col-sm-9 justify-content-left">
	<iframe id="page-body" frameBorder="0" style="height:100%; width: 100%;">	</iframe>
</div>
</div>




</body>
</html>
