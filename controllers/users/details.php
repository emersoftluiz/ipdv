<?php
require_once('AltoRouter.php');
require_once('includes/includes.php');
require_once('services/users/users.php');
require_once('views/users/users.php');
require_once('views/admin/admin.php');

$router = new AltoRouter();
$router->setBasePath(BASEPATH);
$router->map('GET', '/users/details/[i:id]', 'users#details', 'users_details');
$match = $router->match();

if (check_admin_user()){
	if ($users = get_users_details($match['params']['id'])) {
		$mensagem = 'Mostrando detalhes do Usuário';
		do_html_header("Detalhes do Usuário", $mensagem);
        display_users_form($users, 'details');
	
    } else {
		$tipo = 'danger';
		$mensagem = 'Não foi possível recuperar os detalhes do Usuário';
		do_html_header("Detalhes do Usuário", $mensagem, "danger");
    }
	
	$users_array = get_users();
	display_users($users_array);
		
    do_html_footer();
} else {
    display_login_form();
}

?>
