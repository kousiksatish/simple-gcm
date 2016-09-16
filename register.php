<?php

        require 'db_ops.php';
        require 'vendor/autoload.php';


        $dotenv = new Dotenv\Dotenv(__DIR__, '.env');
        $dotenv->load();


        $p_id = $_POST['p_id'];
        $gcm_id = $_POST['gcm_id'];


        $db = new DB;

        $db->insert($_ENV["GCM_TABLE"], array(
                        "p_id" => $p_id,
                        "gcm_id" => $gcm_id
                ));
	$res = array(
                        "status_code" => "1"
                );

        echo json_encode($res);
?>



