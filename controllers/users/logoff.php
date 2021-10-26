<?php
require_once('includes/includes.php');
require_once('views/user/user.php');
 
if(isset($_SESSION['valid_user'])){
	$old_user = $_SESSION['valid_user'];
}

unset($_SESSION['valid_user']);
$result_dest = session_destroy();

if (!empty($old_user)){
	if ($result_dest){
		$mensagem = 'Você saiu!';
	} else {
		$mensagem = 'Erro!';
	}
} else {
	$mensagem = 'Não logado!';
}

display_login_form($mensagem);

?>
