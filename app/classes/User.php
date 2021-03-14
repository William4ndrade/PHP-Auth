<?php

namespace  app\classes;
require_once(__DIR__ . "/User_db_model.php");

use app\classes\user\DataBaseUser;
use Dotenv\Dotenv;
use Firebase\JWT\JWT;

class User extends DataBaseUser {


    protected $Email;
    private $password;
    private $confirmpassword;
    public $name;

    public function  __construct( $email, $password, $confirmpassword = null,  $name =null)
    {
        parent::__construct();
        $this->Email = $email;
        $this->password = $password;
        $this->confirmpassword = $confirmpassword;
        $this->name =  $name;
    }


    protected function  validationLoginData(string $email, string $password):bool{
        $email_valid  =  filter_var($email, FILTER_VALIDATE_EMAIL);
        $password_valid =  strlen($password) >= 5 ?  $password : false;
        if($email_valid  && $password_valid){
            return true;
        }else{
            return  false;
        }



    }

    protected function  validationRegisterData($email, $password,  $confirmpassword,  $name): bool{
        $email_valid  =  filter_var($email, FILTER_VALIDATE_EMAIL);
        $password_valid =  strlen($password) >= 5  ? ($password === $confirmpassword ? true : false ) : false;
        $name_valid =  $name ? ($name <= 30 ? true : false) : false;
        if($email_valid && $password_valid && $name_valid){
            return true;
        }else{
            return false;
        }






    }


    public  function register(){
        $data_valid = $this->validationRegisterData($this->Email, $this->password, $this->confirmpassword, $this->name);
        if($data_valid){
            $email =  addslashes(strip_tags($this->Email));
            $password = addslashes(password_hash($this->password,  PASSWORD_BCRYPT));
            $name =  addslashes(strip_tags($this->name));
            return $this->InsertUser($email,$password,$name);


        }else{
            return [
                "ok" => false,
                "statusmensage" => [
                    "Ocorreu um erro, cheque seus dados e tente novamente"
                ]
            ];


        }
    }

    public function login(){
        $data_valid = $this->validationLoginData($this->Email, $this->password);
        if($data_valid){
            $email = addslashes(strip_tags($this->Email));
            $user =  $this->Selectuser($email);
            if($user){
                $env = Dotenv::createImmutable(__DIR__. '/../..');
                $env->load();
                $valid_password = password_verify($this->password, $user[0]['password']);
                if($this->Email === $user[0]['email'] && $valid_password){
                    return[
                        'ok' => true,
                        'statusmensage' => 'User Authenticaded',
                        'userinfo' => ['name' => $user[0]['name'] , 'id' => $user[0]['Id']],
                        'JWT' =>  JWT::encode([
                            'Name' => $user[0]['name'],
                            'id' =>  $user[0]['Id'],
    
                        ], $_ENV['KEY_JWT'])
                    ];
                }else{
                    return[
                        'ok' => false,
                        'statusmensage' => 'Email ou senha incorreto'
                    ];
                }
            }else{
                return[
                    'ok' => false,
                    'statusmensage' => 'Email ou senha incorreto'
                ];
            }



        }






    }




}

