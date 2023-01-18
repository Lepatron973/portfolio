<?php
    namespace Models;
    
    class Plugin extends Database{
       function __construct(){
            parent::__construct();
            $this->table = "plugins";
       }
       function uploadZipAndExtract(){
         //dossier ou sera placé l'image
         $uploadDir = dirname(dirname(dirname(__DIR__)))."/plugins/";
         // Si tu le modifie il faudra aussi le faire sur l'input file (attribut accept)
         $acceptedFormat = array(
             "zip"
         );
         $message = "dossier vide";    
         $goOn = false;
         // On vérifie si une image est contenue dans la variable FILE
         if(empty($_FILES['plugin']["name"]) && empty($_FILES['plugin']["type"]))
             $goOn = true; 
         else{ 
             // manipulation permettant d'obtenir seulement l'extension du fichier = png;
             $fileType = substr($_FILES['plugin']['type'],strpos($_FILES['plugin']['type'],'/')+1);
             foreach($acceptedFormat as $type){
                 if($fileType == $type){    
                     $goOn = true;
                 }
             }
             $status = $goOn == true ? 1 : 0;
             if($status){
                 $uploadFile = $uploadDir . basename($_FILES['plugin']['name']);
                 $maxUploadSize = intval(substr(ini_get("upload_max_filesize"),0,-1));
                 $fileSize = (round(($_FILES['plugin']["size"]) / 1000000));
                 if($fileSize < $maxUploadSize){

                    $message = move_uploaded_file($_FILES['plugin']['tmp_name'],$uploadFile) ? "Plugin téléchargée !" : "Le plugin n'a pas pu être téléchargée";
                    $zip = new \ZipArchive;
                    $pluginName = substr($_FILES['plugin']['name'],0,-4);
                    if ($zip->open($uploadFile) === TRUE) {
                       $zip->extractTo($uploadDir);
                       $zip->close();
                       $this->delTree($uploadDir.'__MACOSX');
                       unlink($uploadDir.$_FILES['plugin']['name']);
                       $this->insert(['name'=>$pluginName]);
                       $this->createPluginDb($pluginName,$uploadDir);
                    } else {
                       echo 'failed';
                    }
                 }else{
                  $message = "Le fichier est trop volumineux, veuillez augmenter la taille 
                  de : upload_max_filesize dans php.inni.
                  valeur actuelle: ". $maxUploadSize . "M" ;
                  return $message;
                 }
               }
             else
                $message = ("Mauvais format envoyé ");
         }       
         //$message;
         var_dump($message);
         return $goOn;
     }

      function delTree($dir) {

         $files = array_diff(scandir($dir), array('.','..'));
      
         foreach ($files as $file) {
      
            (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
      
         }
         return rmdir($dir);
      
      }
      function createPluginDb($pluginName,$uploadDir){
         $sql = file_get_contents($uploadDir.$pluginName.'/config/'.$pluginName.'.sql');
         $result = $this->bdd->query($sql);
      }

      function delete(array $data){
         $req = $this->bdd->prepare("DELETE FROM $this->table WHERE id=?");
         $req->bindValue(1,$data['id'], \PDO::PARAM_INT);
         $result = $req->execute();
         $sql2 = "DROP DATABASE `$data[name]`";
         $this->bdd->query($sql2);
         $dir = dirname(dirname(dirname(__DIR__)))."/plugins/".$data['name'];
         $this->delTree($dir);
         return $result;
     }
   }
    