<?php 	

require_once('model.php');
require_once('view.php');
require_once ('../Clases/Clase_Escenario.php');	 

function handler() {
$event = VIEW_GET_ESCENARIO;

$uri = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$peticiones = array(SET_ESCENARIO, GET_ESCENARIO,GET_ESCENARIO_LISTAR, DELETE_ESCENARIO, EDIT_ESCENARIO,
VIEW_SET_ESCENARIO, VIEW_GET_ESCENARIO,VIEW_GET_ESCENARIO_LISTAR, VIEW_DELETE_ESCENARIO,
VIEW_EDIT_ESCENARIO);

foreach ($peticiones as $peticion) {
$uri_peticion = MODULO.$peticion.'/';
if( strpos($uri, $uri_peticion) == true ) {

$event = $peticion;
}
}
$escenario_data = helper_escenario_data();
$OrganizadorTorneo = set_obj();
switch ($event) {

case SET_ESCENARIO:
$OrganizadorTorneo->set($escenario_data);
$data = array('mensaje'=>$OrganizadorTorneo->mensaje);
retornar_vista(VIEW_SET_ESCENARIO, $data);
break;

case GET_ESCENARIO:
if($escenario_data['id'] != '')
{	
		
		$cancha = new escenario();
		$cancha = $OrganizadorTorneo->get($escenario_data);		
		
		if ($cancha->getId()!= '') {		
				
				$escenario = $OrganizadorTorneo->get($escenario_data);			
			
					$data = array(
				
					'id'=>$escenario->getId(),
					'nombre'=>$escenario->getNombre(),						
					'direccion'=>$escenario->getDireccion(),
					'aforo'=>$escenario->getAforo(),
					'techomovible'=>$escenario->getTechomovible(),			
					'disponible'=>$escenario->getDisponible(),
					'observaciones'=>$escenario->getObservaciones()

					);			
			
					retornar_vista(VIEW_EDIT_ESCENARIO, $data);
		}else
		{
			$data = array('mensaje'=>'escenario no encontrado');	
			retornar_vista(VIEW_GET_ESCENARIO ,$data);
		}
}			
break;

case GET_ESCENARIO_LISTAR:

//paginar('escenarios');

break;


case DELETE_ESCENARIO:
if($escenario_data['id'] != '')
{	
	$OrganizadorTorneo->delete($escenario_data);
	$data = array('mensaje'=>$OrganizadorTorneo->mensaje);
	retornar_vista(VIEW_DELETE_ESCENARIO, $data);
}
break;

	case EDIT_ESCENARIO:
		$OrganizadorTorneo->edit($escenario_data);	
		$data = array('mensaje'=>$OrganizadorTorneo->mensaje);
		retornar_vista(VIEW_GET_ESCENARIO, $data);	

break;


default:
retornar_vista($event);
}
}

function set_obj() {
$obj = new OrganizadorTorneo();
return $obj;
}
function helper_escenario_data() {

$escenario_data = array();
if($_POST) {



if(array_key_exists('nombre', $_POST)) {

$escenario_data['nombre'] = $_POST['nombre'];
}


if(array_key_exists('direccion', $_POST)) {

$escenario_data['direccion'] = $_POST['direccion'];

}

if(array_key_exists('aforo', $_POST)) {

$escenario_data['aforo'] = $_POST['aforo'];

}


if(array_key_exists('techomovible', $_POST)) {

$escenario_data['techomovible'] = $_POST['techomovible'];

}

if(array_key_exists('disponible', $_POST)) {

$escenario_data['disponible'] = $_POST['disponible'];
}


if(array_key_exists('observaciones', $_POST)) {

$escenario_data['observaciones'] = $_POST['observaciones'];
}


if(array_key_exists('id', $_POST)) {

$escenario_data['id'] = $_POST['id'];
}
} else if($_GET) {
if(array_key_exists('id', $_GET)) {
$escenario_data['id'] = $_GET['id'];
}

}
return $escenario_data;
}
handler();

?>