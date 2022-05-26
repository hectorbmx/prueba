<?php
/**
 	--------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	----------------------------
 
*/
include("database.php");
class orders extends database {
	public $mysqli;
	public $counter;//Propiedad para almacenar el numero de registro devueltos por la consulta

	function __construct(){
		$this->mysqli = $this->conectar();
    }
	
	public function countAll($sql){
		$query=$this->mysqli->query($sql);
		$count=$query->num_rows;
		return $count;
	}
	
	public function getData($tables,$campos,$search){
		$offset=$search['offset'];
		$per_page=$search['per_page'];
		$sWhere=" orders.name LIKE '%".$search['query']."%'";
		if ($search['location']!=""){
			$sWhere.=" and orders.location = '".$search['location']."'";
		}
		if ($search['status']!=""){
			$sWhere.=" and orders.status = '".$search['status']."'";
		}
		$sWhere.=" order by orders.id desc";
		$sql="SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page";
		
		$query=$this->mysqli->query($sql);
		$sql1="SELECT $campos FROM  $tables where $sWhere";
		$nums_row=$this->countAll($sql1);
		//Set counter
		$this->setCounter($nums_row);
		return $query;
	}
	function setCounter($counter) {
		$this->counter = $counter;
	}
	function getCounter() {
		return $this->counter;
	}
}

