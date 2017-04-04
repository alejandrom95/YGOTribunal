<?php
	class ViewHome {

	    private $model;

	    public function __construct($model) {
	        $this->model = $model;
	    }

	    

	    public function display() {
	        return 
	        '
	        <!DOCTYPE html>
			<html lang="en">
			<head>
			    <title>Yugioh Tribunal</title>
			</head>
			<body>
				<h1>Home Page</h1>
			</body>
			</html>
	        ';

	    }

	    

	}
?>