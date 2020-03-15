<?php
  define('CONN_C', TRUE);
  require 'db_connect.php';
  try
	{
		$news_records = array();
		$i = 0;
		$query = 'SELECT * FROM general_news';
		$query_run = $conn->prepare($query);
	  $query_run->execute();
	  while($data = $query_run->fetch(PDO::FETCH_OBJ))
		{
			$news_records[$i] =
			array('news_no'=>$data->news_no, 'title'=>$data->title, 'content'=>$data->content, 'date'=>$data->date);
		  $i++;
		}
		$conn = null;
	}
  catch(PDOException $e)
	{
	  die('<h1>Connection failed!</h1>');
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
	        <a class="nav-link" href="home.php"> About </a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#"> Contact </a>
	      </li>
	    </ul>
	    <ul class="navbar-nav ml-auto">
	      <li class="nav-item">
	        <a class="nav-link" href="home.php"> <i class="fa fa-sign-in" aria-hidden="true"></i> Sign In </a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="home.php"> <i class="fa fa-user-plus" aria-hidden="true"></i> Register </a>
	      </li>
	    </ul>


	  </div>
	</div>
</nav>

<div class="accordion container" id="news-accordion">

  <?php foreach ($news_records as $news) {?>
  <div class="card">
    <div class="card-header" id="<?php echo 'news-head-'.$news['news_no']; ?>">
    	<span class="btn" id="news-head-date"><?php echo $news['date']; ?></span>
        <button class="btn btn-link collapsed" id="news-head-text" type="button" data-toggle="collapse" data-target="<?php echo '#news-'.$news['news_no']; ?>" aria-expanded="false" aria-controls="<?php echo 'news-'.$news['news_no']; ?>">
        <?php echo $news['title']; ?>
        </button>
    </div>
    <div id="<?php echo 'news-'.$news['news_no']; ?>" class="collapse" aria-labelledby="<?php echo 'news-head-'.$news['news_no']; ?>" data-parent="#news-accordion">
      <div class="card-body">
        <?php echo $news['content']; ?>
      </div>
    </div>
  </div>
<?php } ?>

</div>

</body>
</html>
