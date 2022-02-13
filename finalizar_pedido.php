<?php

	include'homer.php';
	require_once 'config.php';
	require_once 'Class/mysql.php';
	require_once 'Class/ultilidades.php';

?>
<body>

	<div class="container">
	<table width="100%">
			<tr>
				<td>Nome do produto</td>
				<td>Quantidade</td>
				<td>Valor</td>
			</tr>
			<?php
			$ultilidades = new Ultilidades();
			$ultilidades->carrinho();
			session_start();
				$itemsCarrinho = $_SESSION['carrinho'];
					foreach($itemsCarrinho as $key => $value){
					
					$idProduto = $key;
					$produto = MySql::conectar()->prepare("SELECT * FROM `tb_loja` WHERE id = $idProduto");
					$produto->execute();
					$produto = $produto->fetch();
		

			?>
			<tr>
				<td><?php echo $produto['nome']; ?></td>
				<td><?php echo $value; ?></td>
				<td>R$<?php echo $value['preco'] ?></td>
			</tr>
			<?php } ?>
	</table>
	<div class="preco-total">
		<p><strong>O total da compra foi:</strong> 156,99</p>
	</div>
	<div class="finalizar-compra">
		<form>
			<p>Escolha seu método de pagamento:</p>
			<select name="opcao_pagamento">
				<option value="cartao credito">Cartão de Crédito</option>
				<option value="cartao debito">Cartão de Debito</option>
				<option value="dinheiro">Boleto</option>
				<option value="dinheiro">Pix</option>
			</select>
			<input type="submit" name="acao" value="Finalizar compra!">
		</form>
	</div><!--finalizar-compra-->
	</div>
</body>
</html>