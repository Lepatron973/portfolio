<?php
    namespace Controllers;
    
    class UserController extends Controller{
        function __construct(array $data = []){
            $this->model = new \Models\User();
        }
        
        function connexion(array $data){
            $user = $this->model->getOneByRef($data);
            if(isset($user['password'])){

                if($data['password'] == $user['password']){

                    array_push($this->result,array("function"=>"connexion","result"=>true));
                    $_SESSION['login'] = ['status'=>true,'ip'=>$_SERVER['REMOTE_ADDR']];
                }
                else
                    array_push($this->result,array("function"=>"connexion","result"=>false));
            }
            else
                array_push($this->result,array("function"=>"connexion","result"=>false));

        }
        static function checkUserSession(): bool
        {
            if($_SESSION['login']['ip'] == $_SERVER['REMOTE_ADDR'])
                return true;
            else
                return false;

        }
    }