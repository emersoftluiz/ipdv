<?php
require_once('includes/includes.php');
require_once('views/users/users.php');
require_once('services/users/users.php');
require_once('views/admin/admin.php');

if (check_admin_user()){
	do_html_header("Lista de Usuários", "Listagem dos Usuários", "info");
	
	$users_array = get_users();
	display_users($users_array);
	
	do_html_footer();
} else {
	display_login_form();
}
?>