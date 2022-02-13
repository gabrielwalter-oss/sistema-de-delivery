<?php 
	include'homer.php';
	require_once 'Class/ultilidades.php';
	require_once 'config.php';
	require_once 'Class/mysql.php';
 ?>


<div class="chamada-escolha">
	<h2>Escolha uma das lojas  e compre agora!</h2>
</div><!--chamada-escolha-->
<section class="conteiner">
	<div class="buscar">
		<form method="POST">
			<input type="text" name="busca" placeholder="Buscar">
			<input type="submit" name="acao" value="Buscar">
		</form>
	</div><!--buscar-->
	<?php

			$query = "";
		if(isset($_POST['acao']) && $_POST['acao'] == 'Buscar'){

			$nome = $_POST['busca'];
			$query = "WHERE nome LIKE '%$nome%' OR descricao LIKE '%$nome%'";

			$sql = MySql::conectar()->prepare("SELECT * FROM `user_loja` $query");
			$sql->execute();
			$lojas = $sql->fetchAll();
			if($query != ""){
				
				echo '<div class="resultado"><h5>Resultados encontrados </h5></div>';	
				
			}
		}

			$sql = MySql::conectar()->prepare("SELECT * FROM `user_loja` $query");
			$sql->execute();
			$lojas = $sql->fetchAll();

			foreach($lojas as $value){
				$imgSingle = MySql::conectar()->prepare("SELECT * FROM `user_loja_img`  WHERE produto_id = $value[id] LIMIT 1");
				$imgSingle->execute();
				$imgSingle = $imgSingle->fetch()['img'];

		?>
	
	<a href="loja.php">
	<div class="box-bullets">
		<div class="bullets">
				<img src="uploads/<?php echo $imgSingle ?>">
		</div><!--bullets-->
		<div class="text">
			<h2><?php echo $value['nome'] ?></h2>
			<p><?php echo $value['descricao'] ?></p>
		</div><!--text-->
	</div><!--box-bullets-->
	</a>
	<?php } ?>
</section><!--conteiner-->
<footer>
		<h3>Todos os direitos reservados</h3>
		<p>Vitoria da conquista BA Rua olindo pinto 130</p>
</footer>