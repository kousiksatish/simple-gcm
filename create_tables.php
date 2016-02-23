<?php

/*
 * Create a database with the name defined here.
*/

require 'vendor/autoload.php';


$dotenv = new Dotenv\Dotenv(__DIR__, '.env');
$dotenv->load();

$db_host = $_ENV["DB_HOST"];
$db_name = $_ENV["DB_NAME"];
$db_user = $_ENV["DB_USER"];
$db_pass = $_ENV["DB_PASS"];

$gcm_table = $_ENV["GCM_TABLE"];
$message_table = $_ENV["MESSAGE_TABLE"];

// Connect to the database
$conn = mysql_connect($db_host, $db_user, $db_pass);
   
if(! $conn ) {
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("$db_name");

// Create the gcm_table
$gcm_sql = "CREATE TABLE $gcm_table(id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, p_id INT(11), gcm_id VARCHAR(500) UNIQUE, logtime TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

if (!mysql_query($gcm_sql, $conn))
	echo "\nError in creating $gcm_table " . mysql_error();

// Create message_table
$message_sql = "CREATE TABLE $message_table(id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, message VARCHAR(500), title VARCHAR(500), sent_to INT(11),logtime TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

if (!mysql_query($message_sql, $conn))
	echo "\nError in creating $message_table " . mysql_error();


mysql_close($conn);
?>	