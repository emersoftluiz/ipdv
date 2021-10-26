<?php
if(isset($_SESSION['admin_user'])){
	header('Location: '.DIRETORIO.'admin');
} else {
	header('Location: '.DIRETORIO);
}
exit;
?>