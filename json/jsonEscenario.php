<?php 

$server = "localhost";
$user = "root";
$pass = "123";
$bd = "baloncesto";

//Creamos la conexión
$conexion = mysqli_connect($server, $user, $pass,$bd) 
or die("Ha sucedido un error inexperado en la conexion de la base de datos");

//generamos la consulta
$sql = "SELECT * FROM escenarios";
mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($conexion, $sql)) die();

$escenarios = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
    $id=$row['Id'];
    $nombre=$row['Nombre'];
    $aforo=$row['Aforo'];   
	$direccion=$row['direccion'];
	$tipo=$row['Techo_movible'];
	$disponible=$row['Disponible']; 
	$observaciones=$row['Observaciones'];
    

    $escenarios[] = array('id'=> $id, 'nombre'=> $nombre, 'aforo'=> $aforo, 
                        'tipo'=> $tipo,'direccion'=> $direccion,
						'observaciones'=> $observaciones,'disponible'=> $disponible
						);
}
    
//desconectamos la base de datos
$close = mysqli_close($conexion) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");  

//Creamos el JSON
$json_string = json_encode($escenarios);
echo $json_string;

//$dir = __DIR__ . "/json"; // Full Path
$file = 'escenarios.json';

file_put_contents($file, $json_string);    

?>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href='/baloncesto/'>Inicio</a>&nbsp;&nbsp;<a href="/baloncesto/json/escenarios.json" download="escenarios.json">Download escenarios.json</a>