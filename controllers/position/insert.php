<?php
require_once('includes/includes.php');
require_once('services/position/position.php');
require_once('views/position/position.php');
require_once('views/admin/admin.php');

if (check_admin_user()) {
	if (filled_out($_POST)){
        $name = $_POST['name'];
        if(insert_position($name)){
			$tipo = 'success';
            $mensagem = 'Cargo "<b><i>'.htmlspecialchars($name).'</i></b>" foi adicionado na base de dados.';
        } else {
			$tipo = 'danger';
            $mensagem = 'Cargo "<b><i>'.htmlspecialchars($name).'</i></b>" não pôde ser adicionado na base de dados.';
        }
	} else {
		$tipo = 'danger';
		$mensagem = 'Você não preencheu o formulário. Por favor, tente novamente.';
	}
	do_html_header("Adicionando um Cargo...", $mensagem, $tipo);
	
	display_position_form();
	
	$cat_array = get_positions();
	display_positions($cat_array);
	
    do_html_footer();
} else {
	display_login_form();
}
?>
