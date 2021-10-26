<?php
require_once('AltoRouter.php');
require_once('includes/includes.php');
require_once('services/department/department.php');
require_once('views/department/department.php');
require_once('views/admin/admin.php');

$router = new AltoRouter();
$router->setBasePath(BASEPATH);
$router->map('GET', '/department/details/[i:id]', 'department#details', 'department_details');
$match = $router->match();

if (check_admin_user()){
	if ($department = get_department_details($match['params']['id'])) {
		$mensagem = 'Mostrando detalhes do Departamento';
		do_html_header("Detalhes do Departamento", $mensagem);
        display_department_form($department, 'details');
	
    } else {
		$tipo = 'danger';
		$mensagem = 'Não foi possível recuperar os detalhes do Departamento';
		do_html_header("Detalhes do Departamento", $mensagem, "danger");
    }
	
	$department_array = get_departments();
	display_departments($department_array);
		
    do_html_footer();
} else {
    display_login_form();
}

?>