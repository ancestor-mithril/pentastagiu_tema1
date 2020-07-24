<?php
    session_start();
    
    require_once("autoloader.php");
    
    $router = new Router(require "routes.php");
    //echo "<pre>"; print_r($_SERVER);  echo "</pre>"; echo "<br>" . substr ($_SERVER['REQUEST_URI'], 18); die();
    
    $path = substr ($_SERVER['REQUEST_URI'], 19);
    $controllerActions = explode("/", $path);
    //echo "/" . $controllerActions[0]; echo "<br>"; print_r($controllerActions); die();
    
    $controller = $controllerActions[0];
    $router->load ("/");
    $router->load ("/" . $controller);
    $action = count($controllerActions) > 1 ? explode ("?", $controllerActions[1])[0] : NULL;
    $params = count($controllerActions) > 2 ? explode ("?", $controllerActions[2])[0] : NULL;
    if ($controller === "")
        $controller = "main";
    $controller = ucfirst ($controller . "Controller");
    
    $control = new $controller ($action, $params);
