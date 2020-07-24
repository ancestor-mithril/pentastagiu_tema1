<?php
    class Router
    {
        private $routes;
        public function __construct() 
        {
            $this->routes = [
                "/book" => [
                    "controllers/BookController.php",
                    "models/BookModel.php",
                    "views/BookView.php",
                ],
                "/" => [
                    "controllers/Controller.php",
                    "models/Model.php",
                    "views/View.php"
                ],
                "/author" => [
                    "controllers/AuthorController.php",
                    "models/AuthorModel.php",
                    "views/AuthorView.php",
                ],
                "/publisher" => [
                    "controllers/PublisherController.php",
                    "models/PublisherModel.php",
                    "views/PublisherView.php",
                ]

            ];
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