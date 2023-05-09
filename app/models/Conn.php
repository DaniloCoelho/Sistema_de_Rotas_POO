<?php
namespace app\models;
use PDO;

class Conn { 
    public function conexao(){
        define("BD_USUARIO", "root");
        define("BD_SENHA" ,"");
        define("BD_DSN","mysql:dbname=simulado;host=127.0.0.1");
        try{
            $pdo = new PDO(BD_DSN ,BD_USUARIO ,BD_SENHA  );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "conectado";
            return $pdo;
            
        } catch(PDOException $e){
            echo "PDO Falha na conexão com o banco de dados".$e->getMessage();
            die();

        }
    }
}
    

?>