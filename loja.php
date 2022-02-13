<?php 
	include'homer.php';
	require_once 'config.php';
	require_once 'Class/mysql.php';
	require_once 'Class/ultilidades.php';
	$ultilidades = new Ultilidades();
	$ultilidades->carrinho();
?>


<div class="chamada-escolha">
	<h2>Escolha seu produto e compre agora!</h2>
</div><!--chamada-escolha-->
<div class="box-content">

	<div class="header-form">
		<div class="carrinho">
			<a href=""><i class="fa fa-heart"></i></a>
			<a href="finalizar_pedido.php"><i class="fa fa-cart-plus"></i><?php echo Ultilidades::getTotalCarrinho();?></a>
		</div><!--carrinho-->
		<div class="buscar">
			<form method="POST">
				<input type="text" name="busca" placeholder="Buscar">
				<input type="submit" name="acao" value="Buscar">
			</form>
		</div><!--buscar-->
	</div><!--header-form-->

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
				$imgSingle = MySql::conectar()->prepare("SELECT * FROM `tb_loja_img`  WHERE produto_id = $value[id]");
				$imgSingle->execute();
				$imgSingle = $imgSingle->fetch()['img'];

		?>
		<div class="box-single-wraper">
			<div class="box-single">
				<div class="body-box">
					<img src="uploads/<?php echo $imgSingle ?>">
					<p><b><?php echo $value['nome'] ?></b></p>
					<p><?php echo $value['descricao'] ?></p>
					<p><?php echo $value['preco'] ?></p>
					<div class="group-btn">
						<a class="deletar" href="<?php INCLUDE_PATH?>?addCart=<?php echo $value['id'] ?>"><i class="fa fa-cart-plus"></i> Adicionar ao carrinho</a>
					</div><!--group-btn-->
				</div><!--body-box-->
			</div><!--box-single-->
		</div><!--box-single-wraper-->
	<?php } ?>
		<div class="clear"></div>
	</div><!--boxs-->
</div><!--box-content-->

<footer>
		<h3>Todos os direitos reservados</h3>
		<p>Vitoria da conquista BA Rua olindo pinto 130</p>
</footer>