<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=baloncesto;charset=utf8', 'root', '123');
}
catch(Exception $e)
{
        die('Error : '.$e->getMessage());
}
