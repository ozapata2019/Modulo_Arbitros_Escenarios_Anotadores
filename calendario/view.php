<?php

const MODULO = 'escenarios/';
# controladores
const SET_ESCENARIO = 'set';
const GET_ESCENARIO = 'get';
const GET_ESCENARIO_LISTAR = 'listar';
const DELETE_ESCENARIO = 'delete';
const EDIT_ESCENARIO = 'edit';
# vistas
const VIEW_SET_ESCENARIO = 'agregar';
const VIEW_GET_ESCENARIO = 'buscar';
const VIEW_GET_ESCENARIO_LISTAR = 'listar';
const VIEW_DELETE_ESCENARIO = 'borrar';
const VIEW_EDIT_ESCENARIO = 'modificar';


$diccionario = array(
'subtitle'=>array(
VIEW_SET_ESCENARIO=>'Nuevo Escenario',
VIEW_GET_ESCENARIO=>'Buscar Escenario',
VIEW_GET_ESCENARIO_LISTAR=>'Listar Escenario',
VIEW_DELETE_ESCENARIO=>'Eliminar Escenario',
VIEW_EDIT_ESCENARIO=>'Modificar Escenario'
),
'links_menu'=>array(
'VIEW_SET_ESCENARIO'=>MODULO.VIEW_SET_ESCENARIO.'/',
'VIEW_GET_ESCENARIO'=>MODULO.VIEW_GET_ESCENARIO.'/',
'VIEW_GET_ESCENARIO_LISTAR'=>MODULO.VIEW_GET_ESCENARIO_LISTAR.'/',
'VIEW_EDIT_ESCENARIO'=>MODULO.VIEW_EDIT_ESCENARIO.'/',
'VIEW_DELETE_ESCENARIO'=>MODULO.VIEW_DELETE_ESCENARIO.'/'

),
'form_actions'=>array(
'SET'=>'/baloncesto/'.MODULO.SET_ESCENARIO.'/',
'GET'=>'/baloncesto/'.MODULO.GET_ESCENARIO.'/',
'DELETE'=>'/baloncesto/'.MODULO.DELETE_ESCENARIO.'/',
'EDIT'=>'/baloncesto/'.MODULO.EDIT_ESCENARIO.'/'
)
);

function get_template($form='get') {
$file = '../site_media/html/escenario_'.$form.'.html';
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

if(array_key_exists('nombre', $data) && array_key_exists('id', $data)&& $vista==VIEW_EDIT_ESCENARIO) {
$mensaje = 'Editar Escenario:'.' '.$data['nombre'];
} else {
if(array_key_exists('mensaje', $data)) {
$mensaje = $data['mensaje'];
} else {
$mensaje = 'Ingrese el identificador del Escenario a buscar';
}
}

if ($vista==VIEW_DELETE_ESCENARIO) {
	$mensaje = 'Ingrese el identificador del Escenario a eliminar';
}

if ($vista==VIEW_SET_ESCENARIO) {
	$mensaje = 'Ingrese datos del Escenario ';
}

$html = str_replace('{mensaje}', $mensaje, $html);
print $html;
}
?>