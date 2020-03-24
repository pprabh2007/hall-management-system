<!DOCTYPE html>
<html style="height: 100%">
<head>
	<title>Welcome!</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/custom-styles-account-page.css">
	<link rel="stylesheet" type="text/css" href="css/custom-styles-home.css">
	<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/popper.js"></script>

	<script type="text/javascript">
		
		function loadHallNews()
		{
			document.getElementById('hall-news-cover-div').style.display = 'block';
			document.getElementById('hall-about-cover-div').style.display = 'none';
			document.getElementById('hall-complaints-cover-div').style.display = 'none';
		}
		function loadHallAbout()
		{
			document.getElementById('hall-news-cover-div').style.display = 'none';
			document.getElementById('hall-complaints-cover-div').style.display = 'none';
			document.getElementById('hall-about-cover-div').style.display = 'block';
		}
		function loadHallComplaints()
		{
			document.getElementById('hall-news-cover-div').style.display = 'none';
			document.getElementById('hall-about-cover-div').style.display = 'none';
			document.getElementById('hall-complaints-cover-div').style.display = 'block';
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
				<button class="btn btn-link" autofocus onclick="loadHallAbout()">
					About the Hall
				</button>
				<br>	
				<button class="btn btn-link" onclick="loadHallNews()">
					Hall News
				</button>	
				<br>
				<button class="btn btn-link" onclick="loadHallComplaints()">
					View Complaints
				</button>
				<br>
				<button class="btn btn-link" onclick="loadHallNews()">
					Check Status
				</button>
				<br>
				<button class="btn btn-link" onclick="loadHallNews()">
					Useful Contacts
				</button>
			</ul>
		</div>
	</div>

	<div class="col-lg-10 col-sm-9 justify-content-left" id="page-body">
		<div id="hall-news-cover-div" style="display: none;">
				<?php
				session_start();
				if (!isset($_SESSION['id']) || !isset($_SESSION['type']) || !isset($_SESSION['hall_code']))
				  header('Location: home.php');

				$id = $_SESSION['id'];
				$type = $_SESSION['type'];
				$hall_code = $_SESSION['hall_code'];

				if ($type == 'Warden')
				{
				  require('db_connect.php');
				  $query = "SELECT position FROM hall_authorities WHERE employee_id = '$id';";
				  $run_query = mysqli_query($connection, $query);
				  $result = mysqli_fetch_assoc($run_query);
				  $issuing_authority = $result['position'].' Warden';
				  mysqli_free_result($run_query);
				  mysqli_close($connection);
				}
				else if ($type == 'Hall Council Member')
				{
				  require('db_connect.php');
				  $query = "SELECT portfolio FROM hall_council WHERE roll_no = '$id';";
				  $run_query = mysqli_query($connection, $query);
				  $result = mysqli_fetch_assoc($run_query);
				  if ($result['portfolio'] == 'President')
				    $issuing_authority = 'Hall President';
				  else if ($result['portfolio'] == 'SSM')
				    $issuing_authority = 'SSM';
				  else
				    $issuing_authority = 'G.Sec. '.$result['portfolio'];
				  mysqli_free_result($run_query);
				  mysqli_close($connection);
				}

				if($type != 'Boarder' && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) )
				{
				  require('db_connect.php');
				  $title = $_POST['news_title'];
				  $content = $_POST['news_content'];


				  $query = "INSERT into hall_news (hall_code, date,	title, content,	issuing_auth) VALUES".
				  " ('$hall_code', CURDATE(), '$title', '$content', '$issuing_authority')";

				  $run_query = mysqli_query($connection, $query);

				  if($run_query)
				  {
				  }
				  else
				  {
				    echo '<script>alert("Error!")</script>';
				  }
				  mysqli_close($connection);
				}

				if ($type != 'Boarder')
				{
				?>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#server_modal">
				  Edit
				</button>
				<!-- Modal -->
				<div class="modal fade" id="server_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Admin Login</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>

				      <form id="server_login_form" action="hall_news.php" method="post">
				        <div class="modal-body">
				          <div class="form-group">
				            <label for="news_title">Title</label>
				            <input type="text" class="form-control" name="news_title">
				          </div>
				          <div class="form-group">
				            <label for="news_content">Content</label>
				            <textarea class="form-control" name="news_content"></textarea>
				          </div>
				        </div>
				        <div class="modal-footer">
				          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
				        </div>
				      </form>
				    </div>
				  </div>
				</div>
				<?php
				}
				?>
				<div class="accordion" id="news-accordion">

				  <?php
				    require("db_connect.php");
				    $query = "SELECT * FROM hall_news WHERE hall_code='$hall_code' ORDER BY sr_no DESC";  // changing code for hall new
				    $run = mysqli_query($connection, $query);
				    while($result = mysqli_fetch_assoc($run))
				    {
				  ?>
				  <div class="card">
				    <div class="card-header" id="news-head-<?php echo $result['sr_no']; ?>">
				      <span class="btn" id="news-head-date"><?php echo $result['date']; ?></span>
				        <button class="btn btn-link collapsed" id="news-head-text" type="button" data-toggle="collapse" data-target="#news-<?php echo $result['sr_no']; ?>" aria-expanded="true" aria-controls="news-<?php echo $result['sr_no']; ?>">
				          <?php echo $result['title']; ?>
				        </button>
				    </div>
				    <div id="news-<?php echo $result['sr_no']; ?>" class="collapse" aria-labelledby="news-head-<?php echo $result['sr_no']; ?>" data-parent="#news-accordion">
				      <div class="card-body">
				        <?php echo $result['content']; ?>
				      </div>
				    </div>
				  </div>

				  <?php
				    }
				    mysqli_free_result($run);
				    mysqli_close($connection);
				  ?>
				</div>
		</div>
		<div id="hall-about-cover-div">
				<p>
					Bacon ipsum dolor amet drumstick beef ribs prosciutto porchetta meatball doner ham hamburger pastrami jowl, fatback jerky picanha. Buffalo tail flank ribeye turducken ham hock boudin jerky picanha short ribs. Bacon alcatra kielbasa swine doner rump jowl ground round brisket tenderloin andouille beef ribs turducken burgdoggen. Pastrami turkey shank, chislic cupim capicola sausage pancetta. Capicola turkey landjaeger porchetta filet mignon strip steak.

				</p>
		</div>

		<div id="hall-complaints-cover-div" style="display: none;">
				<?php
	
				$id = $_SESSION['id'];
				$type = $_SESSION['type'];
				$hall_code = $_SESSION['hall_code'];

				if($type != "Warden" && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) )
				{
				  require('db_connect.php');
				  $category = $_POST['complaint_category'];
				  $title = $_POST['complaint_title'];
				  $content = $_POST['complaint_content'];

				  $query = "INSERT into complaints (complaint_title, category, content, date, roll_no, hall_code) VALUES".
				  " ('$title', '$category', '$content', CURDATE(), '$id', '$hall_code')";

				  $run_query = mysqli_query($connection, $query);

				  if($run_query)
				  {
				  }
				  else
				  {
				    echo '<script>alert("Error!")</script>';
				  }
				  mysqli_close($connection);
				}

				if ($type != "Warden")
				{
				?>
				<div class = "container">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#server_modal">
				  Register a Complaint
				</button>
				<!-- Modal -->
				<div class="modal fade" id="server_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Add Complaint</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <form id="server_login_form" action="complaints.php" method="post">
				        <div class="modal-body">
				          <div class="form-group">
				            <label for="complaint_category">Category</label>
				            <select class="form-control" name="complaint_category">
				              <option>Sports</option>
				              <option>Maintenance</option>
				              <option>Mess</option>
				              <option>So-Cult</option>
				            </select>
				          </div>
				          <div class="form-group">
				            <label for="complaint_title">Title</label>
				            <input type="text" class="form-control" name="complaint_title">
				          </div>
				          <div class="form-group">
				            <label for="complaint_content">Content</label>
				            <textarea class="form-control" name="complaint_content"></textarea>
				          </div>
				        </div>

				        <div class="modal-footer">
				          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
				        </div>
				      </form>
				    </div>
				  </div>
				</div>
				<!---->
				</div>
				<?php
				}
				?>
				<div class="accordion container" id="news-accordion">

				  <?php

				    require("db_connect.php");
				    $query = "SELECT * from complaints WHERE hall_code = '$hall_code' order by no_of_upvotes desc";
				    $run = mysqli_query($connection, $query);
				    while($result = mysqli_fetch_assoc($run))
				    {

				  ?>
				  <div class="card">
				    <div class="card-header" id="news-head-<?php echo $result['complaint_no']; ?>">
				      <span class="btn" id="news-head-date"><?php echo $result['date']; ?></span>
				        <button class="btn btn-link collapsed" id="news-head-text" type="button" data-toggle="collapse" data-target="#news-<?php echo $result['complaint_no']; ?>" aria-expanded="true" aria-controls="news-<?php echo $result['complaint_no']; ?>">
				          <?php echo $result['complaint_title']; ?>
				        </button>
				    </div>
				    <div id="news-<?php echo $result['complaint_no']; ?>" class="collapse" aria-labelledby="news-head-<?php echo $result['complaint_no']; ?>" data-parent="#news-accordion">
				      <div class="card-body">
				        <?php echo $result['content']; ?>
				      </div>
				    </div>
				  </div>
				  <?php
				    }
				    mysqli_free_result($run);
				    mysqli_close($connection);
				  ?>
				</div>
		</div>

	</div>
</div>

</body>
</html>
