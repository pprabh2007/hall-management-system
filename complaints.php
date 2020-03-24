<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['type']) || !isset($_SESSION['hall_code']))
  header('Location: home.php');

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
