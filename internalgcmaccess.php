<?php

	require 'db_ops.php';
	require 'vendor/autoload.php';


	$dotenv = new Dotenv\Dotenv(__DIR__, '.env');
	$dotenv->load();
	header('Content-Type: application/json');

	function sendPushNotificationToGCM($registration_ids, $message) {
		
		$GCM_SERVER_API_KEY = $_ENV["GCM_SERVER_API_KEY"];
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array(
			'registration_ids' => $registration_ids,
			'data' => $message,
		);
		// Update your Google Cloud Messaging API Key
		if (!defined('GOOGLE_API_KEY')) {
			define("GOOGLE_API_KEY", $GCM_SERVER_API_KEY);
		}
		$headers = array(
			'Authorization: key=' . GOOGLE_API_KEY,
			'Content-Type: application/json'
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);				
		if ($result === FALSE) {
			die('Curl failed: ' . curl_error($ch));
		}
		curl_close($ch);
		return $result;
	}

	$db = new DB;
  	if (isset($_POST['message']) && isset($_POST['title']) && isset($_POST['cluster']) && isset($_POST['event_name']) && isset($_POST['type']) && isset($_POST['internalgcmpin'])) {
		$msg = $_POST['message'];
		$title = $_POST['title'];
		$cluster = $_POST['cluster'];
		$type = $_POST['type'];
		$event = $_POST['event'];
		if($gcmpin == $_ENV["INTERNAL_GCM_PIN"])
		{
			$chunk_size = 300;
			$result = $db->get_all($_ENV["GCM_TABLE"]);

			$reg_ids = array();

			while($row = mysql_fetch_assoc($result))
			{
				array_push($reg_ids, $row['gcm_id']);
			}

			$size = sizeof($reg_ids);
			$msg_arr = array("text" => $msg, "title" => $title, "cluster" => $cluster, "type"=>$type, "event" => $event);
			$reg_id_chunks = array_chunk($reg_ids, $chunk_size);

			$db = new DB;
			$db->insert($_ENV["MESSAGE_TABLE"],array(
					"message" => $msg,
					"title" => $title,
					"sent_to" => $size
				));

			for($i=0;$i<sizeof($reg_id_chunks);$i++)
			{
				sendPushNotificationToGCM($reg_id_chunks[$i], $msg_arr);
			}
			$response = array (
				"status" => 200, 
				"description" => "Success"
				);
			echo json_encode($response);
		}
		else
		{
			$response = array (
				"status" => 102, 
				"description" => "Incorrect Pin"
				);
			echo json_encode($response);
		}
	}
	else
	{
		$response = array(
			"status" => 101,
			"description" => "Incorrect parameters"
			);
		echo json_encode($response);
	}
?>