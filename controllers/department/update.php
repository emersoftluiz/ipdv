<?php
require_once('includes/includes.php');
require_once('services/department/department.php');
require_once('views/department/department.php');
require_once('views/admin/admin.php');

if(check_admin_user()) {
	if (filled_out($_POST)) {
        if(update_department($_POST['id'], $_POST['name'], $_POST['costcenter_id'])) {
			$tipo = 'success';
		    $mensagem = 'Departamento foi alterado na base de dados.';
		} else {
			$tipo = 'danger';
		    $mensagem = 'Departamento não pôde ser alterado na base de dados.';
		}
	} else {
		$tipo = 'danger';
		$mensagem = 'Você não preencheu o formulário. Por favor, tente novamente.';
	}
	do_html_header("Alterando Departamento...", $mensagem, $tipo);
	
	$cat_array = get_departments();
	display_departments($cat_array);
	
	do_html_footer();
} else {
	display_login_form();
}
?>
