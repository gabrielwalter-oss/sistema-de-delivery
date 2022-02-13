<?php require_once "validador_acesso.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style2.css">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<title>Y'closet</title>
</head>
<body>
		<div class="sidebar">
		<div class="topo">
			<img src="">
		</div><!--topo-->
		
		<div class="menu">
				<i class="fa fa-home"></i><a href="minha_loja.php">  Painel</a>
			</br>
				<h2>Controle de estoque</h2>
				</br>
				<i class="fa fa-edit"></i><a href="cadastrar_loja.php">Cadastra loja</a>
				</br>
				<i class="fa fa-edit"></i><a href="cadastrar_produtos.php">  Cadastrar produtos</a>
				</br>
				<i class="fa fa-id-card-o"></i><a href="lista_produto.php">  Lista Produtos</a>
				</br>
				<i class="fa fa-truck"></i><a href="pedidos_feitos.php">  Pedidos</a>
				</br>
		</div><!--menu-->
	</div><!--sidebar-->

	<div class="main-content">
		<header>

			<div class="nome-usuario">
				<h2><i class="fa fa-align-justify"></i></h2>
			</div><!--nome-usuario-->

			<div class="loggout">
				<a href="logoff.php"><i class="fa fa-times"></i> SAIR</a>
			</div><!--loggout-->


			<div class="icone-alerta">
				<p>10</p>
				<i class="fa fa-bell"></i>
			</div><!--icone-alerta-->

			<div class="loggout">
				<a href="loja.php"><i class="fa fa-home"></i>Minha loja</a>
			</div><!--loggout-->

			<div class="clear"></div>
		</header>

		<script src="js/jquery.js"></script>
	<script>
		$(function(){
			var windowWidth = $(window)[0].innerWidth;
			if(windowWidth <= 953){
				$('.nome-usuario h2').click(function(){
				var el = $('.sidebar');
				if(el.is(':visible'))
				{
					el.hide();
						$('.main-content').css('left','0');
				}else{
					el.show();

					$('.main-content').css('left','300px');
				}
			})

			}

			$(window).resize(function(){
				windowWidth = $(window)[0].innerWidth;
			})
		
		})
	</script>
