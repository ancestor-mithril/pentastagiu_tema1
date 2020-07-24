<?php
    class BookController extends Controller
    {
        public function __construct($action, $params)
        {
            parent::__construct();
            if ($action === "create")
            {
                $this->createNewBook();
            }
            else if ($action === "store")
            {
                $this->storeNewBook();
            }
            else if ($action === NULL || $action === "")
            {
                $this->displayBooks();
            }
            else if ($action === "delete")
            {
                $this->deleteBook();
            }
            else if ($action === "edit")
            {
                $this->editBook();
            }
            else if ($action === "update")
            {
                $this->updateBook();
            }
            else
            {
                print_r(explode("?", $action));
                die("Invalid action: $action");
            }
        }

        private function createNewBook()
        {
            echo $this->view->createNewEntryFormular();
        }

        private function storeNewBook()
        {
            $this->model->insertBook($_POST);
            header ('Location: '.WSITE_ROOT.'/book');
            die();
        }

        private function displayBooks()
        {
            $books = $this->model->getAllBooks();
            echo $this->view->createBookPage($books);
        }

        private function deleteBook()
        {
            if (isset($_POST["id"]))
                $this->model->deleteBook($_POST["id"]);
            else
                die("invalid request");
            header ('Location: '.WSITE_ROOT.'/book');
            die();
        }

        private function editBook()
        {
            if (! isset($_GET["id"]))
                die ("invalid request");
            $book = $this->model->getBook($_GET["id"]);
            if (empty($book))
                die("error at parsing request");
            echo $this->view->createEditFormular($book[0]);
        }

        private function updateBook()
        {
            if (isset($_POST["id"]))
                $this->model->updateBook($_POST);
            else
                die("invalid request");
            header('Location: '.WSITE_ROOT.'/book');
            die();
        }
    }