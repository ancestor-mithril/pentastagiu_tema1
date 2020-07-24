<?php 
    class Controller
    {
        protected $model;
        protected $view;

        public function __construct()
        {
            $modelName = str_replace ("Controller", "Model", get_class($this));
            if (!class_exists ($modelName, true)) 
            {
                die ("Invalid action $modelName");
            }
            $this->model = new $modelName();  
            $viewName = str_replace ("Controller", "View", get_class($this));
            if (!class_exists ($viewName, true)) 
            {
                die ("Invalid action $viewName");
            }   
            $this->view = new $viewName();                                        
        }

    }