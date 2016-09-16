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
<html>

<head>
<h1>GCM send to <?php echo $_ENV['FEST_NAME']; ?> app</h1>
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
      <label for="title" class="col-sm-2 control-label">Cluster</label>
      <div class="col-sm-3">
        <select name="cluster" class="form-control">
	 <option value="general">general</option>

          <option value="tamil_lits">tamil</option>
          <option value="hindi_lits">hindi</option>
          <option value="english_lits">english</option>
        </select>
      </div>
  </div>

  <div class="form-group">
      <label for="title" class="col-sm-2 control-label">Event</label>
      <div class="col-sm-3">
        <select name="event_name" class="form-control">
          <option value="Koothambalam">Koothambalam</option>
          <option value="Rochak_Mantrana">Rochak_Mantrana</option>
          <option value="Crossword">Crossword</option>
        </select>
      </div>
  </div>

  <div class="form-group">
      <label for="title" class="col-sm-2 control-label">Type</label>
      <div class="col-sm-3">
        <select name="type" class="form-control">
          <option value="general">General</option>
          <option value="feedback">Feedback</option>
        </select>
      </div>
  </div>


  <div class="form-group">
      <label for="title" class="col-sm-2 control-label">Title</label>
      <div class="col-sm-3">
        <input class="form-control" type="text" name="title" required>
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


?>

</body>
</html>
