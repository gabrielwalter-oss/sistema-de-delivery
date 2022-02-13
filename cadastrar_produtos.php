<?php
	include 'painel.php'; 
	require_once "validador_acesso.php";
	require_once 'Class/ultilidades.php';
	require_once 'config.php';
	require_once 'Class/mysql.php';
?>


<div class="box-content">
	<h2><i class="fa fa-pencil"></i>Cadastra produto</h2>

	<?php

		if(isset($_POST['acao'])){
			$nome = $_POST['nome'];
			$descricao = $_POST['descricao'];
			$largura = $_POST['largura'];
			$altura = $_POST['altura'];
			$comprimento = $_POST['comprimento'];
			$peso = $_POST['peso'];
			$quantidade = $_POST['quantidade'];
			$preco = $_POST['preco'];

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
				$sql = MySql::conectar()->prepare("INSERT INTO `tb_loja` VALUES (null,?,?,?,?,?,?,?,?)");
				$sql->execute(array($nome,$descricao,$largura,$altura,$comprimento,$quantidade,$peso,$preco));
				$lastId = MySql::conectar()->lastInsertId();
				foreach($img as $key => $value){
					MySql::conectar()->exec("INSERT INTO `tb_loja_img` VALUES (null,$lastId,'$value')");
				}
				Ultilidades::alerta('O produto foi cadastrado com sucesso');
			}
		}

	?>
	<form method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label>Nome do produto: </label>
			<input type="text" name="nome">
		</div><!--form-group-->

		<div class="form-group">
			<label>Descrição: </label>
			<textarea name="descricao"></textarea>
		</div><!--form-group-->

		<div class="form-group">
			<label>Largura do produto: </label>
			<input type="number" name="largura" min="0" max="1000" step="1" value="0">
		</div><!--form-group-->


		<div class="form-group">
			<label>Altura do produto: </label>
			<input type="number" name="altura" min="0" max="1000" step="1" value="0">
		</div><!--form-group-->


		<div class="form-group">
			<label>Comprimento do produto: </label>
			<input type="number" name="comprimento" min="0" max="1000" step="1" value="0">
		</div><!--form-group-->

		<div class="form-group">
			<label>Quantidade do produto: </label>
			<input type="number" name="quantidade" min="0" max="1000" step="1" value="0">
		</div><!--form-group-->


		<div class="form-group">
			<label>peso do produto: </label>
			<input type="number" name="peso" min="0" max="1000" step="1" value="0">
		</div><!--form-group-->


		<div class="form-group">
			<label>preço do produto: </label>
			<input type="number" name="preco" min="0" max="1000" step="1" value="0">
		</div><!--form-group-->

		<div class="form-group">
			<label>Selecione as imagem: </label>
			<input multiple type="file" name="img[]">
		</div><!--form-group-->

		<div class="form-group">
			<input type="submit" name="acao" value="Cadastrar">
		</div><!--form-group-->
	</form>
</div><!--box-content-->