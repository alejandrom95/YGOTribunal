<?php

	class ControllerDiscussion {

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
	    	if(isset($_GET['id'])) {
	    		$this->model->discussion_id = $_GET['id'];
	    	}
	    }
	    public function create() {
	    	
	    	if(isset($_POST['member_1'])) {
				$this->model->member_1 = $_POST['member_1'];

	    	}
	    	if(isset($_POST['member_2'])) {
	    		// $this->model->set_last_name($_POST['last_name']);
	    		$this->model->member_2 = $_POST['member_2'];

	    	}
		    if(isset($_POST['owner_username'])) {
	    		// $this->model->set_username($_POST['username']);
	    		$this->model->owner_username = $_POST['owner_username'];
	    	}

		    $this->model->create();
	    }


	}
?>