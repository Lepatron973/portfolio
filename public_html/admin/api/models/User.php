<?php
    namespace Models;
    
    class User extends Database{
       function __construct(){
            parent::__construct();
            $this->table = "users";
       }
    }
    