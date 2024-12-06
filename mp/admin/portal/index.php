<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("location:login.php");
}

include "../templates/top.php";

?>

<?php include "../templates/navbar.php"; ?>

<div class="container-fluid">
  <div class="row">

    <?php include "../templates/sidebar.php"; ?>

      <div class="row">
      	<div class="col-10">
      		<h2>Admin List</h2>
      	</div>
      	<div class="col-2">
      		<a href="register.php" class="btn btn-primary btn-sm">Add Admin</a>
      	</div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="admin_list">

          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<?php include "../templates/footer.php"; ?>

<script type="text/javascript" src="../js/admin.js"></script>
