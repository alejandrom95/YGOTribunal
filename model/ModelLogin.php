<?php
require_once("DBConn.php");
class ModelLogin {

	public $first_name = '';
    public $last_name = '';
    public $username = '';
    public $email = '';
    public $password = '';

    private $db;
    private $dbConn;

    public $error_signup = false;
    public $error_login = false;

    public function signup() {
    	$this->db = new DBConn();
    	$this->dbConn = $this->db->connect();
    	$this->password = password_hash($this->password, PASSWORD_DEFAULT);
    	// echo $this->first_name.'..'.$this->last_name.'..'.$this->username.'..'.$this->email.'..'.$this->password;
    	$sqlStmt = "
			INSERT INTO users
			VALUES (
				'$this->username',
				'$this->email',
				'$this->password',
				'$this->first_name',
				'$this->last_name'
			)
		";
		$query_result = mysqli_query($this->dbConn,$sqlStmt);
		if($query_result <> false) {
			mysqli_next_result($this->dbConn);
			// mysqli_close($this->dbConn);

			$_SESSION['login_status'] = 'LOGGED_IN';
			header('location: /');
		}
		else {
			mysqli_next_result($this->dbConn);
			header('location: /?error=signup_error');
		}
		
    }
    public function login() {
    	$this->db = new DBConn();
    	$this->dbConn = $this->db->connect();
    	$sqlStmt = "
			SELECT password
			FROM users
			WHERE username = '$this->username'
		";
		$query_result = mysqli_query($this->dbConn,$sqlStmt);
		$pw = mysqli_fetch_row($query_result);
		if (password_verify($this->password, $pw[0])) {
		    mysqli_next_result($this->dbConn);
			$_SESSION['login_status'] = 'LOGGED_IN';
			header('location: /');
		} else {
		    mysqli_next_result($this->dbConn);
			header('location: /?error=login_error');
		}
    }
    public function logout() {
		session_unset();
		session_destroy();
		header('location: /');
    }



    // public function set_first_name($new_value) {
    // 	$this->first_name = $new_value;
    // }
    // public function set_last_name($new_value) {
    // 	$this->last_name = $new_value;
    // }
    // public function set_username($new_value) {
    // 	$this->username = $new_value;
    // }
    // public function set_email($new_value) {
    // 	$this->email = $new_value;
    // }
    // public function set_password($new_value) {
    // 	$this->password = $new_value;
    // }

}
?>