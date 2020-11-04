<?php

const MODULO = 'arbitros/';
# controladores
const SET_ARBITRO = 'set';
const GET_ARBITRO = 'get';
const GET_ARBITRO_LISTAR = 'listar';
const DELETE_ARBITRO = 'delete';
const EDIT_ARBITRO = 'edit';
# vistas
const VIEW_SET_ARBITRO = 'agregar';
const VIEW_GET_ARBITRO = 'buscar';
const VIEW_GET_ARBITRO_LISTAR = 'listar';
const VIEW_DELETE_ARBITRO = 'borrar';
const VIEW_EDIT_ARBITRO = 'modificar';


$diccionario = array(
'subtitle'=>array(
VIEW_SET_ARBITRO=>'Nuevo Arbitro',
VIEW_GET_ARBITRO=>'Buscar Arbitro',
VIEW_GET_ARBITRO_LISTAR=>'Listar Arbitros',
VIEW_DELETE_ARBITRO=>'Eliminar Arbitro',
VIEW_EDIT_ARBITRO=>'Modificar Arbitro'
),
'links_menu'=>array(
'VIEW_SET_ARBITRO'=>MODULO.VIEW_SET_ARBITRO.'/',
'VIEW_GET_ARBITRO'=>MODULO.VIEW_GET_ARBITRO.'/',
'VIEW_GET_ARBITRO_LISTAR'=>MODULO.VIEW_GET_ARBITRO_LISTAR.'/',
'VIEW_EDIT_ARBITRO'=>MODULO.VIEW_EDIT_ARBITRO.'/',
'VIEW_DELETE_ARBITRO'=>MODULO.VIEW_DELETE_ARBITRO.'/'

),
'form_actions'=>array(
'SET'=>'/baloncesto/'.MODULO.SET_ARBITRO.'/',
'GET'=>'/baloncesto/'.MODULO.GET_ARBITRO.'/',
'DELETE'=>'/baloncesto/'.MODULO.DELETE_ARBITRO.'/',
'EDIT'=>'/baloncesto/'.MODULO.EDIT_ARBITRO.'/'
)
);

function get_template($form='get') {
$file = '../site_media/html/arbitro_'.$form.'.html';
$template = file_get_contents($file);
return $template;
}

function render_dinamic_data($html, $data) {
foreach ($data as $clave=>$valor) {
$html = str_replace('{'.$clave.'}', $valor, $html);
}
return $html;
}

function retornar_vista($vista, $data=array()) {
global $diccionario;
$html = get_template('template');
$html = str_replace('{subtitulo}', $diccionario['subtitle'][$vista],$html);
$html = str_replace('{formulario}', get_template($vista), $html);
$html = render_dinamic_data($html, $diccionario['form_actions']);
$html = render_dinamic_data($html, $diccionario['links_menu']);
$html = render_dinamic_data($html, $data);

// render {mensaje}

if(array_key_exists('nombre', $data)&& array_key_exists('apellido', $data)&& array_key_exists('identificacion', $data)&& $vista==VIEW_EDIT_ARBITRO) {
$mensaje = 'Editar Arbitro:'.' '.$data['nombre'].' '.$data['apellido'];
} else {
if(array_key_exists('mensaje', $data)) {
$mensaje = $data['mensaje'];
} else {
$mensaje = 'Ingrese la cédula del Arbitro a buscar';
}
}

if ($vista==VIEW_DELETE_ARBITRO) {
	$mensaje = 'Ingrese la cédula del Arbitro a eliminar';
}

if ($vista==VIEW_SET_ARBITRO) {
	$mensaje = 'Ingrese datos del Arbitro ';
}

$html = str_replace('{mensaje}', $mensaje, $html);
print $html;
}
?>