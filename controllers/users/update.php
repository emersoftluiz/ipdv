<?php
require_once('includes/includes.php');
require_once('services/users/users.php');
require_once('views/users/users.php');
require_once('views/admin/admin.php');

if(check_admin_user()) {
	
	if(isset($_POST['id'])) { $id = $_POST['id']; } else { $id = ''; }
	if(isset($_POST['name'])){ $name = $_POST['name']; } else { $name = ''; }
	if(isset($_POST['email'])){ $email = $_POST['email']; } else { $email = ''; }
	if(isset($_POST['passwd'])){ $passwd = $_POST['passwd']; } else { $passwd = ''; }
	if(isset($_POST['passwd2'])){ $passwd2 = $_POST['passwd2']; } else { $passwd2 = ''; }
	if(isset($_POST['position_id'])){ $position_id = $_POST['position_id']; } else { $position_id = ''; }
	if(isset($_POST['department_id'])){ $department_id = $_POST['department_id']; } else { $department_id = ''; }
	if(isset($_POST['costcenter_id'])){ $costcenter_id = $_POST['costcenter_id']; } else { $costcenter_id = ''; }
	if(isset($_POST['endereco'])){ $endereco = $_POST['endereco']; } else { $endereco = ''; }
	if(isset($_POST['bairro'])){ $bairro = $_POST['bairro']; } else { $bairro = ''; }
	if(isset($_POST['cep'])){ $cep = $_POST['cep']; } else { $cep = ''; }
	if(isset($_POST['estado'])){ $estado = $_POST['estado']; } else { $estado = ''; }
	if(isset($_POST['cidade'])){ $cidade = $_POST['cidade']; } else { $cidade = ''; }
	if(isset($_POST['celular'])){ $celular = $_POST['celular']; } else { $celular = ''; }
	if(isset($_POST['complemento'])){ $complemento = $_POST['complemento']; } else { $complemento = ''; }
	if(isset($_POST['telefone'])){ $telefone = $_POST['telefone']; } else { $telefone = ''; }
	if(isset($_POST['telefone2'])){ $telefone2 = $_POST['telefone2']; } else { $telefone2 = ''; }
	if(isset($_POST['celular2'])){ $celular2 = $_POST['celular2']; } else { $celular2 = ''; }
	if(isset($_POST['informacoes_adicionais'])){ $informacoes_adicionais = $_POST['informacoes_adicionais']; } else { $informacoes_adicionais = ''; }
	
	if ((!empty($name))&&(!empty($position_id))&&(!empty($department_id))&&(!empty($costcenter_id))&&(!empty($endereco))&&(!empty($bairro))&&(!empty($cep))&&(!empty($estado))&&(!empty($cidade))&&(!empty($celular))) {
		
		if(((!empty($passwd))&&(empty($passwd2)))||((empty($passwd))&&(!empty($passwd2)))) {
			$tipo = 'danger';
            $mensagem = 'Se deseja alterar a senha, é necessário digitar a senha e confirmar a senha no campo "Repetir a Senha"';
		} else if((!empty($passwd))&&(!empty($passwd2))&&($passwd != $passwd2)) {
			$tipo = 'danger';
            $mensagem = 'As senhas que você digitou não coincidem. Tente novamente.';
        } else if((!empty($passwd))&&(!empty($passwd2))&&((strlen($passwd) < 6) || (strlen($passwd) > 16))) {
			$tipo = 'danger';
            $mensagem = 'A senha deve ter entre 6 e 16 caracteres. Por favor tente novamente.';
		} else if(update_users($id, $name, $passwd, $position_id, $department_id, $costcenter_id, $email, $endereco, $complemento, $bairro, $cep, $estado, $cidade, $telefone, $telefone2, $celular, $celular2, $informacoes_adicionais)) {
			$tipo = 'success';
		    $mensagem = 'Usuário foi alterado na base de dados.';
		} else {
			$tipo = 'danger';
		    $mensagem = 'Usuário não pôde ser alterado na base de dados.';
		}
	} else {
		$tipo = 'danger';
		$mensagem = 'Você não preencheu o formulário. Por favor, tente novamente.';
	}
	do_html_header("Alterando Usuário...", $mensagem, $tipo);
	
	if($tipo == 'danger'){
		if ($users = get_users_details($id)) {
            display_users_form($users);
		}			
    }
	
	$users_array = get_users();
	display_users($users_array);
	
	do_html_footer();
} else {
	display_login_form();
}
?>
