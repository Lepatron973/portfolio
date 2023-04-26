<?php
    require_once './config/config.php';
    session_start();
    spl_autoload_register(function ($class) {
        $file =  lcfirst(str_replace('\\','/',$class));
        //    echo $class . "<br />";
        //    echo $file . "<br />";
        require_once ROOT_DIR ."/". $file . '.php';
     });
     
    use Controllers\ProjectController;
    use Controllers\AjaxController;
    use Controllers\UserController;
    use Controllers\PluginController;
    use Controllers\DashboardController;
    
    if(!UserController::checkUserSession())
        header('location: ../');
    

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
            case 'plugin':
                $controller = new AjaxController(new PluginController());
                $controller->router($_GET['action']);
                break;
            default:
               echo "test";
                break;
        }
    }else{
        $controller = new DashboardController(['view'=>'home']);
        $controller->display();
    }