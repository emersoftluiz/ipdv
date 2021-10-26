<?php
require_once('includes/includes.php');
require_once('services/position/position.php');
require_once('views/position/position.php');
require_once('views/admin/admin.php');

if(check_admin_user()) {
	if (filled_out($_POST)) {
        if(update_position($_POST['id'], $_POST['name'])) {
			$tipo = 'success';
		    $mensagem = 'Cargo foi alterado na base de dados.';
		} else {
			$tipo = 'danger';
		    $mensagem = 'Cargo não pôde ser alterado na base de dados.';
		}
	} else {
		$tipo = 'danger';
		$mensagem = 'Você não preencheu o formulário. Por favor, tente novamente.';
	}
	do_html_header("Alterando Cargo...", $mensagem, $tipo);
	
	$cat_array = get_positions();
	display_positions($cat_array);
	
	do_html_footer();
} else {
	display_login_form();
}
?>
