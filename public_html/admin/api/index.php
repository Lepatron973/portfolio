<?php
    require_once './config/config.php';
    spl_autoload_register(function ($class) {
        $file =  lcfirst(str_replace('\\','/',$class));
        //    echo $class . "<br />";
        //    echo $file . "<br />";
        require_once ROOT_DIR ."/". $file . '.php';
     });
    use Controllers\ProjectController;
    use Controllers\AjaxController;
    use Controllers\UserController;

    
     if(isset($_GET['path'])){

        switch ($_GET['path']) {
            case 'projects':
                $controller = new AjaxController(new ProjectController());
                $controller->router($_GET['action']);
                break;
            case 'user':
                $controller = new AjaxController(new UserController());
                $controller->router($_GET['action']);
                break;
            
            default:
               
                break;
        }
    }