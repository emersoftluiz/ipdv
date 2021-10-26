<?php
require_once('includes/includes.php');
require_once('views/user/user.php');
 
if (!isset($_POST['username'])){
	$_POST['username'] = ""; 
}
$username = $_POST['username'];

if (!isset($_POST['passwd'])){
	$_POST['passwd'] = ""; 
}
$passwd = $_POST['passwd'];

if ($username && $passwd) {
	try{
		login_user($username, $passwd);
		$_SESSION['valid_user'] = $username;
	}
    catch(Exception $e){		
       $mensagem = 'Dados incorretos!';
       display_login_form($mensagem);
	   
       exit;
	}
}
 
if(isset($_SESSION['valid_user'])){
	do_html_header('Home');
	if ($url_array = get_user_urls($_SESSION['valid_user'])){
		display_user_urls($url_array);
	}
	display_user_menu();
	do_html_footer();
} else {
	display_login_form();
}
?>