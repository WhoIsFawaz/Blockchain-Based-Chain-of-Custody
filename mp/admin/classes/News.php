<?php
class News
{
	private $con;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function getNewsList(){
		$query = $this->con->query("SELECT n.id, n.username, n.datetime, n.title, n.message FROM news n");
		$ar = [];
		if ($query->num_rows > 0) {
			while ($row = $query->fetch_assoc()) {
				$ar[] = $row;
			}
			return ['status'=> 202, 'message'=> $ar];
		}
		return ['status'=> 303, 'message'=> 'No News'];
	}

	public function deleteNews($news_id = null){
	    if ($news_id != null) {
	        $q = $this->con->prepare("DELETE FROM news WHERE id = ?");
	        $q->bind_param("i", $news_id);
	        $results= $q -> execute();
	        if ($results) {
	            return ['status'=> 202, 'message'=> 'News removed'];
	        }else{
	            return ['status'=> 202, 'message'=> 'Failed to run query'];
	        }

	    }else{
	        return ['status'=> 303, 'message'=>'Invalid news id'];
	    }
	}
}

if (isset($_POST['GET_NEWS'])) {
	$p = new News();
	echo json_encode($p->getNewsList());
	exit();

}

if (isset($_POST['DELETE_NEWS'])) {
    if (!empty($_POST['news_id'])) {
        $p = new News();
        echo json_encode($p->deleteNews($_POST['news_id']));
        exit();
    }else{
        echo json_encode(['status'=> 303, 'message'=> 'Error relating to news id']);
        exit();
    }
}
?>
