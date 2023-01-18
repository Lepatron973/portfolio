<?php
    namespace Controllers;
    
    class PluginController extends Controller{
        function __construct(array $data = []){
            $this->model = new \Models\Plugin();
        }

        function uploadPlugin(){
            array_push($this->result,array("function"=>"addPlugin","result"=>$this->model->uploadZipAndExtract()));
            return $this->result;
        }
    }