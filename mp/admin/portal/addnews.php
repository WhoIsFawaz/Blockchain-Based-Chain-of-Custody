<?php

session_start();
if (!isset($_SESSION['admin_id'])) {
  header("location:login.php");
}

// Include config file
require_once "../../res/login/config.php";
//datetime
date_default_timezone_set('Asia/Singapore');

$time=date(DATE_RFC850);

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){



        // Prepare an insert statement
        $sql = "INSERT INTO news (username, datetime, title, message) VALUES (:username, :datetime, :title, :message)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":datetime", $datetime, PDO::PARAM_STR);
            $stmt->bindParam(":title", $title, PDO::PARAM_STR);
            $stmt->bindParam(":message", $message, PDO::PARAM_STR);



            // Set parameters
            $username = trim($_POST["username"]);
            $datetime = trim($_POST["datetime"]);
            $title = trim($_POST["title"]);
            $message = trim($_POST["message"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: news.php");
            } else{

                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close connection
    unset($pdo);

?>

<?php
include "../templates/top.php";
include "../templates/navbar.php";
?>

<div class="container">
	<div class="row justify-content-center" style="margin:100px 0;">
		<div class="col-md-4">
			<h4>Add Announcement</h4>
			<p class="message"></p>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
           <div class="form-group">
                <input type="hidden" readonly="readonly" name="username" class="form-control" value="Admin">
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label>Message</label>
                <input type="text" name="message" class="form-control">
            </div>
            <div class="form-group">
                <input type="hidden" readonly="readonly" name="datetime" class="form-control" value="<?php echo $time; ?>">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div>
</body>
</html>
