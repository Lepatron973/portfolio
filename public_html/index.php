<?php
    session_start();
    require_once './admin/api/config/config.php';
    require_once './admin/api/models/Database.php';
    require_once './admin/api/models/Plugin.php';
    use Models\Database;
    use Models\Plugin;
    $db = new Plugin();
        if(empty($_GET)){
            $plugins = $db->getAllByTable();
            
            require_once ('./home.php');
        
        }
        else
            echo "pas ok";