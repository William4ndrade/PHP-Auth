<?php

namespace app\classes\posts;
require_once __DIR__ . "/../../vendor/autoload.php";
use Dotenv\Dotenv;
use Error;
use Exception;
use PDO;


class DatabasePosts{

    protected $PDO_connection;

    public function __construct()
    {
      
        $dotenv =  Dotenv::createImmutable(__DIR__ . "/../../");
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

    final public function Getposts(){
        $sql = 'SELECT Posts.Text, Posts.CreatedAt, User.name FROM Posts inner join User ON Posts.Postedby=User.Id ORDER BY idPosts DESC';
        $stmt =  $this->PDO_connection->prepare($sql);
        if($stmt->execute()){
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return [
                'ok' => true,
                'data' => $data
            ];
        }else{
            return [
                'ok' => false,
                'statusmensage' => 'Ocorreu um erro, volte mais tarde'
            ];
        }
    }


    final public function FindpostsbyUserId($iduser){
        $sql = 'SELECT Text, CreatedAt from Posts where PostedBy=:id ORDER BY idPosts DESC';
        $stmt =  $this->PDO_connection->prepare($sql);
        $stmt->bindParam(":id", $iduser);
        if($stmt->execute()){
            return[
                'ok' => true,
                'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
            ];

        }else{
            return[
                'ok' => false,
                'statusmensage' => 'Erro ao pegar mensagens em seu id'
            ];
        }
    }


    
















}
