<?php

	class Usuarios{

		public static function emailExite($email){

			$pdo = MySql::conectar();

			$verificar = $pdo->prepare("SELECT email FROM usuarios WHERE email = ?");
			$verificar->execute(array($email));

			if($verificar->rowCount() == 1){

				return true;
			}else{

				return false;
			}
		}

	}

?>