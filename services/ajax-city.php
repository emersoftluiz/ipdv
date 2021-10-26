<?php
require_once('../database/db_fns.php');
$conn = db_connect();

$estado = $_POST['estado'];

$sql = "SELECT * FROM cidade WHERE estado = '".$estado."' ORDER BY nome ASC";
$qr = $conn->query($sql);
$num_results = $qr->num_rows;

if($num_results == 0){
   echo  '<option value="">'.htmlentities('Aguardando Estado...').'</option>';
   
} else {
	echo '<option value="">Selecione a Cidade...</option>';
	for ($i=0; $i <$num_results; $i++) {
		$ln = $qr->fetch_assoc();
        echo '<option value="'.$ln['id'].'">'.$ln['nome'].'</option>';
	}
}

?>