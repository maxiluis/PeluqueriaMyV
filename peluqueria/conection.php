<?php
 //conexion  a la base de datos
 class conection
 {
 	
 	var $conn;
	
	function __construct(){
		$this->conn = $this->openConnection();
		return $this->conn;
	}
 	static function openConnection()
	{
		$dbhost="localhost";      
		$dbname = "datos";
		$user = "root";
		$pass = "";
		$link=mysqli_connect($dbhost,$user,$pass,$dbname); 
		if($link){
			return $link;
		}	
		else{
			return mysqli_error();
			//return $this->conn;
		}
	}
	static function closeConnection($link)
	{
		mysqli_close($link);
	}
 }
?>
