<?php

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) )
{
  $server_name = $_POST['server_name'];
  $server_user_name = $_POST['server_user_name'];
  $password = $_POST['password'];
  $database_name = $_POST['database_name'];

  $connection = @mysqli_connect($server_name, $server_user_name, $password, $database_name);
  

  if($connection)
  { 

    header('Location: admin_connect.php');
    exit;
  }
  else
  {

    echo '<script>alert("Database Not Connected!")</script>'; 
  }
}
?>



<!DOCTYPE html>
<html>
<head>
	<title>News</title>
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
	        <a class="nav-link" href="#"> <i class="fa fa-sign-in" aria-hidden="true"></i> Sign In </a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#"> <i class="fa fa-user-plus" aria-hidden="true"></i> Register </a>
	      </li>
	    </ul>


	  </div>
	</div>
</nav>

<br>

<div class = "container">

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
      
      <form id="server_login_form" action="news.php" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="server_name">Server Name</label>
            <input type="password" class="form-control" name="server_name" >
          </div>
          <div class="form-group">
            <label for="server_user_name">Server Username</label>
            <input type="password" class="form-control" name="server_user_name">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password">
          </div>
          <div class="form-group">
            <label for="database_name">Database Name</label>
            <input type="password" class="form-control" name="database_name">
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

</div>

<div class="accordion container" id="news-accordion">
 
  <?php

    include("db_connect.php");
    $query = "SELECT * from general_news order by sr_no desc";
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

  <?php } ?>

</div>

</body>
</html>

