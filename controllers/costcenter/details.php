<?php
require_once('AltoRouter.php');
require_once('includes/includes.php');
require_once('services/costcenter/costcenter.php');
require_once('views/costcenter/costcenter.php');
require_once('views/admin/admin.php');

$router = new AltoRouter();
$router->setBasePath(BASEPATH);
$router->map('GET', '/costcenter/details/[i:id]', 'costcenter#details', 'costcenter_details');
$match = $router->match();

if (check_admin_user()){
	if ($name = get_costcenter_name($match['params']['id'])) {
		$mensagem = 'Mostrando detalhes do Centro de Custo';
		do_html_header("Detalhes do Centro de Custo", $mensagem);
        //$id = $match['params']['id'];
        $cat = compact('name', 'id');
        display_costcenter_form($cat, 'details');
	
    } else {
		$tipo = 'danger';
		$mensagem = 'Não foi possível recuperar os detalhes do Centro de Custo';
		do_html_header("Detalhes do Centro de Custo", $mensagem, "danger");
    }
	
	$cat_array = get_costcenters();
	display_costcenters($cat_array);
		
    do_html_footer();
} else {
    display_login_form();
}

?>
