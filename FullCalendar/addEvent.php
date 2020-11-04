<?php

// Conexion a la base de datos
require_once('bdd.php');

if (isset($_POST['title']) && isset($_POST['start'])  && isset($_POST['arbitro']) && isset($_POST['hora']) && isset($_POST['escenario'])  ){
	
	$title = $_POST['title'];
	$start = $_POST['start'];	
	//$color = $_POST['color'];
	$arbitro = $_POST['arbitro'];
	$hora = $_POST['hora'];
	$escenario = $_POST['escenario'];

	$sql = "INSERT INTO events(title, start,  arbitro,escenario,hora) values ('$title', '$start', '$arbitro','$escenario','$hora')";
	
	echo $sql;
	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Error prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Error execute');
	}

}
header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
