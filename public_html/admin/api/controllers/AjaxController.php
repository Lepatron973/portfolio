<?php
    namespace Controllers;

    class AjaxController {
        private $controller;
        function __construct(Controller $controller){
            
            $this->controller = $controller;
        }
        /* 
            Cette fonction permet de servir les différentes routes
            utilisant les requêtes ajax et ainsi d'alléger l'index
        */
        public function router(string $action):void{
            $json = $this->parseJsonData();
            
            switch($action){
                
                case "addProject":
                    
                    if(!isset($_POST['image'])){ 
                        $_POST['image'] = $_FILES['image']['name'];
                        if($this->controller->add($_POST))
                            $this->controller->uploadImage();
                        $this->controller->sendResponse();
                    }else{
                        unset($_POST['image']);
                        $this->controller->add($_POST);
                        $this->controller->sendResponse();
                    }
                break;
                case "getAllProjects":
                    $this->controller->getAll($json);
                    $this->controller->sendResponse();
                 break;
                case "updateProject":
                    if(!isset($_POST['image'])){ 
                        $_POST['image'] = $_FILES['image']['name'];
                        if($this->controller->update($_POST))
                            $this->controller->uploadImage();
                        $this->controller->sendResponse();
                    }else{
                        unset($_POST['image']);
                        $this->controller->update($_POST);
                        $this->controller->sendResponse();
                    }
                 break;  
                case "deleteProject":
                    $this->controller->delete($json);
                    $this->controller->sendResponse();
                break;
                case "connexion":
                    $this->controller->connexion($json);
                    $this->controller->sendResponse();
                break;
                default:
                    // echo "default:" . var_dump($action);
                break;
            }
        }
        static public function parseJsonData(){
            $json = file_get_contents("php://input",true);
            $json = json_decode($json, true);
            return $json;
        }
        public function setController(Controller $controller):void{
            $this->controller = $controller;
        }
    }