<?php

	include 'homer.php';
	require_once 'Class/ultilidades.php';

?>
	<div class="form2">

		<h1>Fazer login</h1>
		<form action="valida_login.php" method="POST">
			<input type="email" name="email" placeholder="E-mail">
			<input type="password" name="password" placeholder="password">

			<?php

				if(isset($_POST['login']) && $_POST['login'] == 'erro'){
					Ultilidades::alerta('Usuario ou senha incorretos');
				}

			?>


			<?php

				if(isset($_POST['login']) && $_POST['login'] == 'erro2'){
					Ultilidades::alerta('Faça login para acessar as paginas protegidas');
				}

			?>
			<input type="submit" name="acao" value="Enviar">
		</form>

		<div class="criar-conta">
			<a href="criar_conta.php">Faça a sua conta</a>
			<p>E impulsione suas vendas</p>
		</div><!--criar-conta-->
	</div><!--form-->

	<footer>
		<h3>Todos os direitos reservados</h3>
		<p>Vitoria da conquista BA Rua olindo pinto 130</p>
	</footer>
</body>
</html>