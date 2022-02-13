<?php
	require_once 'Class/mysql.php';
    require_once 'config.php';
	session_start();
	$usuario_autenticado = false;

    if(isset($_POST['acao'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $sql = MySql::conectar()->prepare("SELECT * FROM usuarios WHERE email = ? AND password = ?");
            $sql->execute(array($email, $password));

	
	foreach($sql as $email){
    
    if($email['email'] == $_POST['email'] && $email['password'] == $_POST['password']){
        $usuario_autenticado = true;
    }
}

	 if($usuario_autenticado){
        echo 'Usuário autenticado.';

        $_SESSION['autenticado'] = 'SIM';
        header('Location: minha_loja.php');
    }else{  
        $_SESSION['autenticado'] = 'NÃO';
        header('Location: login.php?login=erro');
        
      }
  }
    

?>