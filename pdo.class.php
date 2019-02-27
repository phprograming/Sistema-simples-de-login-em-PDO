<?php
/**
 * Classe de conexão ao banco de dados usando PDO no padrão Singleton.
 * Modo de Usar:
 * require_once './Database.class.php';
 * $db = Database::conexao();
 * E agora use as funções do PDO (prepare, query, exec) em cima da variável $db.
 */
class DB
{

    # Variável que guarda a conexão PDO.
    protected static $db;

    # Private construct - garante que a classe só possa ser instanciada internamente.
    private function __construct()
    {
        # Informações sobre o banco de dados:
        $db_host = "localhost";
        $db_nome = "bd";
		$db_usuario = "root";
        $db_senha = "";
        $db_porta = 3306;
        $db_driver = "mysql";

        try {
            # Atribui o objeto PDO à variável $db.
            self::$db = new PDO("$db_driver:host=$db_host; dbname=$db_nome; port=$db_porta", $db_usuario, $db_senha);
            # Garante que o PDO lance exceções durante erros.
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            # Garante que os dados sejam armazenados com codificação UFT-8.
            self::$db->exec('SET NAMES utf8');
        } catch (PDOException $e) {
            $_SESSION["ERRO"] = ERRO_CONEXAO;
            header("Location: ../sistema/");
        }
    }

    # Método estático - acessível sem instanciação.
    public static function conexao()
    {
        # Garante uma única instância. Se não existe uma conexão, criamos uma nova.
        if (!self::$db) {
            new DB();
        }
        # Retorna a conexão.
        return self::$db;
    }
}
?>