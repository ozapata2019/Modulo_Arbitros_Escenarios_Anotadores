<?php 	

require_once('model.php');

		
		if(array_key_exists('tabla', $_GET)) {
			$tabla = $_GET['tabla'];
		}		
		
		paginar($tabla);		

?>