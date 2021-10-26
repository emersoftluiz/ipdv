<?php
//Users===============================================================================================================================================================================
$router->map( 'GET', DIRETORIO, function() {
	require 'controllers/users/login.php';
});
$router->map( 'POST', DIRETORIO, function() {
	require 'controllers/users/login.php';
});
$router->map( 'GET', DIRETORIO.'logoff', function() {
	require 'controllers/users/logoff.php';
});

$router->map( 'GET', DIRETORIO.'users/create', function() {
	require 'controllers/users/create.php';
});

$router->map( 'POST', DIRETORIO.'users/insert', function() {
	require 'controllers/users/insert.php';
});

$router->map( 'GET', DIRETORIO.'users/edit/[i:id]', function( $id ) {
	require 'controllers/users/edit.php';
});

$router->map( 'POST', DIRETORIO.'users/update', function() {
	require 'controllers/users/update.php';
});

$router->map( 'GET', DIRETORIO.'users/delete/[i:id]', function( $id ) {
	require 'controllers/users/delete.php';
});

$router->map( 'GET', DIRETORIO.'users/details/[i:id]', function( $id ) {
	require 'controllers/users/details.php';
});

$router->map( 'GET', DIRETORIO.'users/list', function() {
	require 'controllers/users/list.php';
});

$router->map( 'POST', DIRETORIO.'users/insertplanilha', function() {
	require 'controllers/users/insertplanilha.php';
});
?>