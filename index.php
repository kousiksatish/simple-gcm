
<html>

<head>
<h1>GCM send to festember app</h1>
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
</body>

</html>