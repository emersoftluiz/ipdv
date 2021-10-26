<?php

function display_login_form($mensagem = ''){
?>
<!DOCTYPE html>
<html>
<head>
	<title>IPDV</title>
    <link rel="stylesheet" href="<?php echo HOSTNAME;?>css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo HOSTNAME;?>css/bootstrap-login.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo HOSTNAME;?>css/styles-login_admin.css">
    <script src="<?php echo HOSTNAME;?>js/bootstrap-login.min.js"></script>
    <script src="<?php echo HOSTNAME;?>js/jquery-login.min.js"></script>
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Login:
				<?php
				if($mensagem){
				    echo '<font style="color:red">'.$mensagem.'</font>';
				}
				?>
				</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><img src="<?php echo HOSTNAME;?>images/login/facebook.png"></span>
					<span><img src="<?php echo HOSTNAME;?>images/login/twitter.png"></span>
                    <span><img src="<?php echo HOSTNAME;?>images/login/instagram.png"></span>
                    <span><img src="<?php echo HOSTNAME;?>images/login/linkedin.png"></span>
                    <span><img src="<?php echo HOSTNAME;?>images/login/google-plus.png"></span>
				</div>
			</div>
			
			<div class="card-body">
				<form method="POST" action="<?php echo HOSTNAME;?>admin" accept-charset="UTF-8">
				<input name="_token" type="hidden">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><img src="<?php echo HOSTNAME;?>images/login/user.png"></span>
						</div>
                        <input class="form-control" placeholder="Usuário" name="username" type="text" required>
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><img src="<?php echo HOSTNAME;?>images/login/key.png"></span>
						</div>
                        <input class="form-control" placeholder="Senha" name="passwd" type="password" value="" required>
					</div>
					<div class="row align-items-center remember">
						<input type="checkbox">Lembrar-me
					</div>
					<div class="form-group">
                        <input class="btn float-right login_btn" type="submit" value="Entrar">
					</div>
                </form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
                    Administração
				</div>
				<div class="d-flex justify-content-center">
					<a href="https://www.ipdvonline.com.br/" target="_blank">&copy; Copyright <?php echo date('Y') ?></a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php
}

?>
