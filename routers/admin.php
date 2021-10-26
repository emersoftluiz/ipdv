<?php
//Admin===============================================================================================================================================================================
$router->map( 'GET', DIRETORIO.'admin', function() {
	require 'controllers/admin/index.php';
});
$router->map( 'POST', DIRETORIO.'admin', function() {
	require 'controllers/admin/index.php';
});
$router->map( 'GET', DIRETORIO.'logout', function() {
	require 'controllers/admin/logout.php';
});
?>