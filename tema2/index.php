<?php
    session_start();
    require_once("autoloader.php");
    require_once("models/Model.php");
    $router = new Router();
    //echo "<pre>"; print_r($_SERVER);  echo "</pre>"; echo "<br>" . substr ($_SERVER['REQUEST_URI'], 18);
    $path = substr ($_SERVER['REQUEST_URI'], 25);
    $controllerActions = explode("/", $path);
    //echo "/" . $controllerActions[0]; echo "<br>"; print_r($controllerActions);
    $controller = $controllerActions[0];
    $router->load ("/");
    $router->load ("/" . $controller);
    $action = count($controllerActions) > 1? explode("?", $controllerActions[1])[0] : NULL;
    $params = count($controllerActions) > 2? explode("?", $controllerActions[2])[0] : NULL;
    //echo "<br>$action<br>$params<br>";
    //header('Location: '.WSITE_ROOT.'/index/main'); die();
    //$controllerAction = explode("/", $path); print_r($controllerAction);
    $controller = ucfirst ($controller . "Controller");
    $control = new $controller ($action, $params);
