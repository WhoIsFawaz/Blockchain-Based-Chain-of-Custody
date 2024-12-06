<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../portal/b-coc");
    exit;
}

require_once "../res/login/config.php";

$email = $password = "";
$email_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a valid email.";
        echo "<script type='text/javascript'>alert('$email_err');</script>";
    } else{
        $email = trim($_POST["email"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
        echo "<script type='text/javascript'>alert('$password_err');</script>";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, email, password, name, address, phone, pr, branch FROM user WHERE email = :email";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if email exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $email = $row["email"];
                        $hashed_password = $row["password"];
                        $name = $row["name"];
                        $address = $row["address"];
                        $phone = $row["phone"];
                        $pr = $row["pr"];
                        $branch = $row["branch"];
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                            $_SESSION["name"] = $name;
                            $_SESSION["address"] = $address;
                            $_SESSION["phone"] = $phone;
                            $_SESSION["pr"] = $pr;
                            $_SESSION["branch"] = $branch;

                            // Redirect user to welcome page
                            header("location: ../portal/b-coc");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                            echo "<script type='text/javascript'>alert('$password_err');</script>";
                        }
                    }
                } else{
                    // Display an error message if email doesn't exist
                    $email_err = "No account found with that email.";
                    echo "<script type='text/javascript'>alert('$email_err');</script>";
                }
            } else{
                echo "<script type='text/javascript'>alert('Oops! Something went wrong. Please try again later.');</script>";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close connection
    unset($pdo);
}
?>

<html>
<head>
<title>B-COC</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="shortcut icon" href="https://www.police.gov.sg/-/media/logo-spf-white/SPF_Crest.png" />
<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="43c1e5d9-fe19-48ed-8f4e-be24ce370950";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
<link rel="stylesheet" href="../res/login.css">
</head>

<body>

  <div class="background-wrap">
    <div class="background"></div>
  </div>

  <form id="accesspanel" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h1 id="litheader">Investigator Login</h1>
    <br>
    <div class="form-control <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
        <label>Email</label>
        <br>
        <br>
        <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
    </div>
    <div class="form-control <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <label>Password</label>
        <br>
        <br>
        <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
    </div>
      <div style="text-align: center;">
    </div>
    <p class="p-container">
      <input type="submit" name="login" id="submit" value="Authorize">
    </p>
  </form>

</body>
</html>
