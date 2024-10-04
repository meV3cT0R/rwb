<?php
    require_once "src/controllers/HomeController.php";
    $homeController = new HomeController();

    $uri = $_SERVER['REQUEST_URI'];
    $uri = explode("/",$uri);
    $uri = array_slice($uri,2);
    $uri = implode("/",$uri);
    echo $uri."<br/>";

    $route = array(
        "home" => function():void{
            global $homeController;
            $homeController->home();
        },
        "admin/dashboard" => function() :void {
            global $adminController = new AdminController();
        }
    );

    if(isset($route[strtolower($uri)])) {
        $route[$uri]();
    }else {
        echo "404 : Page Not Found";
    }
    exit();