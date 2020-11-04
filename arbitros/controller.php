<?php 	

require_once('model.php');
require_once('view.php');
//require_once ('../Core/paginar.php');	
require_once ('../Clases/Clase_Arbitro.php');	

function handler() {
$event = VIEW_GET_ARBITRO;

$uri = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$peticiones = array(SET_ARBITRO, GET_ARBITRO,GET_ARBITRO_LISTAR, DELETE_ARBITRO, EDIT_ARBITRO,
VIEW_SET_ARBITRO, VIEW_GET_ARBITRO,VIEW_GET_ARBITRO_LISTAR, VIEW_DELETE_ARBITRO,
VIEW_EDIT_ARBITRO);

foreach ($peticiones as $peticion) {
$uri_peticion = MODULO.$peticion.'/';
if( strpos($uri, $uri_peticion) == true ) {

$event = $peticion;
}
}
$ARBITRO_data = helper_ARBITRO_data();
$OrganizadorTorneo = set_obj();
switch ($event) {

case SET_ARBITRO:
$OrganizadorTorneo->set($ARBITRO_data);
$data = array('mensaje'=>$OrganizadorTorneo->mensaje);
retornar_vista(VIEW_SET_ARBITRO, $data);
break;

case GET_ARBITRO:
if($ARBITRO_data['identificacion'] != '')
{	
		
		$juez = new arbitro();
		$juez = $OrganizadorTorneo->get($ARBITRO_data);		
		
		if ($juez->getIdentificacion()!= '') {		
				
				$arbitro = $OrganizadorTorneo->get($ARBITRO_data);			
			
					$data = array(
				
					'identificacion'=>$arbitro->getIdentificacion(),
					'nombre'=>$arbitro->getNombre(),
					'apellido'=>$arbitro->getApellido(),
					'email'=>$arbitro->getEmail(),			
					'telefono'=>$arbitro->getTelefono(),			
					'direccion'=>$arbitro->getDireccion(),
					'tipo'=>$arbitro->getTipoArbitro(),			
					'disponible'=>$arbitro->getDisponible()

					);			
			
					retornar_vista(VIEW_EDIT_ARBITRO, $data);
		}else
		{
			$data = array('mensaje'=>'Arbitro no encontrado');	
			retornar_vista(VIEW_GET_ARBITRO ,$data);
		}
}			
break;

case GET_ARBITRO_LISTAR:

//paginar('arbitros');

break;


case DELETE_ARBITRO:
if($ARBITRO_data['identificacion'] != '')
{	
	$OrganizadorTorneo->delete($ARBITRO_data);
	$data = array('mensaje'=>$OrganizadorTorneo->mensaje);
	retornar_vista(VIEW_DELETE_ARBITRO, $data);
}
break;

	case EDIT_ARBITRO:
		$OrganizadorTorneo->edit($ARBITRO_data);	
		$data = array('mensaje'=>$OrganizadorTorneo->mensaje);
		retornar_vista(VIEW_GET_ARBITRO, $data);	

break;


default:
retornar_vista($event);
}
}

function set_obj() {
$obj = new OrganizadorTorneo();
return $obj;
}
function helper_ARBITRO_data() {

$ARBITRO_data = array();
if($_POST) {


if(array_key_exists('imagen', $_POST)) { 
 
 $ARBITRO_data['imagen'] = $_POST['imagen'];
}


if(array_key_exists('nombre', $_POST)) {

$ARBITRO_data['nombre'] = $_POST['nombre'];
}

if(array_key_exists('apellido', $_POST)) {

$ARBITRO_data['apellido'] = $_POST['apellido'];
}

if(array_key_exists('email', $_POST)) {

$ARBITRO_data['email'] = $_POST['email'];

}


if(array_key_exists('telefono', $_POST)) {

$ARBITRO_data['telefono'] = $_POST['telefono'];

}

if(array_key_exists('direccion', $_POST)) {

$ARBITRO_data['direccion'] = $_POST['direccion'];

}

if(array_key_exists('tipo', $_POST)) {

$ARBITRO_data['tipo'] = $_POST['tipo'];

}

if(array_key_exists('disponible', $_POST)) {

$ARBITRO_data['disponible'] = $_POST['disponible'];
}

if(array_key_exists('identificacion', $_POST)) {

$ARBITRO_data['identificacion'] = $_POST['identificacion'];
}
} else if($_GET) {
if(array_key_exists('identificacion', $_GET)) {
$ARBITRO_data['identificacion'] = $_GET['identificacion'];
}

}
return $ARBITRO_data;
}
handler();

?>