<?php


class Database{
	public static $config = array(
		"host" => "localhost",
		"dbname" => "ccsdb",
		"username" => "root",
		"password" => "",
	);

	public static function conn(){
		return static::$config;
		// $conn = new PDO('mysql:host='.$this->config['host'].';dbname='.$this->config['dbname'],$this->config['username'],$this->config['password']);
	}	
}


// print_r(Database::conn());