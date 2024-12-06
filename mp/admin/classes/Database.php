<?php
class Database
{
	private $con;
	public function connect()
	{
		$this->con = new Mysqli("localhost", "root", "", "evidence_db");
		return $this->con;
	}
}
?>
