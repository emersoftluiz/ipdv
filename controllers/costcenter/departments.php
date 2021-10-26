<?php
require_once('AltoRouter.php');
require_once('includes/includes.php');
require_once('services/costcenter/costcenter.php');
require_once('views/department/department.php');
require_once('views/costcenter/costcenter.php');
require_once('views/admin/admin.php');

$router = new AltoRouter();
$router->setBasePath(BASEPATH);
$router->map('GET', '/costcenter/departments/[i:id]', 'costcenter#departments', 'costcenter_departments');
$match = $router->match();

if (check_admin_user()) {
	
	$name = get_costcenter_name($match['params']['id']);
	
    do_html_header("Lista de Departamentos do Centro de Custo ".$name, "Listagem dos Departamentos do Centro de Custo ".$name, "info");
	
	$department_array = get_department_costcenter($match['params']['id']);
	display_departments($department_array);
	
	do_html_footer();
} else {
    display_login_form();
}
?>
