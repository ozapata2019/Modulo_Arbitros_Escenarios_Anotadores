<?php 

$server = "localhost";
$user = "root";
$pass = "123";
$bd = "baloncesto";

//Creamos la conexión
$conexion = mysqli_connect($server, $user, $pass,$bd) 
or die("Ha sucedido un error inexperado en la conexion de la base de datos");

//generamos la consulta
$sql = "SELECT * FROM events";
mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($conexion, $sql)) die();

$eventos = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
    $id=$row['id'];
    $title=$row['title'];
    $arbitro=$row['arbitro'];
    $escenario=$row['escenario'];
	$start=$row['start'];
	$hora=$row['hora'];
	
    

    $eventos[] = array('id'=> $id, 'title'=> $title, 'arbitro'=> $arbitro, 
                        'escenario'=> $escenario,'start'=> $start,'hora'=> $hora
						
						);
}
    
//desconectamos la base de datos
$close = mysqli_close($conexion) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");  

//Creamos el JSON
$json_string = json_encode($eventos);
echo $json_string;

//$dir = __DIR__ . "/json"; // Full Path
$file = 'eventos.json';

file_put_contents($file, $json_string);    

?>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href='/baloncesto/'>Inicio</a>&nbsp;&nbsp;<a href="/baloncesto/json/eventos.json" download="eventos.json">Download agenda.json</a>