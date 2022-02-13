<?php

	include 'homer.php';
	require_once 'config.php';
	require_once 'Class/mysql.php';
	require_once 'Class/ultilidades.php';
	require_once 'usuarios.php';
?>
	<div class="form4">
		<?php

			
			if(isset($_POST['registrar'])){

				$nome = addslashes($_POST['nome']);	
				$telefone = addslashes($_POST['telefone']);	
				$email = addslashes($_POST['email']);	
				$password = addslashes($_POST['password']);	

				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){

					Ultilidades::alerta('Email invalido');
					
				}else if(strlen($password) < 8){
					Ultilidades::alerta('A senha deve conter 8 caracteres');
					

				}else if(Usuarios::emailExite($email)){
					
					Ultilidades::alerta('Esse email ja existe tente outro');	

				}else{

					$sql = MySql::conectar()->prepare("INSERT INTO usuarios VALUES (null,?,?,?,?)");
					$sql->execute(array($nome,$telefone,$email,$password));
					Ultilidades::alerta('Registrado com sucesso');
				}
				
			}


		?>
		<h1>Criar conta</h1>
		<form method="POST">
			<input type="text" name="nome" placeholder="Nome">
			<input type="telefone" name="telefone" placeholder="Telefone">
			<input type="email" name="email" placeholder="E-mail">
			<input type="password" name="password" placeholder="Senha">
			<input type="submit" name="acao" value="Cadastrar">
			<input type="hidden" name="registrar" value="registrar">
		</form>
	</div><!--form-->

	<footer>
		<h3>Todos os direitos reservados</h3>
		<p>Vitoria da conquista BA Rua olindo pinto 130</p>
	</footer>

	</body>
</html>