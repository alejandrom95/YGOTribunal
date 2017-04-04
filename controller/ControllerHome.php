<?php

	class ControllerHome {

	    private $model;

	    private $action;

	    public function __construct($model, $action) {
	        $this->model = $model;
	        $this->action = $action;

	        $this->$action();
	    }

	    public function display() {
	    	//fill with relavant content later
	    }



	}
?>