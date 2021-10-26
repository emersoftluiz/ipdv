<?php
require_once('includes/includes.php');
require_once('services/costcenter/costcenter.php');
require_once('views/costcenter/costcenter.php');
require_once('views/admin/admin.php');

if(check_admin_user()) {
	if (filled_out($_POST)) {
        if(update_costcenter($_POST['id'], $_POST['name'])) {
			$tipo = 'success';
		    $mensagem = 'Centro de Custo foi alterado na base de dados.';
		} else {
			$tipo = 'danger';
		    $mensagem = 'Centro de Custo não pôde ser alterado na base de dados.';
		}
	} else {
		$tipo = 'danger';
		$mensagem = 'Você não preencheu o formulário. Por favor, tente novamente.';
	}
	do_html_header("Alterando Centro de Custo...", $mensagem, $tipo);
	
	$cat_array = get_costcenters();
	display_costcenters($cat_array);
	
	do_html_footer();
} else {
	display_login_form();
}
?>
