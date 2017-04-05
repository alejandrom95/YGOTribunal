<?php
require_once("DBConn.php");
class ModelDiscussion {

	public $discussion_id;
	public $member_1;
	public $member_2;
	public $owner_username;

    private $db;
    private $dbConn;

    public $error_discussion_creation = false;
    // public $error_login = false;



    public function create() {
    	$this->db = new DBConn();
    	$this->dbConn = $this->db->connect();

    	$sqlStmt = "
			INSERT INTO discussion
			VALUES (
				'$this->member_1',
				'$this->member_2',
				'$this->owner_username'
			)
		";
		$query_result = mysqli_query($this->dbConn,$sqlStmt);
		if($query_result <> false) {
			mysqli_next_result($this->dbConn);
			mysqli_close($this->dbConn);

			$discussion_id = $this->dbConn->insert_id;

			header('location: /?target=discussion&action=display&id=$discussion_id');
		}
		else {
			mysqli_next_result($this->dbConn);
			mysqli_close($this->dbConn);
			header('location: /?error=discussion_creation_error'); //modify view to reflect error
		} 
    }


}
?>