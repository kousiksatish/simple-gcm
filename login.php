<!DOCTYPE html>
<html>
<head>
	<title>Login To Send Push Notifications</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="content" align="center">
        <h2>Login To Send Push Notifications to All of Pragyan!</h2>
        <br>
		<br>
		<br>
        <form class="form-horizontal" method="POST">
			
			<div class="form-group">
			    <label for="username" class="col-sm-2 control-label">Username</label>
			    <div class="col-sm-3">
			      <input type="text" name="username">
			    </div>
			</div>
			<div class="form-group">
            	<label for="password" class="col-sm-2 control-label">Password </label>
            	<div class="col-sm-3">
            		<input name="pass" type="password">
            	</div>
            <br>
            </div>
            <div class="form-group">
      			<div class="col-sm-offset-2 col-sm-3">
            		<input type="submit"></input>
            	</div>
            </div>
        </form>
        <br>
</div>


<?php
require 'vendor/autoload.php';


$dotenv = new Dotenv\Dotenv(__DIR__, '.env');
$dotenv->load();

if (isset($_POST["username"]) && isset($_POST["pass"])) {
	$username = $_POST["username"];
	$password = $_POST["pass"];
	if ($username == $_ENV['USERNAME'] && $password == $_ENV['PASSWORD']) {
		session_start();
		$_SESSION['logged_in'] = "1";
		header("location:index.php");
	}
	
} else {
	if (isset($_SESSION['logged_in']))
		session_destroy();
}

?>

</body>
</html>