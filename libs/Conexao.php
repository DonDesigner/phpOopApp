<?php
/**
 * Classe para abstração de conexão com o Banco de dados
 *
 * @author Diego
 */
class Conexao {
    private static $cnx;
 
    /**
     * 
     * @return PDO 
     */
    public static function getConexao(){
        //se não existir conexão  (se não estiver instanciado)
        if(!self::$cnx){
            self::open();
        }
        return self::$cnx;
    }
    
    //********************************************************
    private static function open(){
        $host = HOST;
        $port = PORT;
        $dbname = DB_NAME;
        $username = USER_NAME;
        $pass  = PASSWORD;
        
        self::$cnx = new PDO("mysql:host={$host}; port={$port}; dbname={$dbname}", 
                              $username,
                              $pass,
                              array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
     }
}

?>
