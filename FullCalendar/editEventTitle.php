<?php
// Conexion a la base de datos
require_once('bdd.php');
if (isset($_POST['delete']) && isset($_POST['id'])){
	
	
	$id = $_POST['id'];
	
	$sql = "DELETE FROM events WHERE id = $id";
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Error prepare');
	}
	$res = $query->execute();
	if ($res == false) {
	 print_r($query->errorInfo());
	 die ('Error execute');
	}
	
}elseif (isset($_POST['title'])  && isset($_POST['id']) && isset($_POST['arbitro']) && isset($_POST['hora'])&& isset($_POST['escenario'])  ){
	
	$id = $_POST['id'];
	$title = $_POST['title'];
	//$color = $_POST['color'];
	$arbitro = $_POST['arbitro'];
	$hora = $_POST['hora'];
	$escenario = $_POST['escenario'];
	
	$sql = "UPDATE events SET  title = '$title',  arbitro = '$arbitro', escenario = '$escenario', hora = '$hora' WHERE id = $id ";

	
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
header('Location: index.php');

	
?>
