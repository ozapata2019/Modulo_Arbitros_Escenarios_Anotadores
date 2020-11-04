<?php // C�digo para realizar paginaci�n de las consultas a las tablas
function paginar($nombre_tabla){	
	//variables de la conexi�n	
	$dbhost = 'localhost'; 
	$dbuser = 'root'; 
	$dbpass = '123'; 
	$dbname = 'baloncesto'; 
	//conecto con la base de datos
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);	
	
	//Limito la busqueda
	$TAMANO_PAGINA = 10;
	$registros2 = 10;
	//examino la p�gina a mostrar y el inicio del registro a mostrar
	@$pagina = $_GET["pagina"];
	if (!$pagina) {
		$inicio = 0;
		$pagina=1;
	}
	else {
		$inicio = ($pagina - 1) * $TAMANO_PAGINA;
		$registros2 = ($pagina) * $TAMANO_PAGINA;
	}
	//miro a ver el n�mero total de campos que hay en la tabla con esa b�squeda
	
	//nombre de la tabla a realizar consulta SQL
	$tabla = $nombre_tabla;
	//nombre del campo para dibujar el gr�fico estad�stico
	$campo = "email";
	//realizo consulta para traer los datos de toda la tabla y luego contar el total de registros
	$consulta = "select * from"." ".$tabla;
	$resultado = $conn->query($consulta);
	$num_total_registros = $resultado->num_rows;
	
	//calculo el total de p�ginas	
	$inicio2 = $inicio+1;
	if($registros2 > $num_total_registros)
		$registros2 = $num_total_registros;
	//construyo la sentencia SQL y muestro los resultados en pantalla limitando la b�squeda a 10 registros
	$consulta = "select * FROM"." ".$tabla . " limit " . $inicio . "," . $TAMANO_PAGINA;
	$resultado = $conn->query($consulta);
	$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
	//pongo el n�mero de registros total, el tama�o de p�gina y la p�gina que se muestra
	//echo "<CENTER><h6>Mostrando del <strong>$inicio2</strong> al <strong>$registros2</strong> de <strong>$num_total_registros </strong> de Registros Encontrados en la tabla <strong>$tabla</strong> </h6></CENTER><br />";		
	
	//llamo el archivo HTML y muestro los resultados en pantalla
	$file = 'reporte_listar.html';
	$html = file_get_contents($file);
	$html = str_replace('{tabla}',llenar_tabla($resultado),$html); 
	$html = str_replace('{nombre_tabla}',$tabla,$html);
	$html = str_replace('{inicio2}',$inicio2,$html);
	$html = str_replace('{registros2}',$registros2,$html);
	$html = str_replace('{num_total_registros}',$num_total_registros,$html);	
	print $html;		

######################### estilo de paginaci�n   #############################################
	
ECHO '<DIV class = "center">';
	if($num_total_registros>$TAMANO_PAGINA){
		if(($pagina - 1) > 0) {
			
			ECHO '<SPAN class = "pagination">';
			echo "<a href='paginar.php?pagina=".($pagina-1)."'>&laquo;</a>";			
			ECHO '</SPAN>';
	}

//muestro los distintos �ndices de las p�ginas, si es que hay varias p�ginas
	if ($total_paginas > 1){
		for ($i=1;$i<=$total_paginas;$i++){
			if ($pagina == $i)
			{	//si muestro el �ndice de la p�gina actual, no coloco enlace
						
						ECHO '<SPAN class="pactive">';	
						echo $pagina;
						ECHO '</SPAN>';
			}			
			else
			{	//si el �ndice no corresponde con la p�gina mostrada actualmente, coloco el enlace para ir a esa p�gina			
			
				ECHO '<SPAN class = "pagination">';
				echo "<a href='paginar.php?pagina=" . $i .  "'>" . $i . "</a> ";			
				ECHO '</SPAN>';
			}
		}
	}
	
		if(($pagina + 1)<=$total_paginas) {
			ECHO '<SPAN class = "pagination">';
			echo " <a  href='paginar.php?pagina=".($pagina+1)."'>&raquo;</a>";
			ECHO '</SPAN>';
		}
			  
}
ECHO '</DIV>';	
######################### fin estilo de paginaci�n   #############################################	  
 
	  
			  
}			//esta funcion me llena la tabla con los resultados de la consulta para luego ser mostrados en pantalla
			function llenar_tabla($resultado) 
			  { 
				$line = ''; 
				$head = '';		
					
					
					while($temp = $resultado->fetch_array(MYSQLI_ASSOC))						
					{ 
						
							if(empty($head)) 
							{ 
							  $keys = array_keys($temp); 
							  $head = '<tr><th>' . implode('</th><th>', $keys). '</th></tr>'; 
							}						
							$line .= '<tr><td>' . implode('</td><td>', $temp). '</td></tr>';					
							
					}	  
						return '<table >' . $head . $line . '</table>'; 
			  }
?> 			
</div> 
 
