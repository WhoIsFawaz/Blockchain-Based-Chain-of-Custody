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
      		<h3>Evidence Blockchain Data List</h3>
          <hr>
      	</div>
      </div>
      <div>
        <h6 class="card-title font-weight-medium mr-2">Evidence Port: 3001 | <a href="http://localhost:3001/" target="1_bc">View Block Chain</a></h6>
        <iframe width="650" height="250" style="border:2px solid DarkBlue;" id="1_bc" name="1_bc" title="view"></iframe>
        <hr>
        <h6 class="card-title font-weight-medium mr-2">Evidence Port: 3002 | <a href="http://localhost:3002/" target="2_bc">View Block Chain</a></h6>
        <iframe width="650" height="250" style="border:2px solid DarkBlue;" id="2_bc" name="2_bc" title="view"></iframe>
        <hr>
        <h6 class="card-title font-weight-medium mr-2">Evidence Port: 3003 | <a href="http://localhost:3003/" target="3_bc">View Block Chain</a></h6>
        <iframe width="650" height="250" style="border:2px solid DarkBlue;" id="3_bc" name="3_bc" title="view"></iframe>
        <hr>
        <h6 class="card-title font-weight-medium mr-2">Evidence Port: 3004 | <a href="http://localhost:3004/" target="4_bc">View Block Chain</a></h6>
        <iframe width="650" height="250" style="border:2px solid DarkBlue;" id="4_bc" name="4_bc" title="view"></iframe>
        <hr>
      </div>
    </main>
  </div>
</div>

<?php include "../templates/footer.php"; ?>
