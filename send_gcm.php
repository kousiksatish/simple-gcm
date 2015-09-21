<?php

	require 'db_ops.php';

	$db = new DB;

	$msg = $_POST['message'];

	function sendPushNotificationToGCM($registration_ids, $message) {
        
        $url = 'https://android.googleapis.com/gcm/send';
        $fields = array(
            'registration_ids' => $registration_ids,
            'data' => $message,
        );
		// Update your Google Cloud Messaging API Key
		if (!defined('GOOGLE_API_KEY')) {
			define("GOOGLE_API_KEY", "**"); 		
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

   	$chunk_size = 300;
    $result = $db->get_all("register");

    $reg_ids = array();

    while($row = mysql_fetch_assoc($result))
  	{
  		array_push($reg_ids, $row['gcm_id']);
  	}

  	$size = sizeof($reg_ids);
	$msg_arr = array("data" => $msg);
  	$reg_id_chunks = array_chunk($reg_ids, $chunk_size);

  	$db = new DB;
  	$db->insert("messages",array(
  			"message" => $msg
  		));

  	for($i=0;$i<sizeof($reg_id_chunks);$i++)
  	{
  		sendPushNotificationToGCM($reg_id_chunks[$i], $msg);
  	}







?>

