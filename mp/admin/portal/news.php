<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("location:login.php");
}
//datetime
date_default_timezone_set('Asia/Singapore');
$time=date(DATE_RFC850);

include "../templates/top.php";

?>

<?php include "../templates/navbar.php"; ?>

<div class="container-fluid">
  <div class="row">

    <?php include "../templates/sidebar.php"; ?>

      <div class="row">
      	<div class="col-10">
      		<h2>Announcements List</h2>
      	</div>
      	<div class="col-2">
      		<a href="addnews.php" class="btn btn-primary btn-sm">Add Announcement</a>
      	</div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Name</th>
              <th>Timestamp</th>
              <th>Title</th>
              <th>Message</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="news_list">

          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<?php include "../templates/footer.php"; ?>

<script type="text/javascript" src="../js/news.js"></script>
