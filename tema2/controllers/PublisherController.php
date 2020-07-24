<?php
    class PublisherController extends Controller
    {
        public function __construct($action, $params)
        {
            parent::__construct();
            if ($action === "create")
            {
                $this->createNewPublisher();
            }
            else if ($action === "store")
            {
                $this->storeNewPublisher();
            }
            else if ($action === NULL || $action === "")
            {
                $this->displayPublishers();
            }
            else if ($action === "delete")
            {
                $this->deletePublisher();
            }
            else if ($action === "edit")
            {
                $this->editPublisher();
            }
            else if ($action === "update")
            {
                $this->updatePublisher();
            }
            else
            {
                print_r(explode("?", $action));
                die("Invalid action: $action");
            }
        }

        private function createNewPublisher()
        {
            echo $this->view->createNewEntryFormular();
        }

        private function storeNewPublisher()
        {
            $this->model->insertPublisher($_POST);
            header ('Location: '.WSITE_ROOT.'/publisher');
            die();
        }

        private function displayPublishers()
        {
            $publishers = $this->model->getAllPublishers();
            echo $this->view->createPublisherPage($publishers);
        }

        private function deletePublisher()
        {
            die("not yet implemented");
            if (isset($_POST["id"]))
                $this->model->deleteAuthor($_POST["id"]);
            else
                die("invalid request");
            header ('Location: '.WSITE_ROOT.'/publisher');
            die();
        }

        private function editPublisher()
        {
            if (! isset($_GET["id"]))
                die ("invalid request");
            $publisher = $this->model->getPublisher($_GET["id"]);
            if (empty($publisher))
                die("error at parsing request");
            echo $this->view->createEditFormular($publisher[0]);
        }

        private function updatePublisher()
        {
            if (isset($_POST["id"]))
                $this->model->updatePublisher($_POST);
            else
                die("invalid request");
            header('Location: '.WSITE_ROOT.'/publisher');
            die();
        }
    }