<?php
    class BookView extends View
    {
        private function addSelectOptions (array $options, string $default = "1"): string {
            $select = "";
            foreach ($options as $option) {
                $select .= '<option value="' . $option["id"] . '"';
                if ($option["id"] === $default)
                    $select .= ' selected ';
                $select .= '>' . $option["name"] . '</option>';
            }
            return $select;
        }

        public function createNewEntryFormular(array $authors, array $publishers): string {
            $formular = '<div class="add_form"><form action="' . WSITE_ROOT . '/book/store" method="POST">';
            $formular .= '<label for="title">Title:</label><br>';
            $formular .= '<input type="text" id="title" name="title" value="default title"><br>';
            $formular .= '<label for="author_id">Author:</label><br>';
            $formular .= '<select name="author_id" id="author_id">';
            $formular .= $this->addSelectOptions ($authors);
            $formular .= '</select><br>';
            $formular .= '<label for="publisher_id">Publisher:</label><br>';
            $formular .= '<select name="publisher_id" id="publisher_id">';
            $formular .= $this->addSelectOptions ($publishers);
            $formular .= '</select><br>';
            $formular .= '<label for="publisher_year">Year:</label><br>';
            $formular .= '<input type="number" id="publisher_year" name="publisher_year" value="2000"><br><br>';
            $formular .= '<input type="submit" value="Submit"><br>';
            $formular .= "</form></div>";
            return $formular;
        }

        private function displayBooks(array $books): string {
            $currentBooks = "<div>";
            foreach ($books as $book) 
            {
                $currentBooks .= '<div class="books">';
                $currentBooks .= '<h4>Book ' . $book["id"] . '</h6>';
                $currentBooks .= '<p>Title: ' . $book["title"] . '</p>';
                $currentBooks .= '<p>Author: ' . $book["author_id"] . '</p>';
                $currentBooks .= '<p>Publisher: ' . $book["publisher_id"] . '</p>';
                $currentBooks .= '<p>Year: '.$book["publisher_year"] . '</p>';
                $currentBooks .= '<form action="' . WSITE_ROOT . '/book/delete" method="POST"><input type="hidden" 
                    name="id" value="' . $book["id"] . '"><input type="Submit" value="Delete"></form>';
                $currentBooks .= '<form action="' . WSITE_ROOT . '/book/edit" method="GET"><input type="hidden" 
                    name="id" value="' . $book["id"] . '"><input type="Submit" value="Edit"></form>';
                $currentBooks .= '</div>';
                
            }
            $currentBooks .= '</div><form action="' . WSITE_ROOT . '/book/create" method="POST">
                <input type=Submit value="Add new book"></form>';
            $currentBooks .= '</div><form action="' . WSITE_ROOT . '/author" method="POST">
                <input type=Submit value="Go to authors"></form><br>';
            $currentBooks .= '</div><form action="' . WSITE_ROOT . '/publisher" method="POST">
                <input type=Submit value="Go to publishers"></form><br>';
            return $currentBooks;
        }

        public function createBookPage(array $books): string {
            $currentBooks = $this->displayBooks ($books);
            ob_start();
            $booksPage = "views/TPL/book_page.html";
            include ($booksPage);
            $page = ob_get_contents();
            ob_end_clean();
            return $page;
        }

        public function createEditFormular(array $book, array $authors, array $publishers): string {
            $formular = '<form action="' . WSITE_ROOT . '/book/update" method="POST">';
            $formular .= '<label for="title">Title:</label><br>';
            $formular .= '<input type="hidden" id="id" name="id" value="' . $book["id"] . '"><br>';
            $formular .= '<input type="text" id="title" name="title" value="' . $book["title"] . '"><br>';
            $formular .= '<label for="author_name">Author:</label><br>';
            $formular .= '<select name="author_id" id="author_id">';
            $formular .= $this->addSelectOptions ($authors, $book["author_id"]);
            $formular .= '</select><br>';
            $formular .= '<label for="publisher_name">Publisher:</label><br>';
            $formular .= '<select name="publisher_id" id="publisher_id">';
            $formular .= $this->addSelectOptions ($publishers, $book["publisher_id"]);
            $formular .= '</select><br>';
            $formular .= '<label for="publisher_year">Year:</label><br>';
            $formular .= '<input type="number" id="publisher_year" name="publisher_year" value="'
                . $book["publisher_year"] . '"><br><br>';
            $formular .= '<input type="submit" value="Submit"><br>';
            $formular .= "</form>";
            return $formular;
        }
    }