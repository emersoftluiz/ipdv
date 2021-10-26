<?php
//Departamentos==========================================================================================================================================================================
$router->map( 'GET', DIRETORIO.'department/create', function() {
	require 'controllers/department/create.php';
});

$router->map( 'POST', DIRETORIO.'department/insert', function() {
	require 'controllers/department/insert.php';
});

$router->map( 'GET', DIRETORIO.'department/edit/[i:id]', function( $id ) {
	require 'controllers/department/edit.php';
});

$router->map( 'POST', DIRETORIO.'department/update', function() {
	require 'controllers/department/update.php';
});

$router->map( 'GET', DIRETORIO.'department/delete/[i:id]', function( $id ) {
	require 'controllers/department/delete.php';
});

$router->map( 'GET', DIRETORIO.'department/users/[i:id]', function( $id ) {
	require 'controllers/department/users.php';
});

$router->map( 'GET', DIRETORIO.'department/details/[i:id]', function( $id ) {
	require 'controllers/department/details.php';
});

$router->map( 'GET', DIRETORIO.'department/list', function() {
	require 'controllers/department/list.php';
});
?>