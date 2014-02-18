<?php
class DB{
	
	var $mysqli;

	public function __construct(){
		$settings = json_decode(file_get_contents("config_db.json"));
    
	
		$this->mysqli = mysqli_connect($settings->host, $settings->user, $settings->password, $settings->database);
		if (mysqli_connect_errno($this->mysqli)) {
		    echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	}

	public function select($statement){
		if(!is_array($statement))
			return false;
		if(is_array($statement["select"]))
			$select = implode(", ", $statement["select"]);
		if(is_array($statement["from"]))
			$from = implode(", ", $statement["from"]);
		if(is_array($statement["where_and"]))
			$where_and = implode(" and ", $statement["where_and"]);
		if(is_array($statement["where_or"]))
			$where_or = implode(" or ", $statement["where_or"]);
	}

	public function query($query){
		$res = mysqli_query($this->mysqli, $query);
		return $res;
	}



}


?>