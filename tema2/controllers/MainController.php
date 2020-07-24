<?php
    class MainController extends Controller
    {
        public function __construct($action, $params)
        {
            //parent::__construct();
            $formular = "";
            $formular .= '<a href="' . WSITE_ROOT . '/book">Go to Books</a><br><br>';            
            $formular .= '<a href="' . WSITE_ROOT . '/author">Go to Authors</a><br><br>';            
            $formular .= '<a href="' . WSITE_ROOT . '/publisher">Go to Publishers<br><br>';
            echo $formular;
        }

        
    }