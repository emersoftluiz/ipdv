<?php
require_once('AltoRouter.php');
require_once('includes/includes.php');
require_once('services/position/position.php');
require_once('views/position/position.php');
require_once('views/admin/admin.php');

$router = new AltoRouter();
$router->setBasePath(BASEPATH);
$router->map('GET', '/position/details/[i:id]', 'position#details', 'position_details');
$match = $router->match();

if (check_admin_user()){
	if ($name = get_position_name($match['params']['id'])) {
		$mensagem = 'Mostrando detalhes do Cargo';
		do_html_header("Detalhes do Cargo", $mensagem);
        //$id = $match['params']['id'];
        $cat = compact('name', 'id');
        display_position_form($cat, 'details');
	
    } else {
		$tipo = 'danger';
		$mensagem = 'Não foi possível recuperar os detalhes do Cargo';
		do_html_header("Detalhes do Cargo", $mensagem, "danger");
    }
	
	$cat_array = get_positions();
	display_positions($cat_array);
		
    do_html_footer();
} else {
    display_login_form();
}

?>
