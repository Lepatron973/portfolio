<?php
    namespace Models;
    
    class Database{
        protected $table;
        private $bdd_info = array(
            "dbname"=>"",
            "host"=>"",
            "user"=>"",
            "password"=>""
        );
        public $bdd;
        function __construct(){

            $this->bdd_info["dbname"] = BDD_CONNECT['dbname'];
            $this->bdd_info["host"] = BDD_CONNECT['host'];
            $this->bdd_info["user"] = BDD_CONNECT['user'];
            $this->bdd_info["password"] = BDD_CONNECT['password'];
            try {
               $this->bdd = new \PDO("mysql:dbname=" .$this->bdd_info["dbname"]. ";charset=utf8;host=" . $this->bdd_info["host"], $this->bdd_info["user"], $this->bdd_info["password"]);
            
            } catch (\PDOException $e) {
              //  \Controllers\ErrorController::connexionFailed($e);
              //echo $e->getMessage();
            }
            
        }

        function insert(array $post):bool{
            if(empty($post))
                return false;
            $ref = [];
            $sql = "INSERT INTO `$this->table` (" ;
            $i = 1;
            foreach($post as $key => $value){
                if($key != "confirm-password" && $key != "table"){
                    array_push($ref,$key);
                }
            }
            foreach($ref as $key){
                $sql .= "`". $key . "`,";
            }
            $sql = substr_replace($sql,')', strlen($sql)-1);
            $sql .= " VALUES (";
            foreach($ref as $key){
                $sql .= "?,";
            }
            $sql = substr_replace($sql,')', strlen($sql)-1);
            $req = $this->bdd->prepare($sql);
            //var_dump($req);
            foreach($ref as $value){
                switch($post[$value]){
                    
                    case is_string($post[$value]):
                        $req->bindValue($i,"$post[$value]", \PDO::PARAM_STR);
                    break;
                    case is_int($post[$value]):
                        $req->bindValue($i,$post[$value], \PDO::PARAM_INT);
                    break;
                    case is_bool($post[$value]):
                        $req->bindValue($i,$post[$value], \PDO::PARAM_BOOL);
                    break;
                }
                $i++;
            }
            return $req->execute();
        }
        /*
            array @data avec pour valeur :
            "ref" => la colunm correspondante dans la table,
            "table" => la table dans laquelle on va chercher,
            "value" => l'élément de comparaison  
         */
        function getOneByRef(array $data):array{
        
            $req = $this->bdd->prepare("SELECT * FROM $this->table WHERE  $data[ref] = ?");
            $req->execute(["$data[value]"]);
            return $result = $req->rowCount() > 0 ? $req->fetch(\PDO::FETCH_ASSOC) : [];

        }

        function getAllByTable():array{
            $req = $this->bdd->prepare("SELECT * FROM $this->table");
            $req->execute();
            return $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        }
        function getAllByTableAdvanced(string $table,int $limit):array{
            $req = $this->bdd->prepare("SELECT * FROM $table LIMIT $limit");
            $req->execute();
            return $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        }
        function getSpeceficData(string $refToPull,string $table):array{
            $req = $this->bdd->prepare("SELECT $refToPull FROM $table");
            $req->execute();
            return $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        }
        function update(array $post):bool{
            $ref = [];
            $sql = "UPDATE `$this->table` SET " ;
            $i = 1;
            foreach($post as $key => $value){
                if($key != "confirm-password" && $key != "table"){

                    array_push($ref,$key);
                }
            }
            foreach($ref as $key){
                $sql .= "`". $key . "` = ?,";
            }  
            $sql = substr_replace($sql," WHERE id = $post[id]", strlen($sql)-1);
            $req = $this->bdd->prepare($sql);
            foreach($ref as $value){
                switch($post[$value]){
                    
                    case is_string($post[$value]):
                       
                        $req->bindValue($i,"$post[$value]", \PDO::PARAM_STR);
                    break;
                    case is_int($post[$value]):
                        $req->bindValue($i,$post[$value], \PDO::PARAM_INT);
                    break;
                    case is_bool($post[$value]):
                        $req->bindValue($i,$post[$value], \PDO::PARAM_BOOL);
                    break;
                }
                $i++;
            }
            return $req->execute();
        }
        function delete(array $data){
            $req = $this->bdd->prepare("DELETE FROM $this->table WHERE $data[ref]=?");
            $req->bindValue(1,$data['value'], \PDO::PARAM_INT);
            return $req->execute();
        }

        // Fonctions spécifique paramétrée pour un tableau contenant quelques informations de la super variable $_$_FILES['image']
        function checkImageAndUpload():bool{
            //dossier ou sera placé l'image
            $uploadDir = ROOT_DIR."/imgs/";
            // Si tu le modifie il faudra aussi le faire sur l'input file (attribut accept)
            $acceptedFormat = array(
                "jpg","jpeg",'png',"svg"
            );
            $message = "image vide";    
            $goOn = false;
            // On vérifie si une image est contenue dans la variable FILE
            if(empty($_FILES['image']["name"]) && empty($_FILES['image']["type"]))
                $goOn = true; 
            else{ 
                // manipulation permettant d'obtenir seulement l'extension du fichier = png;
                $fileType = substr($_FILES['image']['type'],strpos($_FILES['image']['type'],'/')+1);
                foreach($acceptedFormat as $type){
                    if($fileType == $type){    
                        $goOn = true;
                    }
                }
                $status = $goOn == true ? 1 : 0;
                if($status){
                    $uploadFile = $uploadDir . basename($_FILES['image']['name']);
                    $message = move_uploaded_file($_FILES['image']['tmp_name'],$uploadFile) ? "Image téléchargée !" : "L'image n'a pas pu être téléchargée";
                }
                else
                   $message = ("Mauvais format envoyé ");
            }       
            //$message;
            return $goOn;
        }
        

    }