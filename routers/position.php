<?php
//Cargos==========================================================================================================================================================================
$router->map( 'GET', DIRETORIO.'position/create', function() {
	require 'controllers/position/create.php';
});

$router->map( 'POST', DIRETORIO.'position/insert', function() {
	require 'controllers/position/insert.php';
});

$router->map( 'GET', DIRETORIO.'position/edit/[i:id]', function( $id ) {
	require 'controllers/position/edit.php';
});

$router->map( 'POST', DIRETORIO.'position/update', function() {
	require 'controllers/position/update.php';
});

$router->map( 'GET', DIRETORIO.'position/delete/[i:id]', function( $id ) {
	require 'controllers/position/delete.php';
});

$router->map( 'GET', DIRETORIO.'position/details/[i:id]', function( $id ) {
	require 'controllers/position/details.php';
});

$router->map( 'GET', DIRETORIO.'position/list', function() {
	require 'controllers/position/list.php';
});
?>