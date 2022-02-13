<?php 
	include 'painel.php';
	require_once "validador_acesso.php";
	require_once 'config.php';
	require_once 'Class/mysql.php';
	require_once 'Class/ultilidades.php';
?>

<div class="box-content">
	<h2><i class="fa fa-id-card-o"></i>Produtos cadastrados</h2>
	<form method="POST" class="buscar">
		<input type="text" name="busca" placeholder="Buscar por um produto">
		<input type="submit" name="acao" value="Buscar">
	</form>

	<?php
		/*
		if(isset($_GET['deletar'])){
			$id = (int)$_GET['deletar'];
			$img =  MySql::conectar()->prepare("SELECT * FROM `tb_loja_img` produto_id = $id");
			$img->execute();
			$img = $img->fetchAll();
			foreach($img as $value){
				
				@unlink(BASE_DIR_CLASS.'../../uploads/'.$value['img']);
			}

			MySql::conectar()->exec("DELETE * FROM `tb_loja_img` WHERE produto_id = $id");
			MySql::conectar()->exec("DELETE * FROM `tb_loja` WHERE id = $id");
			Ultilidades::alerta('O produto foi deletado com sucesso');
		}
		*/

		if(isset($_POST['atualizar'])){
			$quantidade = $_POST['quantidade'];
			$produto_id = $_POST['produto_id'];
			if($quantidade <= 0){

				Ultilidades::alerta('Vc não pode atualizar com a quantidade menor ou igual a 0');
			}else{

				MySql::conectar()->exec("UPDATE `tb_loja` SET quantidade = $quantidade WHERE id = $produto_id");
				Ultilidades::alerta('O produto foi atualizado com sucesso '.$_POST['produto_id']);
			}
			
		}

	?>

	<div class="boxs">
		<?php

			$query = "";
		if(isset($_POST['acao']) && $_POST['acao'] == 'Buscar'){

			$nome = $_POST['busca'];
			$query = "WHERE nome LIKE '%$nome%' OR descricao LIKE '%$nome%'";

			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_loja` $query");
			$sql->execute();
			$produtos = $sql->fetchAll();
			if($query != ""){
				
				echo '<div class="resultado"><h5>Foram encontrados </h5>'.count($produtos).'</div>';	
				
			}
		}

			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_loja` $query");
			$sql->execute();
			$produtos = $sql->fetchAll();

			foreach($produtos as $value){
				$imgSingle = MySql::conectar()->prepare("SELECT * FROM `tb_loja_img`  WHERE produto_id = $value[id] LIMIT 1");
				$imgSingle->execute();
				$imgSingle = $imgSingle->fetch()['img'];

		?>
		<div class="box-single-wraper">
			<div class="box-single">
				<div class="body-box">
					<img src="uploads/<?php echo $imgSingle ?>">
					<p><b>Nome do produto: </b><?php echo $value['nome'] ?></p>
					<p><b>Descrição: </b><?php echo $value['descricao'] ?></p>
					<p><b>Larguar: </b><?php echo $value['largura'] ?></p>
					<p><b>Altura: </b><?php echo $value['altura'] ?></p>
					<p><b>Peso: </b><?php echo $value['peso'] ?></p>
					<p><b>Comprimento: </b><?php echo $value['comprimento'] ?></p>
					<p><b>Preço: </b><?php echo $value['preco'] ?></p>
					<div class="form-group2">
						<form method="POST">
							<label>Quantidade atual: </label>
							<input type="number" name="quantidade" min="0" max="1000" step="1" value="<?php echo $value['quantidade'] ?>">
							<input type="submit" name="atualizar" value="Atualizar">
							<input type="hidden" name="produto_id" value="<?php echo $value['id'] ?>">
						</form>
					</div><!--form-group-->
					<div class="group-btn">
						<a class="deletar" href="<?php INCLUDE_PATH?>?deletar=<?php echo $value['id'] ?>"><i class="fa fa-times"></i>Excluir</a>
						<a class="editar" href=""><i class="fa fa-pencil"></i>Editar</a>
					</div><!--group-btn-->
				</div><!--body-box-->
			</div><!--box-single-->
		</div><!--box-single-wraper-->
		<div class="clear"></div>
	<?php } ?>
	</div><!--boxs-->

</div><!--box-content-->
