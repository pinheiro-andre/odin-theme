<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

include __DIR__ . "/class-SignsGame.php";

//echo var_dump($_POST);

$obj = new SignsGame();

if( $_POST['sign1'] && $_POST['sign2'] )
	echo $obj->play($_POST['sign1'], $_POST['sign2']);
?>
