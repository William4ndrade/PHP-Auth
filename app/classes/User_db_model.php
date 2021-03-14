<?php

namespace app\classes\model;
require_once __DIR__ . "/../../vendor/autoload.php";
use Dotenv\Dotenv;
use Firebase\JWT\JWT;
use PDO;

class DataBase{

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
                echo "deu ruim";
            }
            
        }
      


        final protected function InsertUser(string $email, string $password, string $name ){   
            $sql = "INSERT INTO User (name , email, password) VALUES (:NAME, :EMAIL,:PASSWORD)";
            $stmt =  $this->PDO_connection->prepare($sql);
            $stmt->bindParam(":NAME", $name);
            $stmt->bindParam(":EMAIL", $email);
            $stmt->bindParam(":PASSWORD", $password);
            if($stmt->execute()){
                $Id = $this->PDO_connection->lastInsertId();
                return [
                    "ok" => true,
                    "statusmensage" => "Conta criada com sucesso",
                    "User" => ["name" => $name, "id" => $Id],
                    'JWT' => JWT::encode([
                        'Name' => $name,
                        'id' => $Id,

                    ], $_ENV['KEY_JWT'])
                ];

            }else{
                if($stmt->errorCode() === '23000'){
                    return [
                        "ok" => false,
                        "statusmensage" => "Email em uso"
                    ];
                }else{
                    return [
                        "ok" => false,
                        "statusmensage" => "Ocorreu um erro inesperado, tente novamente"
                    ];
                }
            }
            
        }


        final protected function Selectuser($email, $id = null){
            if($id){
                $sql = 'select name, email from User where id=:n';
                $stmt =  $this->PDO_connection->prepare($sql);
                $stmt->bindParam('id', $id);
                if( $stmt->execute()){
                    return $stmt->fetchAll();
                }
            }else{
                $sql = 'SELECT * FROM User WHERE email=:email';
                $stmt =  $this->PDO_connection->prepare($sql);
                $stmt->bindParam('email', $email);
                if( $stmt->execute()){
                    return $stmt->fetchAll();
                }

            }
        }









}

