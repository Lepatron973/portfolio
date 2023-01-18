<?php
    namespace Controllers;
    
    class Controller{
        protected $model;
        protected $result = array();
        protected $scripts = array();
        protected $styles = array();
        protected $view;
        protected $plugins = array(
            array("name"=>"dashboard",'public_url'=>'./','admin_url'=>'./'),
            array("name"=>"portfolio",'public_url'=>'./','admin_url'=>'./'),
            array("name"=>"plugins",'public_url'=>'./','admin_url'=>'./'),
        );
        function __construct(array $data = []){
            $pluginController = new PluginController();
            foreach ($pluginController->getAll() as $plugin) {  
                $this->plugins[] = $plugin;
            }
            
            if(!empty($data)){
                $this->view = $data['view'];

            }

        }
        public function add(array $data){
            array_push($this->result,array("function"=>"add","result"=>$this->model->insert($data)));
            return $this->result;
        }
        public function update(array $data){
           array_push($this->result,array("function"=>"update","result"=>$this->model->update($data)));
            return $this->result;
        }
        public function delete(array $data){
            array_push($this->result,array("function"=>"delete","result"=>$this->model->delete($data)));
            return $this->result;
        }
        public function sendResponse():bool{
            echo $response = json_encode($this->result);
            return $response;
        }
        public function getAll(){
            $this->result = $this->model->getAllByTable();
            return $this->result;

        }
        public function uploadImage(){
            
            array_push($this->result,array("function"=>"uploadImage","result"=>$this->model->checkImageAndUpload()));
            return $this->result;
        }
        public function display(array $data = []):bool{
            $view = 'home';
            $datas = !empty($data) ? $data : [];
            require_once VIEW_DIR . "/page.phtml";
            return true;
        }
        /* 
            fonction permmettant l'ajout d'un script à la page
            @param string $script: le nom du script sans l'extension
        */
        public function addScript(string $script):void{
            array_push($this->scripts,$script);
        }
        /* 
            fonction permmettant l'ajout d'un style à la page
            @param string $style: le nom du style sans l'extension
        */
        public function addStyle(string $style):void{
            array_push($this->styles,$style);
        }
    
    }