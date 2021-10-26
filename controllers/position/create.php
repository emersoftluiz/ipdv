<?php
require_once('includes/includes.php');
require_once('views/position/position.php');
require_once('services/position/position.php');
require_once('views/admin/admin.php');

if (check_admin_user()){
	do_html_header("Novo Cargo", "Adicione um novo Cargo", "info");
	display_position_form();
	
	$cat_array = get_positions();
	display_positions($cat_array);
	
	do_html_footer();
} else {
	display_login_form();
}
?>