<?php
    class AuthorView extends View
    {
        public function createNewEntryFormular(): string {
            $formular = '<div class="add_form"><form action="' . WSITE_ROOT . '/author/store" method="POST">';
            $formular .= '<label for="name">Name:</label><br>';
            $formular .= '<input type="text" id="name" name="name" value="default name"><br><br>';
            $formular .= '<input type="submit" value="Submit"><br>';
            $formular .= "</form></div>";
            return $formular;
        }

        private function displayAuthors(array $authors): string {
            $currentAuthors = "<div>";
            foreach ($authors as $author) 
            {
                $currentAuthors .= '<div class="authors">';
                $currentAuthors .= '<h4>Author ' . $author["id"] . '</h6>';
                $currentAuthors .= '<p>Title: ' . $author["name"] . '</p>';
                $currentAuthors .= '<form action="' . WSITE_ROOT . '/author/delete" method="POST"><input type="hidden" 
                    name="id" value="' . $author["id"] . '"><input type="Submit" value="Delete"></form>';
                $currentAuthors .= '<form action="' . WSITE_ROOT . '/author/edit" method="GET"><input type="hidden" 
                    name="id" value="' . $author["id"] . '"><input type="Submit" value="Edit"></form>';
                $currentAuthors .= '</div>';
                
            }
            $currentAuthors .= '</div><form action="' . WSITE_ROOT . '/author/create" method="POST">
                <input type=Submit value="Add new author"></form><br>';
            $currentAuthors .= '<a href="' . WSITE_ROOT . '/book">Go to Books</a><br><br>';
            $currentAuthors .= '<a href="' . WSITE_ROOT . '/publisher">Go to Publishers</a><br><br>';
            
            return $currentAuthors;
        }

        public function createAuthorPage(array $authors): string {
            $currentAuthors = $this->displayAuthors ($authors);
            ob_start();
            $authorPage = "views/TPL/author_page.html";
            include ($authorPage);
            $page = ob_get_contents();
            ob_end_clean();
            return $page;
        }

        public function createEditFormular(array $author): string {
            $formular = '<form action="' . WSITE_ROOT . '/author/update" method="POST">';
            $formular .= '<label for="name">Name:</label><br>';
            $formular .= '<input type="hidden" id="id" name="id" value="' . $author["id"] . '"><br>';
            $formular .= '<input type="text" id="name" name="name" value="' . $author["name"] . '"><br>';
            $formular .= '<input type="submit" value="Submit"><br>';
            $formular .= "</form>";
            return $formular;
        }
    }