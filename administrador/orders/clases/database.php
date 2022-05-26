<?php
/**
 	--------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	----------------------------
 
*/
class database{
	private $host='localhost';//generalmente suele ser "127.0.0.1"
	private $user='root';//Usuario de tu base de datos
	private $pass='admin';//Contraseña del usuario de la base de datos
	private $db='riveraco1';//Nombre de la base de datos
	public $counter;//Propiedad para almacenar el numero de registro devueltos por la consulta
	
	public  function conectar(){
		$conexion = new mysqli($this->host, $this->user, $this->pass, $this->db);
		$conexion->query("SET NAMES 'utf8'");
		return $conexion;
	}
}
?>

