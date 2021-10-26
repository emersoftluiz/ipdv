<?php
require_once('AltoRouter.php');
require_once('includes/includes.php');
require_once('services/department/department.php');
require_once('views/department/department.php');
require_once('views/admin/admin.php');

$router = new AltoRouter();
$router->setBasePath(BASEPATH);
$router->map('GET', '/department/delete/[i:id]', 'department#delete', 'department_delete');
$match = $router->match();

if (check_admin_user()) {
	if (isset($match['params']['id'])) {
        if(delete_department($match['params']['id'])) {
			$tipo = 'success';
		    $mensagem = 'Departamento foi removido na base de dados.';
        } else {
			$tipo = 'danger';
		    $mensagem = 'Não foi possível excluir o Departamento. Isso geralmente ocorre porque está em uso.';
		}
    } else {
		$tipo = 'danger';
		$mensagem = 'Nenhum Departamento especificado. Por favor, tente novamente.';
    }
    do_html_header("Removendo um Departamento...", $mensagem, $tipo);
	
	$cat_array = get_departments();
	display_departments($cat_array);
	
	do_html_footer();
} else {
    display_login_form();
}
?>
