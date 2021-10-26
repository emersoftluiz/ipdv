<?php
require_once('AltoRouter.php');
require_once('includes/includes.php');
require_once('services/position/position.php');
require_once('views/position/position.php');
require_once('views/admin/admin.php');

$router = new AltoRouter();
$router->setBasePath(BASEPATH);
$router->map('GET', '/position/delete/[i:id]', 'position#delete', 'position_delete');
$match = $router->match();

if (check_admin_user()) {
	if (isset($match['params']['id'])) {
        if(delete_position($match['params']['id'])) {
			$tipo = 'success';
		    $mensagem = 'Cargo foi removido na base de dados.';
        } else {
			$tipo = 'danger';
		    $mensagem = 'Não foi possível excluir o Cargo. Isso geralmente ocorre porque está em uso.';
		}
    } else {
		$tipo = 'danger';
		$mensagem = 'Nenhum Cargo especificado. Por favor, tente novamente.';
    }
    do_html_header("Removendo um Cargo...", $mensagem, $tipo);
	
	$cat_array = get_positions();
	display_positions($cat_array);
	
	do_html_footer();
} else {
    display_login_form();
}
?>
