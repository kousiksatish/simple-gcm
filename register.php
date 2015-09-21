<?php
	
	require 'db_ops.php';


	$fes_id = $_POST['fes_id'];
	$gcm_id = $_POST['gcm_id'];


	$db = new DB;

	$db->insert('register_gcm', array(
			"fes_id" => $fes_id,
			"gcm_id" => $gcm_id
		));


	$res = array(
			"status_code" => "1"
		);

	echo json_encode($res);
?>