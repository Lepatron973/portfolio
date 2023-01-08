<?php
    namespace Controllers;
    
    class Controller{
        protected $model;
        protected $result = array();
        function __construct(array $data = []){

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
    
    }