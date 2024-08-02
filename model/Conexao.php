<?php
class Conexao {
    private static $conexao;

    public static function getConexao() {
        if (self::$conexao == null) {
            $host = "localhost";
            $username = "root";
            $password = "@D2vveaax";
            $dbname = "banco_projeto";
            $port = 3307;

            self::$conexao = new mysqli($host, $username, $password, $dbname, $port);
            if (self::$conexao->connect_error) {
                die("Falha na conexão: " . self::$conexao->connect_error);
            }
        }
        return self::$conexao;
    }
}
?>
