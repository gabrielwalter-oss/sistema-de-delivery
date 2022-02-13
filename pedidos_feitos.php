<?php

	include 'painel.php';
	require_once "validador_acesso.php";

?>

<div class="box-content">
	<h2><i class="fa fa-id-card-o"></i>Pedidos realizados</h2>

	<div class="boxs">
		<?php  

			for($i = 0; $i < 3; $i++){

		?>
		<div class="box-single-wraper">
			<div class="box-single">
				<div class="body-box">
					<img src="img/camisa.jpg">
					<p><b>Nome do clinte:</b> Gabriel</p>
					<p><b>Sobrenome do cliente:</b> Almeida</p>
					<p><b>Quantidade:</b> 2</p>
					<p><b>Tamanho:</b> M</p>
					<p><b>Cor:</b> cinza</p>
					<p><b>Valor:</b> 156,99</p>
					<h2>Endereço</h2>
					<p><b>Estado:</b> Bahia</p>
					<p><b>Cidade:</b> vitoria da conquista</p>
					<p><b>Bairro:</b> candeis</p>
					<p><b>Rua:</b> benigno santos</p>
					<p><b>Numero da casa:</b> 56</p>
					<div class="group-btn2">
						<a href=""><i class="fa fa-check-circle"></i> Entrega concluida</a>
					</div><!--group-btn-->
				</div><!--body-box-->
			</div><!--box-single-->
		</div><!--box-single-wraper-->

	<?php } ?>
		<div class="clear"></div>
	</div><!--boxs-->

</div><!--box-content-->