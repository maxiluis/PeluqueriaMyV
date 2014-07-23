<?php
require_once 'conection.php';
class Client
{
	
	
 	function __construct ( )
	{
		
	}
	private static function check($paramName,$paramLastName,$paramPleace)
	{
		if($paramLastName == "" || $paramName =="" || $paramPleace=="")
			return FALSE;
		else 
			return true;
	}
			
	public function addClient($paramName,$paramLastName,$paramPleace,$paramPhone)
	{
		
		$conn = new conection();
		$check = self::check($paramName, $paramLastName, $paramPleace);
		if($check){
			$query = "insert into cliente (nombre,apellido,localidad,telefono) values ('".$paramName."','".$paramLastName."','".$paramPleace."','".$paramPhone."')";
			$execute = mysqli_query($conn,$query);
			if($execute)
				echo "ok";
			else 
				echo "no";
			
		}
		else {
			echo "error al ingresar los datos";
		}
	}
	
	
}
