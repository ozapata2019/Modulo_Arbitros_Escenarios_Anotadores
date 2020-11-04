<?php

const MODULO = 'agenda/';
# controladores
const SET_AGENDA = 'set';
const GET_AGENDA = 'get';
const GET_AGENDA_LISTAR = 'listar';
const DELETE_AGENDA = 'delete';
const EDIT_AGENDA = 'edit';
# vistas
const VIEW_SET_AGENDA = 'agregar';
const VIEW_GET_AGENDA = 'buscar';
const VIEW_GET_AGENDA_LISTAR = 'listar';
const VIEW_DELETE_AGENDA = 'borrar';
const VIEW_EDIT_AGENDA = 'modificar';


$diccionario = array(
'subtitle'=>array(
VIEW_SET_AGENDA=>'Nuevo AGENDA',
VIEW_GET_AGENDA=>'Buscar AGENDA',
VIEW_GET_AGENDA_LISTAR=>'Listar agenda',
VIEW_DELETE_AGENDA=>'Eliminar AGENDA',
VIEW_EDIT_AGENDA=>'Modificar AGENDA'
),
'links_menu'=>array(
'VIEW_SET_AGENDA'=>MODULO.VIEW_SET_AGENDA.'/',
'VIEW_GET_AGENDA'=>MODULO.VIEW_GET_AGENDA.'/',
'VIEW_GET_AGENDA_LISTAR'=>MODULO.VIEW_GET_AGENDA_LISTAR.'/',
'VIEW_EDIT_AGENDA'=>MODULO.VIEW_EDIT_AGENDA.'/',
'VIEW_DELETE_AGENDA'=>MODULO.VIEW_DELETE_AGENDA.'/'

),
'form_actions'=>array(
'SET'=>'/baloncesto/'.MODULO.SET_AGENDA.'/',
'GET'=>'/baloncesto/'.MODULO.GET_AGENDA.'/',
'DELETE'=>'/baloncesto/'.MODULO.DELETE_AGENDA.'/',
'EDIT'=>'/baloncesto/'.MODULO.EDIT_AGENDA.'/'
)
);


/*
function get_template($form='get') {
$file = '../site_media/html/AGENDA_'.$form.'.html';
$template = file_get_contents($file);
return $template;
}
*/

function render_dinamic_data($html, $data) {
foreach ($data as $clave=>$valor) {
$html = str_replace('{'.$clave.'}', $valor, $html);
}
return $html;
}

/*
function retornar_vista($vista, $data=array()) {
global $diccionario;
$html = get_template('template');
$html = str_replace('{subtitulo}', $diccionario['subtitle'][$vista],$html);
$html = str_replace('{formulario}', get_template($vista), $html);
$html = render_dinamic_data($html, $diccionario['form_actions']);
$html = render_dinamic_data($html, $diccionario['links_menu']);
$html = render_dinamic_data($html, $data);

// render {mensaje}

if(array_key_exists('nombre', $data)&& array_key_exists('apellido', $data)&& array_key_exists('identificacion', $data)&& $vista==VIEW_EDIT_AGENDA) {
$mensaje = 'Editar AGENDA:'.' '.$data['nombre'].' '.$data['apellido'];
} else {
if(array_key_exists('mensaje', $data)) {
$mensaje = $data['mensaje'];
} else {
$mensaje = 'Ingrese la cédula del AGENDA a buscar';
}
}

if ($vista==VIEW_DELETE_AGENDA) {
	$mensaje = 'Ingrese la cédula del AGENDA a eliminar';
}

if ($vista==VIEW_SET_AGENDA) {
	$mensaje = 'Ingrese datos del AGENDA ';
}

$html = str_replace('{mensaje}', $mensaje, $html);
print $html;
}
*/
?>