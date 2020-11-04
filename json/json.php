<?php 

$server = "localhost";
$user = "root";
$pass = "123";
$bd = "baloncesto";

//Creamos la conexión
$conexion = mysqli_connect($server, $user, $pass,$bd) 
or die("Ha sucedido un error inexperado en la conexion de la base de datos");

//generamos la consulta
$sql = "SELECT * FROM arbitros";
mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($conexion, $sql)) die();

$arbitros = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
    $id=$row['Identificacion'];
    $nombre=$row['Nombre'];
    $apellido=$row['Apellido'];
    $email=$row['Email'];
	$telefono=$row['Telefono'];
	$direccion=$row['Direccion'];
	$tipo=$row['TipoArbitro'];
	$disponible=$row['Disponible'];  
    

    $arbitros[] = array('identificacion'=> $id, 'nombre'=> $nombre, 'apellido'=> $apellido, 
                        'email'=> $email,'telefono'=> $telefono,'direccion'=> $direccion,
						'tipo'=> $tipo,'disponible'=> $disponible
						);
}
    
//desconectamos la base de datos
$close = mysqli_close($conexion) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");  

//Creamos el JSON
$json_string = json_encode($arbitros);
echo $json_string;

//$dir = __DIR__ . "/json"; // Full Path
$file = 'arbitros.json';

file_put_contents($file, $json_string);
    

?>
<a href="download/acme-doc-2.0.1.txt" download="Acme Documentation (ver. 2.0.1).txt">Download Text</a>