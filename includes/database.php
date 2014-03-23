<?php
// ??
$query;
	class mySqldatabase {

private $connection;
function __construct(){
	$this->open_database();
}

public function open_database(){
	$this->connection = mysql_connect("localhost","root","");
	$this->confirm_query($this->connection);
	
	$db_select = mysql_select_db("cms",$this->connection);
	$this->confirm_query = ($db_select);
}

public function confirm_query($result){
	global $query;
	if(!$result) print_r("DB ERROR:<br>". mysql_error()."<br>QUERY:<br>".$query);
}

public function fetch_array($result_set){
	return mysql_fetch_array($result_set);
}

public function insert_id(){
	//gets the value of the last id in the selected database
	return mysql_insert_id($this->connection);
}

public function num_rows(){
	//gets the no. of rows
	return mysql_num_rows($this->connection);
}

public function query($sql){
	global $query;
	$query = $sql;
	$result = mysql_query($sql , $this->connection);
	$this->confirm_query($result);
	return $result;
}

public function escape_value($value){//this function makes the $value suitable for storing into mysql database.
	$magic_quotes_active = get_magic_quotes_gpc();
	$new_enough_php = function_exists("mysql_real_escape_string");
	if($new_enough_php){
		if($magic_quotes_active){
		$value =stripslashes($value);
		}
		$value = mysql_real_escape_string($value);
	}
	else {
		if(!$magic_quotes_active){
			$value = addslashes($value);
		}
	}
	return $value;
}

public function close_connection(){
	if(isset($this->connection)){
		mysql_close($this->connection);
		unset($this->connection);
	}
}
}
$database= new mySqldatabase();
$db =$database //making a reference to $database
?>