
<html>

<head>
<h1>GCM send to Pragyan app</h1>
<link rel="stylesheet" href="css/bootstrap.min.css">

<style>
.main-form {

	padding-top : 40px;
}

</style>

</head>

<body>

<div class="row main-form">
<form class="form-horizontal" method="post" action="send_gcm.php">
  <div class="form-group">
      <label for="title" class="col-sm-2 control-label">Title</label>
      <div class="col-sm-3">
        <input type="text" name="title" required>
      </div>
  </div>

	<div class="form-group">
      <label for="text" class="col-sm-2 control-label">Message</label>
      <div class="col-sm-3">
        <textarea class="form-control" name="message" placeholder="Message" rows="5" required></textarea>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-3">
        <button type="submit" class="btn btn-primary">Send</button>
      </div>
    </div>
</form>

</div>

<?php
require 'vendor/autoload.php';


$dotenv = new Dotenv\Dotenv(__DIR__, '.env');
$dotenv->load();

session_start();
if ($_SESSION['logged_in'] != $_ENV["SESSION_VARIABLE"]) {
  session_destroy();
  header("location:login.php");
}

?>

</body>
</html>
