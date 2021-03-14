<?php

namespace app\classes\posts;
require_once __DIR__ . "/../../vendor/autoload.php";
use Dotenv\Dotenv;
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
            echo "deu ruim";
        }
        
    }





















}
