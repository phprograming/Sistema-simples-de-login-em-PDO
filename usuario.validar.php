<?php
require_once "../model/pdo.class.php";
require_once "../model/usuario.class.php";
$valor = new usuario();

	$conecta = DB::conexao();

	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];

	$sql = $conecta->prepare("SELECT * FROM login WHERE `usuario` = '$usuario' AND `senha` = '$senha'");
	$sql->execute();
	$num = $sql->rowCount();
	
	
	if ($valor->validar($_POST["usuario"], $_POST["senha"]) === 0){
		header ('Location: ../');
	}else{
		session_start();
		$_SESSION["usuario"] = $usuario;
		$_SESSION["senha"] = $senha;

		$verifica = $conecta->query("SELECT * FROM login");
		while ($linha = $verifica->fetch(PDO::FETCH_ASSOC)) {
			if($linha['usuario'] == $usuario){
				$nivel = $linha['nivel'];
				switch ($nivel) {
					case '0':
						$_SESSION["logado"] = true;
						header('Location: ../view/index.php');
						break;
					} 
				}	
			}
		}
?>