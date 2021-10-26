<?php
require_once('includes/includes.php');
require_once('services/costcenter/costcenter.php');
require_once('views/costcenter/costcenter.php');
require_once('views/admin/admin.php');

if (check_admin_user()) {
	if (filled_out($_POST)){
        $name = $_POST['name'];
        if(insert_costcenter($name)){
			$tipo = 'success';
            $mensagem = 'Centro de Custo "<b><i>'.htmlspecialchars($name).'</i></b>" foi adicionado na base de dados.';
        } else {
			$tipo = 'danger';
            $mensagem = 'Centro de Custo "<b><i>'.htmlspecialchars($name).'</i></b>" não pôde ser adicionado na base de dados.';
        }
	} else {
		$tipo = 'danger';
		$mensagem = 'Você não preencheu o formulário. Por favor, tente novamente.';
	}
	do_html_header("Adicionando um Centro de Custo...", $mensagem, $tipo);
	
	display_costcenter_form();
	
	$cat_array = get_costcenters();
	display_costcenters($cat_array);
	
    do_html_footer();
} else {
	display_login_form();
}
?>
