<?php
require_once('includes/includes.php');
require_once('views/admin/admin.php');

if(isset($_SESSION['admin_user'])){
	$old_user = $_SESSION['admin_user'];
} else {
	$old_user = '';
}
unset($_SESSION['admin_user']);
session_destroy();

if (!empty($old_user)) {
	$mensagem = 'Você saiu!';
} else {
	$mensagem = 'Não logado!';
}

display_login_form($mensagem);

?>
