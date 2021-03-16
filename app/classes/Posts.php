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
    
    }


    private function postDatavalidation(){

    }


    public function newpost(){

    }























}