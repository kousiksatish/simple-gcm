<?php

require 'vendor/autoload.php';


$dotenv = new Dotenv\Dotenv(__DIR__, '.env');
$dotenv->load();

class DB {

	private $con;
	private $host;
	private $user;
	private $password;
	private $database;
	private $table;
	private $table1;
	private $table2;
    private $table3;

    function __construct() {
        $user = $_ENV["DB_USER"];
        $password = $_ENV["DB_PASS"];
    	$host = $_ENV["DB_HOST"];
    	$database = $_ENV["DB_NAME"];

    	$con = mysql_connect($host, $user, $password)or die("not connected");
		$stmt = mysql_select_db("$database")or die("not selected");
    }

    public function latest_id($table) {
    	$this->table = $table;

    	$query = mysql_query("SELECT MAX(id) FROM $this->table;");
    	$row = mysql_fetch_assoc($query);
    	return $row['MAX(id)'];
    }

    public function get_all($table) {
    	$this->table = $table;
        //echo "SELECT * FROM $this->table WHERE $condition";
    	$query = mysql_query("SELECT * FROM $this->table") or die("Error querying");

    	return $query;
    }

    public function update($table, $data, $condition) {
    	$this->table = $table;

    	$query = mysql_query("UPDATE $this->table SET $data WHERE $condition") or die('error');

    	return $query;
    }

    public function insert($table, $data) {
		$this->table=$table;

		$fields = array_keys($data);
		$values = array_map("mysql_real_escape_string", array_values($data));
		
		$f=implode(',',$fields);
		$v=implode(',',$values);
		
		$query="INSERT INTO $this->table ($f) values ('" . implode( "','", $values ) . "')";
		mysql_query($query);
		
	}
}
?>
