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
      		<h2>Investigator List</h2>
      	</div>
      	<div class="col-2">
          <a href="adduser.php" class="btn btn-primary btn-sm">Add Investigator</a>
      	</div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Branch</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="Investigator_list">

          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<!-- Edit investigator Modal start -->
<div class="modal fade" id="edit_investigator_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Investigator</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-investigator-form" enctype="multipart/form-data">
          <div class="row">

            <div class="col-12">
              <div class="form-group">
                <h6>Investigator Name</h6>
                <input type="text" name="e_investigator_name" class="form-control" placeholder="Enter investigator name">
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <h6>Investigator Email</h6>
                <input type="text" name="e_investigator_email" class="form-control" placeholder="Enter investigator email">
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <h6>Investigator Address</h6>
                <input class="form-control" name="e_investigator_address" placeholder="Enter investigator address"></textarea>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <h6>Investigator Phone</h6>
                <input type="text" name="e_investigator_phone" class="form-control" placeholder="Enter investigator phone">
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <h6>Investigator Branch</h6>
                <input type="text" name="e_investigator_branch" class="form-control" placeholder="Enter investigator branch">
              </div>
            </div>

            <input type="hidden" name="Investigator_id">
            <input type="hidden" name="edit_investigtor" value="1">
            <div class="col-12">
              <button type="button" class="btn btn-primary submit-edit-investigator">Update Investigator</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include "../templates/footer.php"; ?>

<script type="text/javascript" src="../js/investigator.js"></script>
