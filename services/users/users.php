<?php
function get_users_details($id) {
	if ((!$id) || ($id=='')) {
		return false;
    }
    $conn = db_connect();
    $query = "select * from user where id='".$conn->real_escape_string($id)."'";
    $result = @$conn->query($query);
    if (!$result) {
        return false;
    }
    $result = @$result->fetch_assoc();
    return $result;
}

function insert_users($name, $passwd, $position_id, $department_id, $costcenter_id, $email, $endereco, $complemento, $bairro, $cep, $estado, $cidade, $telefone, $telefone2, $celular, $celular2, $informacoes_adicionais) {
	$conn = db_connect();   
    $query = "select id from user where email='".$conn->real_escape_string($email)."'";
    $result = $conn->query($query);
    if ((!$result) || ($result->num_rows!=0)) {
        return false;
    }
	
	$query = "
	INSERT INTO `user` (`position_id`, `department_id`, `costcenter_id`, `name`, `passwd`, `email`, `endereco`, `complemento`, `bairro`, `cep`, `estado`, `cidade`, `telefone`, `telefone2`, `celular`, `celular2`, `informacoes_adicionais`)
	VALUES(
	'".$conn->real_escape_string($position_id)."',
	'".$conn->real_escape_string($department_id)."',
	'".$conn->real_escape_string($costcenter_id)."',
	'".$conn->real_escape_string($name)."',
	sha1('".$conn->real_escape_string($passwd)."'),
	'".$conn->real_escape_string($email)."',
	'".$conn->real_escape_string($endereco)."',
	'".$conn->real_escape_string($complemento)."',
	'".$conn->real_escape_string($bairro)."',
	'".$conn->real_escape_string($cep)."',
	'".$conn->real_escape_string($estado)."',
	'".$conn->real_escape_string($cidade)."',
	'".$conn->real_escape_string($telefone)."',
	'".$conn->real_escape_string($telefone2)."',
	'".$conn->real_escape_string($celular)."',
	'".$conn->real_escape_string($celular2)."',
	'".$conn->real_escape_string($informacoes_adicionais)."')";
	
	//print $query;
		
    $result = $conn->query($query);
    if (!$result) {
        return false;
    } else {
        return true;
    }
}

function get_users() {
	$conn = db_connect();
   
    $query = "
    SELECT user.id,
           user.name as name,
		   user.email as email,
           department.name as departamento
    FROM user
    INNER JOIN department ON department.id = user.department_id";
   
    $result = @$conn->query($query);
    if (!$result) {
        return false;
    }
    $num_cats = @$result->num_rows;
    if ($num_cats == 0) {
        return false;
    }
    $result = db_result_to_array($result);
    return $result;
}

function delete_users($id) {
	
	$conn = db_connect(); 
    $query = "delete from user where id='".$conn->real_escape_string($id)."'";
    $result = @$conn->query($query);
    if (!$result) {
        return false;
    } else {
        return true;
    }
}

function update_users($id, $name, $passwd, $position_id, $department_id, $costcenter_id, $email, $endereco, $complemento, $bairro, $cep, $estado, $cidade, $telefone, $telefone2, $celular, $celular2, $informacoes_adicionais) {
	
	$conn = db_connect();

    if(!empty($passwd)){
		
		$query = "update user
                  set position_id = '".$conn->real_escape_string($position_id)."',
				      department_id = '".$conn->real_escape_string($department_id)."',
				      costcenter_id = '".$conn->real_escape_string($costcenter_id)."',
				      name = '".$conn->real_escape_string($name)."',
					  passwd = sha1('".$conn->real_escape_string($passwd)."'),
					  endereco = '".$conn->real_escape_string($endereco)."',
					  complemento = '".$conn->real_escape_string($complemento)."',
					  bairro = '".$conn->real_escape_string($bairro)."',
					  cep = '".$conn->real_escape_string($cep)."',
					  estado = '".$conn->real_escape_string($estado)."',
					  cidade = '".$conn->real_escape_string($cidade)."',
					  telefone = '".$conn->real_escape_string($telefone)."',
					  telefone2 = '".$conn->real_escape_string($telefone2)."',
					  celular = '".$conn->real_escape_string($celular)."',
					  celular2 = '".$conn->real_escape_string($celular2)."',
					  informacoes_adicionais = '".$conn->real_escape_string($informacoes_adicionais)."'
                  where id = '".$conn->real_escape_string($id)."'";
	} else {
		$query = "update user
                  set position_id = '".$conn->real_escape_string($position_id)."',
				      department_id = '".$conn->real_escape_string($department_id)."',
				      costcenter_id = '".$conn->real_escape_string($costcenter_id)."',
					  name = '".$conn->real_escape_string($name)."',
					  endereco = '".$conn->real_escape_string($endereco)."',
					  complemento = '".$conn->real_escape_string($complemento)."',
					  bairro = '".$conn->real_escape_string($bairro)."',
					  cep = '".$conn->real_escape_string($cep)."',
					  estado = '".$conn->real_escape_string($estado)."',
					  cidade = '".$conn->real_escape_string($cidade)."',
					  telefone = '".$conn->real_escape_string($telefone)."',
					  telefone2 = '".$conn->real_escape_string($telefone2)."',
					  celular = '".$conn->real_escape_string($celular)."',
					  celular2 = '".$conn->real_escape_string($celular2)."',
					  informacoes_adicionais = '".$conn->real_escape_string($informacoes_adicionais)."'
                  where id = '".$conn->real_escape_string($id)."'";
	}
	
	//var_dump($query);exit;

    $result = @$conn->query($query);
    if (!$result) {
        return false;
    } else {
        return true;
    }
}

function insert_users_planilha($url) {
	
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', true);

	require_once __DIR__.'/SimpleXLSX.php';
	
	$conn = db_connect();

	if (isset($_FILES['arquivo'])) {
		
		if ( $xlsx = SimpleXLSX::parse( $_FILES['arquivo']['tmp_name'] ) ) {

			$dim = $xlsx->dimension();
			$cols = $dim[0];

			foreach ( $xlsx->rows() as $k => $r ) {
				if ($k == 0) continue; 
				
				$query = "
				INSERT INTO `user`
					(`id`, `position_id`, `department_id`, `costcenter_id`, `name`, `passwd`, `email`, `endereco`, `complemento`, `bairro`, `cep`, `estado`, `cidade`, `telefone`, `celular`)
				VALUES
					(NULL,
					'".$conn->real_escape_string( isset( $r[ 0 ] ) ? $r[ 0 ] : '' )."',
					'".$conn->real_escape_string( isset( $r[ 1 ] ) ? $r[ 1 ] : '' )."',
					'".$conn->real_escape_string( isset( $r[ 2 ] ) ? $r[ 2 ] : '' )."',
					'".$conn->real_escape_string( isset( $r[ 3 ] ) ? $r[ 3 ] : '' )."',
					sha1('".$conn->real_escape_string( isset( $r[ 4 ] ) ? $r[ 4 ] : '' )."'),
					'".$conn->real_escape_string( isset( $r[ 5 ] ) ? $r[ 5 ] : '' )."',
					'".$conn->real_escape_string( isset( $r[ 6 ] ) ? $r[ 6 ] : '' )."',
					'".$conn->real_escape_string( isset( $r[ 7 ] ) ? $r[ 7 ] : '' )."',
					'".$conn->real_escape_string( isset( $r[ 8 ] ) ? $r[ 8 ] : '' )."',
					'".$conn->real_escape_string( isset( $r[ 9 ] ) ? $r[ 9 ] : '' )."',
					'".$conn->real_escape_string( isset( $r[ 10 ] ) ? $r[ 10 ] : '' )."',
					'".$conn->real_escape_string( isset( $r[ 11 ] ) ? $r[ 11 ] : '' )."',
					'".$conn->real_escape_string( isset( $r[ 12 ] ) ? $r[ 12 ] : '' )."',
					'".$conn->real_escape_string( isset( $r[ 13 ] ) ? $r[ 13 ] : '' )."')";
					
				//echo $query.'<br />';
				
				$result = $conn->query($query);
				/*
				if (!$result) {
					echo '<font color="red"><b>Não foi possível importar o usuário '.( isset( $r[ 3 ] ) ? $r[ 3 ] : '' ).'</b></font><br />';
				} else {
					echo '<font color="green"><b>Usuário '.( isset( $r[ 3 ] ) ? $r[ 3 ] : '' ).' importado correctamente</b></font><br />';
				}
				*/
						
			}
			
			return true;
			
		} else {
			echo SimpleXLSX::parseError();
		}
	}
}
?>
