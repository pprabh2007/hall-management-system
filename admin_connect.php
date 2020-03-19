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
 
  <div class="card">
    <div class="card-header" id="news-head-1">
      <span class="btn" id="news-head-date">24/02/2017</span>
        <button class="btn btn-link collapsed" id="news-head-text" type="button" data-toggle="collapse" data-target="#news-1" aria-expanded="true" aria-controls="news-1">
          Notice about change of Halls
        </button>
    </div>
    <div id="news-1" class="collapse" aria-labelledby="news-head-1" data-parent="#news-accordion">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="news-head-2">
      <span class="btn" id="news-head-date">24/02/2017</span>
        <button class="btn btn-link collapsed" id="news-head-text" type="button" data-toggle="collapse" data-target="#news-2" aria-expanded="false" aria-controls="news-2">
         Notice about allowance of girls in night canteens
        </button>
    </div>
    <div id="news-2" class="collapse" aria-labelledby="news-head-2" data-parent="#news-accordion">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="news-head-3">
      <span class="btn" id="news-head-date">24/02/2017</span>
        <button class="btn btn-link collapsed" id="news-head-text" type="button" data-toggle="collapse" data-target="#news-3" aria-expanded="false" aria-controls="news-3">
          Notice about coronavirus epidemic
        </button>
    </div>
    <div id="news-3" class="collapse" aria-labelledby="news-head-3" data-parent="#news-accordion">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>

</div>

</body>
</html>