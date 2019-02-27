<?php
require_once "../model/pdo.class.php";

class usuario
{
 
	public function validar($usuario, $senha){
		$conMySQL = DB::conexao();

        $stringSQL = "SELECT * FROM login WHERE senha = '$senha' AND usuario = '$usuario'";     
		
        $sql = $conMySQL->prepare($stringSQL);
        $sql->execute();
		
		return count($sql->fetchAll());	
    }
}