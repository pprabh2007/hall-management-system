<?php
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) )
{

  $temp_title = $_POST['title'];
  $temp_content = $_POST['content'];
  $query = "INSERT into general_news (date, title, content) VALUES (CURDATE(), '$temp_title', '$temp_content')";
  //echo $query;


  include('db_connect.php');

  $run_query = mysqli_query($connection, $query);

  if($run_query)
  {
    echo '<script>alert("Published!")</script>'; 
  }
  else
  {
    echo '<script>alert("Error!")</script>'; 
  }

  mysqli_close($connection);

  header('Location: admin_connect.php');

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
  
    </div>
  </div>
</nav>

<br>

<div class = "container">

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_news_modal">
  Add 
</button>

<!-- Modal -->
<div class="modal fade" id="add_news_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Notice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form id="add_news_form" action="admin_connect.php" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" >
          </div>
          <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" name="content" rows="5  "></textarea>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" onchange="document.getElementById('submit').disabled = !this.checked;">
            <label class="form-check-label" for="confirm">I understand that I will not be able to delete this information later</label>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="submit" disabled="true" class="btn btn-primary" name="submit">Publish</button>
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