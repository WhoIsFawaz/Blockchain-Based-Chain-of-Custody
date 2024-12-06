<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("location:login.php");
}

include_once("../templates/top.php");
include_once("../templates/navbar.php");
?>

<div class="container-fluid">
  <div class="row">

    <?php include "../templates/sidebar.php"; ?>

      <div class="row">
      	<div class="col-10">
      		<h2>Evidence List</h2>
      	</div>
      	<div class="col-2">
      		<a href="#" data-toggle="modal" data-target="#add_product_modal" class="btn btn-primary btn-sm">Add Evidence</a>
      	</div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Case ID</th>
              <th>Name</th>
              <th>Image</th>
              <th>Description</th>
              <th>Port Number</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="product_list">
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>



<!-- Add evidence Modal start -->
<div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Evidence</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add-product-form" enctype="multipart/form-data">
        	<div class="row">

        		<div class="col-12">
        			<div class="form-group">
		        		<h6>Evidence Name</h6>
		        		<input type="text" name="product_name" class="form-control" placeholder="Enter evidence name">
		        	</div>
        		</div>

        		<div class="col-12">
        			<div class="form-group">
		        		<h6>Evidence Description</h6>
		        		<textarea class="form-control" name="product_desc" placeholder="Enter evidence description"></textarea>
		        	</div>
        		</div>

        		<div class="col-12">
        			<div class="form-group">
		        		<h6>Evidence Case-Id</h6>
		        		<input type="text" name="product_keywords" class="form-control" placeholder="Enter evidence case-id">
		        	</div>
        		</div>

        		<div class="col-12">
        			<div class="form-group">
		        		<h6>Evidence Image <small>(Format: jpg, jpeg, png)</small></h6>
		        		<input type="file" name="product_image" class="form-control">
		        	</div>
        		</div>

            <div class="col-12">
              <div class="form-group">
                <h6>Evidence Port Number</h6>
                <input type="text" name="product_port" class="form-control" placeholder="Enter evidence port number">
              </div>
            </div>

        		<input type="hidden" name="add_product" value="1">
        		<div class="col-12">
        			<button type="button" class="btn btn-primary add-product">Add Evidence</button>
        		</div>

        	</div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Add evidence Modal end -->

<!-- Edit evidence Modal start -->
<div class="modal fade" id="edit_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-product-form" enctype="multipart/form-data">
          <div class="row">

            <div class="col-12">
              <div class="form-group">
                <h6>Evidence Name</h6>
                <input type="text" name="e_product_name" class="form-control" placeholder="Enter evidence name">
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <h6>Evidence Description</h6>
                <textarea class="form-control" name="e_product_desc" placeholder="Enter evidence description"></textarea>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <h6>Evidence Case-Id</h6>
                <input type="text" name="e_product_keywords" class="form-control" placeholder="Enter evidence case-id">
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <h6>Evidence Image <small>(format: jpg, jpeg, png)</small></h6>
                <input type="file" name="e_product_image" class="form-control">
                <img src="" class="img-fluid" width="50">
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <h6>Evidence Port Number</h6>
                <input type="text" name="e_product_port" class="form-control" placeholder="Enter evidence port number">
              </div>
            </div>

            <input type="hidden" name="pid">
            <input type="hidden" name="edit_product" value="1">
            <div class="col-12">
              <button type="button" class="btn btn-primary submit-edit-product">Update Evidence</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Edit evidence Modal end -->

<?php include_once("../templates/footer.php"); ?>

<script type="text/javascript" src="../js/products.js"></script>
