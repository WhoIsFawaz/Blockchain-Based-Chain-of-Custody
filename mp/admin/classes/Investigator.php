<?php
class Investigator
{
	private $con;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function getInvestigatorList(){
		$query = $this->con->query("SELECT `id`, `name`, `email`, `address`, `phone`, `branch` FROM `user` WHERE 1");
		$ar = [];
		if ($query->num_rows > 0) {
			while ($row = $query->fetch_assoc()) {
				$ar[] = $row;
			}
			return ['status'=> 202, 'message'=> $ar];
		}
		return ['status'=> 303, 'message'=> 'No Investigator'];
	}

	public function editInvestigtor($Investigator_id, $name, $email, $address, $phone, $branch)
	{
			if ($Investigator_id != null) {
					$q = $this->con->prepare("UPDATE `user` SET
									`name` = ?,
									`email` = ?,
									`address` = ?,
									`phone` = ?,
									`branch` = ?
									WHERE id = ?");
					$q->bind_param("sssssi", $name, $email, $address, $phone, $branch, $Investigator_id);
					$results= $q -> execute();

					if ($results) {
							return [
									'status' => 202,
									'message' => 'Investigator updated successfully'
							];
					} else {
							return [
									'status' => 303,
									'message' => 'Failed to run query'
							];
					}
			} else {
					return [
							'status' => 303,
							'message' => 'Invalid investigator id'
					];
			}
	}

	public function deleteInvestigator($Investigator_id = null){
	    if ($Investigator_id != null) {
	        $q = $this->con->prepare("DELETE FROM user WHERE id = ?");
	        $q->bind_param("i", $Investigator_id);
	        $results= $q -> execute();
	        if ($results) {
	            return ['status'=> 202, 'message'=> 'Investigator removed'];
	        }else{
	            return ['status'=> 202, 'message'=> 'Failed to run query'];
	        }

	    }else{
	        return ['status'=> 303, 'message'=>'Invalid Investigator id'];
	    }
	}

}

if (isset($_POST['GET_Investigator'])) {
	$p = new Investigator();
	echo json_encode($p->getInvestigatorList());
	exit();

}

if (isset($_POST['edit_investigtor'])) {

    extract($_POST);
    if (! empty($Investigator_id) && ! empty($e_investigator_name) && ! empty($e_investigator_email) && ! empty($e_investigator_address) && ! empty($e_investigator_phone) && ! empty($e_investigator_branch)) {

        $p = new Investigator();
        $result = $p->editInvestigtor($Investigator_id, $e_investigator_name, $e_investigator_email, $e_investigator_address, $e_investigator_phone, $e_investigator_branch);

        echo json_encode($result);
        exit();
    } else {
        echo json_encode([
            'status' => 303,
            'message' => 'Empty fields'
        ]);
        exit();
    }
}

if (isset($_POST['DELETE_Investigator'])) {
    if (!empty($_POST['Investigator_id'])) {
        $p = new Investigator();
        echo json_encode($p->deleteInvestigator($_POST['Investigator_id']));
        exit();
    }else{
        echo json_encode(['status'=> 303, 'message'=> 'Error relating to Investigator id']);
        exit();
    }
}
?>
