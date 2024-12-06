<?php
session_start();
class Credentials
{
	private $con;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

    public function createAdminAccount($name, $email, $password){
    $q = $this->con->prepare("SELECT email FROM admin WHERE email = ? LIMIT 1");
    $q->bind_param("s", $email);
    $q->bind_result($email);
    $results= $q -> execute();
    $q->store_result();
    if ($q->num_rows() > 0 && $q->fetch()) {
        return ['status'=> 303, 'message'=> 'Email already exists'];
    }else{
        $password = password_hash($password, PASSWORD_BCRYPT);
        $q = $this->con->prepare("INSERT INTO `admin`(`name`, `email`, `password`) VALUES (?,?,?)");
        $q->bind_param("sss", $name, $email, $password);
        $results= $q -> execute();
        if ($results) {
            return ['status'=> 202, 'message'=> 'Admin Created Successfully'];
        }
    }
}

    public function loginAdmin($email, $password){
    $q = $this->con->prepare("SELECT * FROM admin WHERE email = ? ");
    $q->bind_param("s", $email);
    $q->bind_result($id,$name,$Email,$Password,$isActive);
    $results = $q -> execute();
    $q->store_result();
    if ($q->num_rows() > 0 && $q->fetch()) {
        if (password_verify($password, $Password)) {
            $_SESSION['admin_name'] = $name;
            $_SESSION['admin_id'] = $id;
            return ['status'=> 202, 'message'=> 'Login Successful'];
        }else{
            return ['status'=> 303, 'message'=> 'Login Fail'];
        }
    }else{
        return ['status'=> 303, 'message'=> 'Login Fail'];
    }
}
}

$regexName = "/^[a-zA-Z ]+$/";
$passwordvalid = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{12,}$/";

if (isset($_POST['admin_login'])) {
	extract($_POST);

	if (!empty($email) && !empty($password)) {
	}else{
	    echo json_encode(['status'=> 303, 'message'=> 'Please ensure there are no empty fields.']);
	    exit();
	}

	if(!preg_match($passwordvalid, $password)){
	    echo json_encode(['status'=> 303, 'message'=> 'Please ensure password is in the right format.']);
	    exit();
	}

	$c = new Credentials();
		$result = $c->loginAdmin($email, $password);
		echo json_encode($result);
		exit();
}

if (isset($_POST['admin_register'])) {
    extract($_POST);

    if (!empty($name) && !empty($email) && !empty($password) && !empty($cpassword)) {
    }else{
        echo json_encode(['status'=> 303, 'message'=> 'Please ensure there are no empty fields.']);
        exit();
    }

    if(!preg_match($regexName,$name)){
        echo json_encode(['status'=> 303, 'message'=> 'Please ensure name is in the right format.']);
        exit();
    }


    if(!preg_match($passwordvalid, $password)){
        echo json_encode(['status'=> 303, 'message'=> 'Please ensure password is in the right format.']);
        exit();
    }


    if ($password != $cpassword) {
        echo json_encode(['status'=> 303, 'message'=> 'Please ensure passwords are the same.']);
        exit();
    }

    $c = new Credentials();
    $result = $c->createAdminAccount($name, $email, $password);
    echo json_encode($result);
    exit();
}
?>
