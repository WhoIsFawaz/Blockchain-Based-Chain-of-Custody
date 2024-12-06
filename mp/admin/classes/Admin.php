<?php
class Admin
{
	private $con;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function getAdminList(){
		$query = $this->con->query("SELECT `id`, `name`, `email`, `is_active` FROM `admin` WHERE 1");
		$ar = [];
		if ($query->num_rows > 0) {
			while ($row = $query->fetch_assoc()) {
				$ar[] = $row;
			}
			return ['status'=> 202, 'message'=> $ar];
		}
		return ['status'=> 303, 'message'=> 'No Admin'];
	}

	public function deleteAdmin($admin_id = null){
	    if ($admin_id != null) {
	        $q = $this->con->prepare("DELETE FROM admin WHERE id = ?");
	        $q->bind_param("i", $admin_id);
	        $results= $q -> execute();
	        if ($results) {
	            return ['status'=> 202, 'message'=> 'Admin removed'];
	        }else{
	            return ['status'=> 202, 'message'=> 'Failed to run query'];
	        }

	    }else{
	        return ['status'=> 303, 'message'=>'Invalid admin id'];
	    }
	}
}

if (isset($_POST['GET_ADMIN'])) {
	$p = new Admin();
	echo json_encode($p->getAdminList());
	exit();

}

if (isset($_POST['DELETE_ADMIN'])) {
    if (!empty($_POST['admin_id'])) {
        $p = new Admin();
        echo json_encode($p->deleteAdmin($_POST['admin_id']));
        exit();
    }else{
        echo json_encode(['status'=> 303, 'message'=> 'Error relating to admin id']);
        exit();
    }
}
?>
