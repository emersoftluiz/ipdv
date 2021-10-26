<?php
require_once('AltoRouter.php');
require_once('includes/includes.php');
require_once('services/department/department.php');
require_once('views/department/department.php');
require_once('views/admin/admin.php');

$router = new AltoRouter();
$router->setBasePath(BASEPATH);
$router->map('GET', '/department/edit/[i:id]', 'department#edit', 'department_edit');
$match = $router->match();

if (check_admin_user()){
	if ($department = get_department_details($match['params']['id'])) {
		$mensagem = 'Altere os dados do Departamento';
		do_html_header("Alterar Departamento", $mensagem);
        display_department_form($department);
	
    } else {
		$tipo = 'danger';
		$mensagem = 'Não foi possível recuperar os detalhes do Departamento';
		do_html_header("Alterar Departamento", $mensagem, "danger");
    }
	
	$department_array = get_departments();
	display_departments($department_array);
		
    do_html_footer();
} else {
    display_login_form();
}

?>