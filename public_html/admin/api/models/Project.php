<?php
    namespace Models;
    
    class Project extends Database{
       function __construct(){
            parent::__construct();
            $this->table = "projects";
       }
        // function getOneProduct(string $id):array{
        //     $table = "products";
        //     $req = $this->bdd->prepare(
        //         "SELECT $table.*, functionalities.func_name FROM $table 
        //         INNER JOIN products_func ON $table.id_product = products_func.id_product 
        //         INNER JOIN functionalities ON products_func.id_func = functionalities.id WHERE $table.id_product = ?"
        //     );
        //     $req->execute(["$id"]);
        //     return $result = $req->rowCount() > 0 ? $req->fetch(\PDO::FETCH_ASSOC) : [];
        // }
        public function newProject(array $data):bool{
            $data['table'] = $this->table;
            $result = $this->insert($data);
            return $result;
        }

    }
    