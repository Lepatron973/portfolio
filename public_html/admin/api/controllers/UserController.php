<?php
    namespace Controllers;
    
    class UserController extends Controller{
        function __construct(array $data = []){
            $this->model = new \Models\User();
        }
        
        function connexion(array $data){
            $user = $this->model->getOneByRef($data);
            if(isset($user['password'])){

                if($data['password'] == $user['password'])
                    array_push($this->result,array("function"=>"connexion","result"=>true));
                else
                    array_push($this->result,array("function"=>"connexion","result"=>false));
            }
            else
                array_push($this->result,array("function"=>"connexion","result"=>false));

        }
    }