<?php
	class ViewDiscussion {

	    private $model;

	    public function __construct($model) {
	        $this->model = $model;
	    }

	    

	    public function display() {
	    	$discussion_creation_error = '';
	    	if($this->model->error_discussion_creation === true) {
				$discussion_creationerror = 'Discussion Creation Error';
			}

	        return 
	        '
	        <!DOCTYPE html>
			<html lang="en">
			<head>
			    <title>Discussion::Yugioh Tribunal</title>
			</head>
			<body>
				<h1>Login Page</h1>

				<h2>Signup</h2>
				'
				.$signup_error.
				'
				<form id="signup-form" action="/index.php?target=login&action=signup" method="POST">
					<label for="first-name-signup">First Name</label><br>
					<input id="first-name-signup" type="text" name="first_name">
					<br>
					<label for="last-name-signup">Last Name</label><br>
					<input id="last-name-signup" type="text" name="last_name">
					<br>
					<label for="username-signup">Username</label><br>
					<input id="username-signup" type="text" name="username">
					<br>
					<label for="email-signup">Email</label><br>
					<input id="email-signup" type="email" name="email">
					<br>
					<label for="password-signup">Password</label><br>
					<input id="password-signup" type="text" name="password">
					<br>
					<input type="submit" value="Submit">
				</form>
				<br><br>
				<h2>Login</h2>
				'
				.$login_error.
				'
				<form id="login-form" action="/index.php?target=login&action=login" method="POST">
					<label for="username-login">Username</label><br>
					<input id="username-login" type="text" name="username">
					<br>
					<label for="password-login">Password</label><br>
					<input id="password-login" type="text" name="password">
					<br>
					<input type="submit" value="Submit">
				</form>
				<!-- add script for error checking form inputs -->
			</body>
			</html>
	        ';

	    }

	    

	}
?>