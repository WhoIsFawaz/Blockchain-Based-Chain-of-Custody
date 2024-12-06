<?php
include "db.php";
session_start();

if (isset($_POST["getProduct"])) {
    $product_query = "SELECT * FROM products";
    $run_query = mysqli_query($con, $product_query);
    if (mysqli_num_rows($run_query) > 0) {
        while ($row = mysqli_fetch_array($run_query)) {
            $pro_id = $row['product_id'];
            $pro_title = $row['product_title'];
            $pro_desc = $row['product_desc'];
            $pro_image = $row['product_image'];
            $pro_keywords = $row['product_keywords'];
            $pro_port = $row['product_port'];
            echo "
            <div class='panel col-md-8' style='width: 400px; height:230px;'>
              <div class='col-md-4 panel-body'>
                <img src='../../product_images/$pro_image' class='card-img' alt='...'>
              </div>
              <div class='col-md-8'>
                <div class='card-body'>
                  <h5 'class='card-title'>$pro_title</h5>
                  <hr>
                  <p class='card-title'>$pro_keywords:<br></p>
                  <p class='card-text'>$pro_desc</p>
                  <hr>
                  <button pid='$pro_keywords' tid='$pro_title' uid='$pro_port' style='float:left;' class='btn btn-primary btn-xs' id='checkin1' onclick='Alert()'>Check In</button>
                </div>
              </div>
            </div>
            <div class='col-sm-8' style='width: 20px;'></div>
			      ";
        }
    }
}

if (isset($_POST["checkin1"])) {

$p_id = $_POST["proId"];
$p_port = $_POST["proPort"];
$p_title = $_POST["proTitle"];

$p_user = $_SESSION["name"];

$url = 'http://localhost:'.$p_port;
$ch = curl_init($url);
$data = array(
    'ProductId' => $p_id,
    'ProductModel' => $p_title,
    'User' => $p_user,
    'Status' => 'Check In'
);
$payload = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
}
?>

<script type="text/javascript">
function Alert(){
	swal("Dear User,", "Check In Successful!", "success");
}
</script>

<style>
.swal-overlay {
  background-color: rgba(43, 165, 137, 0.45);
}
</style>
