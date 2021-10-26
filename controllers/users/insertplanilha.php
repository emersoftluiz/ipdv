<?php
require_once('includes/includes.php');
require_once('services/users/users.php');
require_once('views/users/users.php');
require_once('views/admin/admin.php');

//Inserindo usuários da planilha
if (check_admin_user()) {
	
        $url = '';
		
		if(insert_users_planilha($url)){
			$tipo = 'success';
            $mensagem = 'Usuários foram importados para a base de dados.';
        } else {
			$tipo = 'danger';
            $mensagem = 'Usuários não foram importados para a base de dados.';
        }
		
	do_html_header("Importar usuários da planilha...", $mensagem, $tipo);
	
	display_users_form();
	
	$users_array = get_users();
	display_users($users_array);
	
    do_html_footer();
} else {
	display_login_form();
}
?>
