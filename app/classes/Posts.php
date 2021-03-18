<?php

namespace app\classes\posts;
use app\classes\posts\DatabasePosts;
include_once(__DIR__ . '/Posts_db_model.php');

class Post extends DatabasePosts{

    private string $text;
    private int $UserID; 

    public function __construct($text, $UserID)
    {
        parent::__construct();
        $this->text = $text;
        $this->UserID = $UserID;
    
    }


    private function postDatavalidation():bool{
        if(isset($this->text) && isset($this->UserID)){
            $text = strlen($this->text) <= 255 ? (trim($this->text) !== '' ? true : false) : false;
            $userID = is_int($this->UserID); 
            return $text && $userID;
           
        }else{
            return false;
        }


    }


    public function newpost(){
        if($this->postDatavalidation()){
            $text = trim(strip_tags($this->text));
            $iduser = $this->UserID;
            return  $this->insertPost($text, $iduser);

        }else{
            return [
                'ok' => false,
                'statusmensage' => 'Dados incorretos, tente novamente'
            ];
        }
    }


    






















}