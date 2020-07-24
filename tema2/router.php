<?php
    class Router
    {
        private $routes;
        public function __construct($routes) 
        {
            $this->routes = $routes;
        }

        public function load(string $route)
        {
            //echo "<br>$route<br>";echo "<pre>";print_r($this->routes);echo "</pre>";
            if (isset ($this->routes[$route]))
            {
                foreach ($this->routes[$route] as $filePath)
                    require_once $filePath;
            } 
            else 
            { 
                die("invalid path: " . $route);
            }
        }
    }