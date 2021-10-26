<?php
require_once('includes/includes.php');
require_once('views/costcenter/costcenter.php');
require_once('services/costcenter/costcenter.php');
require_once('views/admin/admin.php');

if (check_admin_user()){
	do_html_header("Lista de Centro de Custos", "Listagem dos Centro de Custos", "info");
	
	$cat_array = get_costcenters();
	display_costcenters($cat_array);
	
	do_html_footer();
} else {
	display_login_form();
}
?>