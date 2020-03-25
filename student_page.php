<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['type']) || !isset($_SESSION['hall_code']))
  header('Location: index.php');

$id = $_SESSION['id'];
$type = $_SESSION['type'];
$hall_code = $_SESSION['hall_code'];

?>
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
        document.getElementById('hall-contacts-cover-div').style.display = 'none';
        document.getElementById('hall-status-cover-div').style.display = 'none';
      }
      function loadHallAbout()
      {
        document.getElementById('hall-news-cover-div').style.display = 'none';
        document.getElementById('hall-complaints-cover-div').style.display = 'none';
        document.getElementById('hall-about-cover-div').style.display = 'block';
        document.getElementById('hall-contacts-cover-div').style.display = 'none';
        document.getElementById('hall-status-cover-div').style.display = 'none';
      }
      function loadHallComplaints()
      {
        document.getElementById('hall-news-cover-div').style.display = 'none';
        document.getElementById('hall-about-cover-div').style.display = 'none';
        document.getElementById('hall-contacts-cover-div').style.display = 'none';
        document.getElementById('hall-complaints-cover-div').style.display = 'block';
        document.getElementById('hall-status-cover-div').style.display = 'none';
      }
      function loadHallContacts()
      {
        document.getElementById('hall-news-cover-div').style.display = 'none';
        document.getElementById('hall-about-cover-div').style.display = 'none';
        document.getElementById('hall-contacts-cover-div').style.display = 'block';
        document.getElementById('hall-complaints-cover-div').style.display = 'none';
        document.getElementById('hall-status-cover-div').style.display = 'none';
      }
      function loadStatusForm()
      {
        document.getElementById('hall-news-cover-div').style.display = 'none';
        document.getElementById('hall-about-cover-div').style.display = 'none';
        document.getElementById('hall-status-cover-div').style.display = 'block';
        document.getElementById('hall-complaints-cover-div').style.display = 'none';
        document.getElementById('hall-contacts-cover-div').style.display = 'none';
      }
    </script>
  </head>

  <body style="height: 100%">
    <?php include('navbar.php'); ?>
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
    				<button class="btn btn-link" onclick="loadStatusForm()">
    					Check Status
    				</button>
    				<br>
    				<button class="btn btn-link" onclick="loadHallContacts()">
    					Useful Contacts
    				</button>
    			</ul>
    		</div>
    	</div>

    	<div class="col-lg-10 col-sm-9 justify-content-left" id="page-body">


    		<div id="hall-news-cover-div" style="display: none;">
            <?php
    				if ($type != 'Boarder')
    				{
    				?>
      				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#server_modal">
      				  Add
      				</button>
      				<!-- Modal -->
      				<div class="modal fade" id="server_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      				  <div class="modal-dialog" role="document">
      				    <div class="modal-content">
      				      <div class="modal-header">
      				        <h5 class="modal-title" id="exampleModalLabel">New News</h5>
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
      				          <button type="submit" class="btn btn-primary" name="submit" value="add_news">Submit</button>
      				        </div>
      				      </form>
      				    </div>
      				  </div>
      				</div>
              <!-- Modal -->
    				<?php
    				}
    				?>
    				<div class="accordion" id="news-accordion">

    				  <?php
    				    require("db_connect.php");
    				    $query = "SELECT * FROM hall_news WHERE hall_code='$hall_code' ORDER BY sr_no DESC";
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
    				if ($type != "Warden")
    				{
    				?>
    				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#server_modal">
    				  Register a Complaint
    				</button>
    				<!-- Modal -->
    				<div class="modal fade" id="server_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    				  <div class="modal-dialog" role="document">
    				    <div class="modal-content">
    				      <div class="modal-header">
    				        <h5 class="modal-title" id="exampleModalLabel">New Complaint</h5>
    				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    				          <span aria-hidden="true">&times;</span>
    				        </button>
    				      </div>
    				      <form id="server_login_form" action="add_complaint.php" method="post">
    				        <div class="modal-body">
    				          <div class="form-group">
    				            <label for="complaint_category">Category</label>
    				            <select class="form-control" name="complaint_category">
                          <option>Maintenance</option>
                          <option>Mess</option>
                          <option>So-Cult</option
                          <option>Sports</option>
                      	  <option>Student Welfare</option>
                          <option>Technology</option>
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
    				          <button type="submit" class="btn btn-primary" name="submit" value="add_complaint">Submit</button>
    				        </div>
    				      </form>
    				    </div>
    				  </div>
    				</div>
    				<!---->
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


    		<div id="hall-contacts-cover-div" style="display: none;">
    			Hello Contacts
    		</div>


    		<div id="hall-status-cover-div" style="display: none;">
    			Hello Status
    		</div>

    	</div>
    </div>
  </body>
</html>
