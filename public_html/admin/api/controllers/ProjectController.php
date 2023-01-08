<?php
    namespace Controllers;
    
    class ProjectController extends Controller{
        function __construct(array $data = []){
            $this->model = new \Models\Project();
        }
       
    }