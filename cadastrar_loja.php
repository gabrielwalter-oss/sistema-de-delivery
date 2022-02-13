<?php

	include 'painel.php';
	require_once 'config.php';
	require_once 'Class/mysql.php';
	require_once 'Class/ultilidades.php';
	require_once 'usuarios.php';
	require_once "validador_acesso.php";
?>
	<div class="box-content">
		<h2><i class="fa fa-id-card-o"></i>Cadastrar loja</h2>
	<?php

		if(isset($_POST['acao'])){
			$nome = $_POST['nome'];
			$descricao = $_POST['descricao'];
			$cep = $_POST['cep'];
			$estado = $_POST['estado'];
			$cidade = $_POST['cidade'];
			$bairro = $_POST['bairro'];
			$rua = $_POST['rua'];
			$numero = $_POST['numero'];

			$img = array();
			$amountFiles = count($_FILES['img']['name']);

			$sucesso = true;

			if($_FILES['img']['name'][0] != ''){

				for($i = 0; $i < $amountFiles; $i++){
					$imgAtual = ['type' => $_FILES['img']['type'][$i],
					'size' => $_FILES['img']['size'][$i],];
					if(Ultilidades::imagemValida($imgAtual) == false){
						$sucesso = false;
						Ultilidades::alerta('Uma das imagens selecionada são invalidas!');
						break;
					}
				}
			}else{
				$sucesso = false;
				Ultilidades::alerta('Voçe precisa selecionar pelo menos uma imagem!');
			}

			if($sucesso){
				for($i = 0; $i < $amountFiles; $i++){
					$imgAtual = ['tmp_name' => $_FILES['img']['tmp_name'][$i],
					'name' => $_FILES['img']['name'][$i],];
					$img[] = Ultilidades::uploadFile($imgAtual);

				}
				$sql = MySql::conectar()->prepare("INSERT INTO `user_loja` VALUES (null,?,?,?,?,?,?,?,?)");
				$sql->execute(array($nome,$descricao,$cep,$estado,$cidade,$rua,$bairro,$numero));
				$lastId = MySql::conectar()->lastInsertId();
				foreach($img as $key => $value){
					MySql::conectar()->exec("INSERT INTO `user_loja_img` VALUES (null,$lastId,'$value')");
				}
				Ultilidades::alerta('O produto foi cadastrado com sucesso');
			}
		}

	?>
		<div class="form-group4">
			<form method="POST" enctype="multipart/form-data">
				<input type="text" name="nome" placeholder="Nome da loja">
				<div class="form-group">
					<label>Descrição da loja: </label>
					<textarea name="descricao"></textarea>
				</div><!--form-group-->
				<input type="text" name="cep" placeholder="CEP">
				<input type="text" name="estado" placeholder="Estado">
				<input type="text" name="cidade" placeholder="Cidade">
				<input type="text" name="bairro" placeholder="Bairro">
				<input type="text" name="rua" placeholder="Rua">
				<input type="text" name="numero" placeholder="Numero">
				<div class="form-group">
					<label>Selecione o logo da loja: </label>
					<input multiple type="file" name="img[]">
				</div><!--form-group-->
				<input type="submit" name="acao" value="Cadastrar">
			</form>
		</div>
	</div><!--form-->


	</body>
</html>