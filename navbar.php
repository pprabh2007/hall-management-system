<?php
	if (session_id() == '')
		session_start();
?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
	<div class="container">
	  <a class="navbar-brand" href="#"><i class="fa fa-university" aria-hidden="true"></i></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item">
	        <a class="nav-link" href="index.php"> Home <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="about.php"> About </a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="contact.php"> Contact </a>
	      </li>
	    </ul>
	    <ul class="navbar-nav ml-auto">
        <?php
        if (!isset($_SESSION['id']) || !isset($_SESSION['type']) || !isset($_SESSION['hall_code']))
        {
        ?>
  	      <li class="nav-item">
  	        <a class="nav-link" href="login.php"> <i class="fa fa-sign-in" aria-hidden="true"></i> Sign In </a>
  	      </li>
  	      <li class="nav-item">
  	        <a class="nav-link" href="register.php"> <i class="fa fa-user-plus" aria-hidden="true"></i> Register </a>
  	      </li>
        <?php
        }
        else
        {
        ?>
          <li class="nav-item">
  	        <a class="nav-link" href="student_page.php"> <i class="fa fa-user" aria-hidden="true"></i> My Account </a>
  	      </li>
          <li class="nav-item">
  	        <a class="nav-link" href="sign_out.php"> <i class="fa fa-sign-out" aria-hidden="true"></i> Sign Out </a>
  	      </li>
        <?php
        }
        ?>
	    </ul>
	  </div>
	</div>
</nav>
