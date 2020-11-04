<?php
/********************************************************************
* Función getGCalendar (Eduardo Revilla Vaquero)                    *
* Genera url para la creación de un evento en google calendar.      *
*********************************************************************/function getGCalendarUrl($event){
$titulo = urlencode($event['titulo']);
$descripcion = urlencode($event['descripcion']);
$localizacion = urlencode($event['localizacion']);
$start=new DateTime($event['fecha_inicio'].' '.$event['hora_inicio'].' '.date_default_timezone_get());
$end=new DateTime($event['fecha_fin'].' '.$event['hora_fin'].' '.date_default_timezone_get()); $dates = urlencode($start->format("Ymd\THis")) . "/" . urlencode($end->format("Ymd\THis"));
$name = urlencode($event['nombre']);
$url = urlencode($event['url']);
$gCalUrl = "http://www.google.com/calendar/event?action=TEMPLATE&amp;text=$titulo&amp;dates=$dates&amp;details=$descripcion&amp;location=$localizacion&amp;trp=false&amp;sprop=$url&amp;sprop=name:$name";
return ($gCalUrl);
}
// array asociativo con los parametros mecesarios.
$evento = array(
  'titulo' => 'Belen vs Guayabal',
  'descripcion' => 'Descripcion del evento de prueba',
  'localizacion' => 'polideportivo de Guayabal',
  'fecha_inicio' => '2020-11-10', // Fecha de inicio de evento en formato AAAA-MM-DD
'hora_inicio'=>'17:30', // Hora Inicio del evento
'fecha_fin'=>'2020-11-10', // Fecha de fin de evento en formato AAAA-MM-DD
'hora_fin'=>'19:00', // Hora final del evento
'nombre'=>'dorgarciagir', // Nombre del sitio
'url'=>'http://dorgarciagir.mipropia.com/baloncesto/' // Url de la página
);
?>
<a href="<?php echo getGCalendarUrl($evento); ?>"><img src="https://www.google.com/calendar/images/ext/gc_button6_es.gif" border="0"></a>