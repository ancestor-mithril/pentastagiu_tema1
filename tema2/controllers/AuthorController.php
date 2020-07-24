<?php
    class AuthorController extends Controller
    {
        public function __construct($action, $params)
        {
            parent::__construct();
            if ($action === "create")
            {
                $this->createNewAuthor();
            }
            else if ($action === "store")
            {
                $this->storeNewAuthor();
            }
            else if ($action === NULL || $action === "")
            {
                $this->displayAuthors();
            }
            else if ($action === "delete")
            {
                $this->deleteAuthor();
            }
            else if ($action === "edit")
            {
                $this->editAuthor();
            }
            else if ($action === "update")
            {
                $this->updateAuthor();
            }
            else
            {
                print_r(explode("?", $action));
                die("Invalid action: $action");
            }
        }

        private function createNewAuthor()
        {
            echo $this->view->createNewEntryFormular();
        }

        private function storeNewAuthor()
        {
            $this->model->insertAuthor ($_POST);
            header ('Location: '.WSITE_ROOT.'/author');
            die();
        }

        private function displayAuthors()
        {
            $authors = $this->model->getAllAuthors();
            echo $this->view->createAuthorPage ($authors);
        }

        private function deleteAuthor()
        {
            if (isset ($_POST["id"]))
                $this->model->deleteAuthor ($_POST["id"]);
            else
                die ("invalid request");
            header ('Location: '.WSITE_ROOT.'/author');
            die();
        }

        private function editAuthor()
        {
            if (! isset ($_GET["id"]))
                die ("invalid request");
            $author = $this->model->getAuthor ($_GET["id"]);
            if (empty ($author))
                die ("error at parsing request");
            echo $this->view->createEditFormular ($author[0]);
        }

        private function updateAuthor()
        {
            if (isset ($_POST["id"]))
                $this->model->updateAuthor ($_POST);
            else
                die ("invalid request");
            header ('Location: '.WSITE_ROOT.'/author');
            die();
        }
    }