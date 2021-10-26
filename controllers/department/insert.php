<?php
require_once('includes/includes.php');
require_once('services/department/department.php');
require_once('views/department/department.php');
require_once('views/admin/admin.php');

if (check_admin_user()) {
	if (filled_out($_POST)){
        $name = $_POST['name'];
		$costcenter_id = $_POST['costcenter_id'];
        if(insert_department($name, $costcenter_id)){
			$tipo = 'success';
            $mensagem = 'Departamento "<b><i>'.htmlspecialchars($name).'</i></b>" foi adicionado na base de dados.';
        } else {
			$tipo = 'danger';
            $mensagem = 'Departamento "<b><i>'.htmlspecialchars($name).'</i></b>" não pôde ser adicionado na base de dados.';
        }
	} else {
		$tipo = 'danger';
		$mensagem = 'Você não preencheu o formulário. Por favor, tente novamente.';
	}
	do_html_header("Adicionando um Departamento...", $mensagem, $tipo);
	
	display_department_form();
	
	$cat_array = get_departments();
	display_departments($cat_array);
	
    do_html_footer();
} else {
	display_login_form();
}
?>
