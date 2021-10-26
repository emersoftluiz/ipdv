<?php
require_once('includes/includes.php');
require_once('views/admin/admin.php');
 
if ((isset($_POST['username'])) && (isset($_POST['passwd']))){
	$username = $_POST['username'];
	$passwd = $_POST['passwd'];

	if (login($username, $passwd)){
	    $_SESSION['admin_user'] = $username;
	} else {
		$mensagem = 'Dados incorretos!';
		display_login_form($mensagem);
		exit;
	}
}

if (check_admin_user()){
	do_html_header("Administração", "Gerenciador de conteúdo da IPDV");
	display_dashboard();
	do_html_footer();
} else {
	display_login_form();
}
?>