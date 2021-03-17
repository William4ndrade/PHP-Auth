<?php

namespace app\classes\posts;
require_once __DIR__ . "/../../vendor/autoload.php";
use Dotenv\Dotenv;
use Error;
use Exception;
use PDO;


class DatabasePosts{

    protected $PDO_connection;

    protected function __construct()
    {
      
        $dotenv =  Dotenv::createImmutable("../");
        $dotenv->load();
        $server = $_ENV["SERVER_DB_IP"];
        $password = $_ENV["SERVER_DB_PASSWORD"];
        $user = $_ENV["SERVER_DB_USER"];
        $db = $_ENV["SERVER_DB_NAME"];
        $DB_SELECT = $_ENV["DB_SELECT"];
        try {
           
            $this->PDO_connection = new PDO("mysql:host={$server}:dbname={$db}", $user, $password);
            $this->PDO_connection->exec("use {$DB_SELECT}");
        
          
            
        } catch (\Throwable $th) {
            throw new Exception('db not connected', 666);
        }
        
    }



    final protected function insertPost(string $text, int $iduser){
        $sql = 'INSERT INTO Posts ( Text,  Postedby ) VALUES ( :TEXT , :IDUSER )';
        $stmt = $this->PDO_connection->prepare($sql);
        $stmt->bindParam(':TEXT', $text);
        $stmt->bindParam(':IDUSER', $iduser);
        if($stmt->execute()){
            return [
                'ok' => true,
                'statusmensage' => 'Conta criada com sucesso'
            ];
        }else{
            return [
                'ok' => false,
                'statusmensage' => 'Erro ao criar a conta, tente novamente',
                'errorForDebug' => $stmt->errorInfo(),
            ];
        }








    }

















}
