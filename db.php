<?php 

require_once('config.php');

// Connessione al database attraverso MySqli
function ConnessioneMySql(){
	$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
	if($mysqli->connect_error){
		return false;
	} else {
		return $mysqli;
	}
}

$mysqli = ConnessioneMySql();

function SelectArraySql($sql){
	global $mysqli;
    $query = $mysqli->query($sql);
	return $query->fetch_all(MYSQLI_ASSOC);
}

function SelectFirstSql($sql){
	$array = SelectArraySql($sql);
	if (count($array)>0)
		return $array[0];
	else
		return null;
}