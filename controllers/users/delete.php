<?php
require_once('AltoRouter.php');
require_once('includes/includes.php');
require_once('services/users/users.php');
require_once('views/users/users.php');
require_once('views/admin/admin.php');

$router = new AltoRouter();
$router->setBasePath(BASEPATH);
$router->map('GET', '/users/delete/[i:id]', 'users#delete', 'users_delete');
$match = $router->match();

if (check_admin_user()) {
	if (isset($match['params']['id'])) {
        if(delete_users($match['params']['id'])) {
			$tipo = 'success';
		    $mensagem = 'Usuário foi removido na base de dados.';
        } else {
			$tipo = 'danger';
		    $mensagem = 'Não foi possível excluir o Usuário. Isso geralmente ocorre porque está em uso.';
		}
    } else {
		$tipo = 'danger';
		$mensagem = 'Nenhum Usuário especificado. Por favor, tente novamente.';
    }
    do_html_header("Removendo um Usuário...", $mensagem, $tipo);
	
	$users_array = get_users();
	display_users($users_array);
	
	do_html_footer();
} else {
    display_login_form();
}
?>
