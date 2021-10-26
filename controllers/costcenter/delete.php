<?php
require_once('AltoRouter.php');
require_once('includes/includes.php');
require_once('services/costcenter/costcenter.php');
require_once('views/costcenter/costcenter.php');
require_once('views/admin/admin.php');

$router = new AltoRouter();
$router->setBasePath(BASEPATH);
$router->map('GET', '/costcenter/delete/[i:id]', 'costcenter#delete', 'costcenter_delete');
$match = $router->match();

if (check_admin_user()) {
	if (isset($match['params']['id'])) {
        if(delete_costcenter($match['params']['id'])) {
			$tipo = 'success';
		    $mensagem = 'Centro de Custo foi removido na base de dados.';
        } else {
			$tipo = 'danger';
		    $mensagem = 'Não foi possível excluir o Centro de Custo. Isso geralmente ocorre porque está em uso.';
		}
    } else {
		$tipo = 'danger';
		$mensagem = 'Nenhum Centro de Custo especificado. Por favor, tente novamente.';
    }
    do_html_header("Removendo um Centro de Custo...", $mensagem, $tipo);
	
	$cat_array = get_costcenters();
	display_costcenters($cat_array);
	
	do_html_footer();
} else {
    display_login_form();
}
?>
