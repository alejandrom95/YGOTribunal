<?php

	class ControllerLogin {

	    private $model;

	    private $action;

	    public function __construct($model, $action) {
	        $this->model = $model;
	        $this->action = $action;

	        $this->$action();
	    }

	    public function display() {
	    	if(isset($_GET['error'])) {
	    		if($_GET['error'] === 'signup_error') {
	    			$this->model->error_signup = true;
	    		}
	    		else if($_GET['error'] === 'login_error') {
	    			$this->model->error_login = true;
	    		}
	    	}
	    }
	    public function signup() {
	    	
	    	if(isset($_POST['first_name'])) {
				// $this->model->set_first_name($_POST['first_name']);
				$this->model->first_name = $_POST['first_name'];

	    	}
	    	if(isset($_POST['last_name'])) {
	    		// $this->model->set_last_name($_POST['last_name']);
	    		$this->model->last_name = $_POST['last_name'];

	    	}
		    if(isset($_POST['username'])) {
	    		// $this->model->set_username($_POST['username']);
	    		$this->model->username = $_POST['username'];
	    	}
		    if(isset($_POST['email'])) {
	    		// $this->model->set_email($_POST['email']);
	    		$this->model->email = $_POST['email'];
	    	}
		    if(isset($_POST['password'])) {
	    		// $this->model->set_password($_POST['password']);
	    		$this->model->password = $_POST['password'];
	    	}

		    $this->model->signup();
	    }
	    public function login() {
		    if(isset($_POST['username'])) {
	    		// $this->model->set_username($_POST['username']);
	    		$this->model->username = $_POST['username'];
	    	}
		    if(isset($_POST['password'])) {
	    		// $this->model->set_password($_POST['password']);
	    		$this->model->password = $_POST['password'];
	    	}
		    $this->model->login();
	    }
	    public function logout() {
		    $this->model->logout();
	    }


	}
?>