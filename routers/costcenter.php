<?php
//Departamentos==========================================================================================================================================================================
$router->map( 'GET', DIRETORIO.'costcenter/create', function() {
	require 'controllers/costcenter/create.php';
});

$router->map( 'POST', DIRETORIO.'costcenter/insert', function() {
	require 'controllers/costcenter/insert.php';
});

$router->map( 'GET', DIRETORIO.'costcenter/edit/[i:id]', function( $id ) {
	require 'controllers/costcenter/edit.php';
});

$router->map( 'POST', DIRETORIO.'costcenter/update', function() {
	require 'controllers/costcenter/update.php';
});

$router->map( 'GET', DIRETORIO.'costcenter/delete/[i:id]', function( $id ) {
	require 'controllers/costcenter/delete.php';
});

$router->map( 'GET', DIRETORIO.'costcenter/departments/[i:id]', function( $id ) {
	require 'controllers/costcenter/departments.php';
});

$router->map( 'GET', DIRETORIO.'costcenter/details/[i:id]', function( $id ) {
	require 'controllers/costcenter/details.php';
});

$router->map( 'GET', DIRETORIO.'costcenter/list', function() {
	require 'controllers/costcenter/list.php';
});
?>