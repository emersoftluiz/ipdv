<?php
require_once('AltoRouter.php');
require_once('includes/includes.php');
require_once('services/department/department.php');
require_once('views/users/users.php');
require_once('views/department/department.php');
require_once('views/admin/admin.php');

$router = new AltoRouter();
$router->setBasePath(BASEPATH);
$router->map('GET', '/department/users/[i:id]', 'department#users', 'department_users');
$match = $router->match();

if (check_admin_user()) {
	
	$name = get_department_name($match['params']['id']);
	
    do_html_header("Lista de Usuários do Departamento ".$name, "Listagem dos Usuários do Departamento ".$name, "info");
	
	$users_array = get_users_department($match['params']['id']);
	display_users($users_array);
	
	do_html_footer();
} else {
    display_login_form();
}
?>
