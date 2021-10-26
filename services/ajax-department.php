<?php
require_once('../database/db_fns.php');
$conn = db_connect();

$costcenter_id = $_POST['costcenter_id'];

$sql = "SELECT * FROM department WHERE costcenter_id = '".$costcenter_id."' ORDER BY name ASC";
$qr = $conn->query($sql);
$num_results = $qr->num_rows;

if($num_results == 0){
   echo  '<option value="">'.htmlentities('Aguardando Centro de Custo...').'</option>';
   
} else {
	echo '<option value="">Selecione o Departamento...</option>';
	for ($i=0; $i <$num_results; $i++) {
		$ln = $qr->fetch_assoc();
        echo '<option value="'.$ln['id'].'">'.$ln['name'].'</option>';
	}
}

?>